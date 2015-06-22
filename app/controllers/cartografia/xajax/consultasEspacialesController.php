<?php

use \PMap;

class ConsultasEspacialesController extends BaseController {
	public function postLocalidadByMpio() {
		$mpio = $_POST["mpio"];
        $registros = DB::select('select gid, nombre from localidades_a where municipio = ? order by nombre', array($mpio));
        if (count($registros) == 0) {
			echo '<option value="000">No existen Localidades</option>';
            return;
        }

        echo '<option value="000"> Seleccione... </option>';
		foreach($registros as $registro){
			echo '<option value="'.$registro->gid.'">'.$registro->nombre.'</option>';
	    }       

	}

	public function postMzaByLocalidad() {
		$gidloc = $_POST["gidloc"];
        $registros = DB::select('select gid, cve_manzana from manzanas where ST_Intersects(geom, (select geom from localidades_a where gid = ?)) order by cve_manzana', array($gidloc));
        if (count($registros) == 0) {
			echo '<option value="000">No existen Manzanas</option>';
            return;
        }

        echo '<option value="000"> Seleccione... </option>';
		foreach($registros as $registro){
			echo '<option value="'.$registro->gid.'">'.$registro->cve_manzana.'</option>';
	    }       
	}
	public function postCallesByLocalidad() {
		$gidloc = $_POST["gidloc"];
        $registros = DB::select('select distinct cvegeo, nombre from calles where ST_Intersects(geom, (select geom from localidades_a where gid = ?)) order by nombre', array($gidloc));
        if (count($registros) == 0) {
			echo '<option value="000">No existen calles</option>';
            return;
        }

        echo '<option value="000"> Seleccione... </option>';
		foreach($registros as $registro){
			echo '<option value="'.$registro->cvegeo.'-'.$registro->nombre.'">'.$registro->nombre.'</option>';
	    }       
	}

	public function postCallesByCalle() {
		$valor = $_POST["calle"];
		$array = explode("-",$valor);
		$cvegeo = $array[0];
		$nombre = $array[1];

        $registros = DB::select('select distinct cvegeo, nombre from calles where ST_Intersects(geom, (select ST_Union(geom) from calles where cvegeo = ? and nombre = ?)) order by nombre', array($cvegeo,$nombre));
        if (count($registros) == 0) {
			echo '<option value="000">No existen calles</option>';
            return;
        }

        echo '<option value="000"> Seleccione... </option>';
		foreach($registros as $registro){
			if($registro->nombre != $nombre)
			echo '<option value="'.$registro->cvegeo.'-'.$registro->nombre.'">'.$registro->nombre.'</option>';
	    }       
	}

	public function postConsultaCalle() {

        $PM_MAP_FILE = "/var/www/html/cartografia/mapfiles/Tabasco.map";
        $map = ms_newMapObj($PM_MAP_FILE);
        $scaleLayers = 1;
        $mapW = $_REQUEST["mapW"];
        $mapH = $_REQUEST["mapH"];
        $calle1 = $_REQUEST["calle1"];
        $calle2 = $_REQUEST["calle2"];
		$array = explode("-",$calle1);
        $calle1_cvegeo = $array[0];
        $calle1_nombre = $array[1];
		$array = explode("-",$calle2);
        $calle2_cvegeo = $array[0];
        $calle2_nombre = $array[1];

        $query = "select st_xmin(geom) as xmin, st_ymin(geom) as ymin, st_xmax(geom) as xmax, st_ymax(geom) as ymax from manzanas where ST_Intersects(geom, (ST_Buffer((select ST_intersection ((select ST_Union(geom) from calles where cvegeo = ? and nombre = ?), (select  ST_Union(geom) from calles where cvegeo = ? and nombre = ?))), 10)))"; 
        $result = DB::select($query, array($calle1_cvegeo,$calle1_nombre,$calle2_cvegeo,$calle2_nombre));

        if (count($result) == 0) {
            $strJS  = '"msgError":"No se ha encontrado ninguna manzana en la calle '.$calle1_nombre.' cerca de la calle '.$calle2_nombre.'"';
            echo "{\"sessionerror\":\"QueryError\",".$strJS."}";
            return;
        }

        $n = 0;

		foreach($result as $registro){
			if ($n == 0){
				$xmin = $registro->xmin;
				$ymin = $registro->ymin;
				$xmax = $registro->xmax;
				$ymax = $registro->ymax;
				$n = 1;
			}else{
				if($registro->xmin < $xmin) $xmin = $registro->xmin;
				if($registro->ymin < $ymin) $ymin = $registro->ymin;
				if($registro->xmax > $xmax) $xmax = $registro->xmax;
				if($registro->ymax > $ymax) $ymax = $registro->ymax;
			}
	    }       

        $_REQUEST["extent"] = $xmin . "+" . $ymin . "+" . $xmax . "+" . $ymax;

        $pmap = new PMAP($map);
        $pmap->pmap_create();

        $mapURL      = $pmap->pmap_returnMapImgURL();
        $scalebarURL = $pmap->pmap_returnScalebarImgURL();
        $mapJS       = $pmap->pmap_returnMapJSParams();
        $mapwidth    = $pmap->pmap_returnMapW();
        $mapheight   = $pmap->pmap_returnMapH();
        $geo_scale   = $pmap->pmap_returnGeoScale();

        // JS objects from map creation
        $strJS  = '"mapW":"' . $mapJS['mapW'] . '", ';
        $strJS .= '"mapH":"' . $mapJS['mapH'] . '", ';
        $strJS .= '"refW":"' . $mapJS['refW'] . '", ';
        $strJS .= '"refW":"' . $mapJS['refW'] . '", ';
        $strJS .= '"extent":"' . $_REQUEST["extent"] . '", ';
        $strJS .= '"minx_geo":"' . $mapJS['minx_geo'] . '", ';
        $strJS .= '"miny_geo":"' . $mapJS['miny_geo'] . '", ';
        $strJS .= '"maxx_geo":"' . $mapJS['maxx_geo'] . '", ';
        $strJS .= '"maxy_geo":"' . $mapJS['maxy_geo'] . '", ';
        $strJS .= '"xdelta_geo":"' . $mapJS['xdelta_geo'] . '", ';
        $strJS .= '"ydelta_geo":"' . $mapJS['ydelta_geo'] . '", ';
        $strJS .= '"refBoxStr":"' . $mapJS['refBoxStr'] . '" ';


        // Serialize url_points
        $urlPntStr = '';

        // return JS object literals "{}" for XMLHTTP request
        echo "{\"sessionerror\":\"false\",  \"mapURL\":\"$mapURL\", \"scalebarURL\":\"$scalebarURL\", \"geo_scale\":\"$geo_scale\",".$strJS."}";

	}

    protected function img2map($width,$height,$point,$ext) {
    		
    	$minx = $ext->minx;
    	$miny = $ext->miny;
    	$maxx = $ext->maxx;
    	$maxy = $ext->maxy;
    
    	if ($point->x && $point->y){
    		$x = $point->x;
    		$y = $point->y;
    
    		$dpp_x = ($maxx-$minx)/$width;
    		$dpp_y = ($maxy-$miny)/$height;
    
    		$x = $minx + $dpp_x*$x;
    		$y = $maxy - $dpp_y*$y;
    	}
    	$pt[0] = $x;
    	$pt[1] = $y;
    	return $pt;
    }  

}

?>