<?php

use \PMap;

class ConsultaAlfaController extends \BaseController {
	public function store(){

        $tipoQuery = $_REQUEST["query"];
	   
        if($tipoQuery == "Cuenta") {
            $mapW = $_REQUEST["mapW"];
            $mapH = $_REQUEST["mapH"];
            $municipio = $_REQUEST["variables"][0];
            $cuenta = $_REQUEST["variables"][1];

            $claves = DB::select('select clave from fiscal where cuenta = ?', array($cuenta));

            if (count($claves) == 0) {
                $strJS = '"msgError":"No se ha encontrado el número de cuenta  Solicitado: [' . $cuenta . '] en el municipio indicado "';
                echo "{\"sessionerror\":\"QueryError\"," . $strJS . "}";
                return;
            }
            $_REQUEST["variables"][1] = substr($claves[0]->clave,7);
        }


        // Busqueda por Clave

//        $PM_MAP_FILE = "/var/www/html/Tabasco.map";
        $PM_MAP_FILE = "/var/www/html/cartografia/mapfiles/Tabasco.map";
        $map = ms_newMapObj($PM_MAP_FILE);
        $scaleLayers = 1;
        $mapW = $_REQUEST["mapW"];
        $mapH = $_REQUEST["mapH"];
        $municipio = $_REQUEST["variables"][0];
        $clave_catas = $_REQUEST["variables"][1];

        $result = DB::select('select st_xmin(p.geom)-5 as xmin, st_ymin(p.geom)-5 as ymin, st_xmax(p.geom)+5 as xmax, st_ymax(p.geom)+5 as ymax  from predios p where p.municipio = ? and p.clave_catas = ?', array($municipio,$clave_catas));


        if (count($result) == 0) {
            if($tipoQuery == 'Cuenta'){
                $strJS  = '"msgError":"No se ha encontrado la Clave Catastral Solicitada: ['.$clave_catas.'] relacionada a la cuenta ['.$cuenta.'], en el municipio indicado '.$municipio.'"';
                echo "{\"sessionerror\":\"QueryError\",".$strJS."}";
                return;
            }
            $strJS  = '"msgError":"No se ha encontrado la Clave Catastral Solicitada: ['.$clave_catas.'] en el municipio indicado "';
            echo "{\"sessionerror\":\"QueryError\",".$strJS."}";
            return;
        }

        $row = $result[0];
        $_REQUEST["extent"] = $row->xmin . "+" . $row->ymin . "+" . $row->xmax . "+" . $row->ymax;

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