<?php

use \PMap;

class ConsultaEspacialController extends \BaseController {
	public function store(){

        $PM_MAP_FILE = "/var/www/html/Tabasco.map";
        $map = ms_newMapObj($PM_MAP_FILE);
        $scaleLayers = 1;       

        if(isset($_REQUEST["mode"]) && $_REQUEST["mode"] == "query"){
            
            $clkpoint = ms_newPointObj();
        	$old_extent = ms_newRectObj();
            $imgxy_str = $_REQUEST["imgxy"];
            $imgxy_arr = explode("+", $imgxy_str);
            $clkpoint->setXY($imgxy_arr[0],$imgxy_arr[1]);
            $old_extent->setextent($_REQUEST["GEOEXT"][0],$_REQUEST["GEOEXT"][1],$_REQUEST["GEOEXT"][2],$_REQUEST["GEOEXT"][3]);
            $mapW = $_REQUEST["mapW"];
            $mapH = $_REQUEST["mapH"];
        	list($x,$y) = $this->img2map($mapW,$mapH,$clkpoint,$old_extent);
        	$x_str = sprintf("%3.6f",$x);
        	$y_str = sprintf("%3.6f",$y);

            //Buscamos predio por geolocalización
            $registrosPredio = DB::select('select entidad, municipio, clave_catas, tipo_predio, superficie_terreno, superficie_construccion , st_xmin(geom) as xmin, st_ymin(geom) as ymin, st_xmax(geom) as xmax, st_ymax(geom) as ymax from predios where ST_Contains(geom, ST_SetSRID(ST_Point(?,?),32615))', array($x_str,$y_str));
            if (count($registrosPredio) == 0) {
                $strJS = '"msgError":"No existe ningún predio en el área seleccionada."';
                echo "{\"sessionerror\":\"QueryError\"," . $strJS . "}";
                return;
            }

            $predio = $registrosPredio[0];
            $entidad = $predio->entidad;
            $municipio = $predio->municipio;
            $clave_catas = $predio->clave_catas;
            $clave_completa = $predio->entidad."-".$predio->municipio."-".$predio->clave_catas;
            $sup_terr = $predio->superficie_terreno;
            $sup_const = $predio->superficie_construccion;
            $tipo_predio = $predio->tipo_predio;
/*            $xmin = $predio->xmin-($predio->xmin*0.1);
            $ymin = $predio->ymin-($predio->ymin*0.1);
            $xmax = $predio->xmax+($predio->xmax*0.1);
            $ymax = $predio->ymax+($predio->ymax*0.1); */
            $xmin = $predio->xmin-10;
            $ymin = $predio->ymin-20;
            $xmax = $predio->xmax+10;
            $ymax = $predio->ymax+20;
            $propietario = "";
            $domicilio = "";
            $id_ubicacion = "";
            $asentamiento = "";
            $cuenta = "";

            //buscamos datos de predio (propietario y ubicación) por clave_catastral
            $datosPredio = DB::select('select nombrec, ubicacion, id_ubicacion_fiscal from datospredio where clave = ?', array($clave_completa));
            if (count($datosPredio) != 0) {
                $propietario = $datosPredio[0]->nombrec;
                $domicilio = $datosPredio[0]->ubicacion;
                $id_ubicacion = $datosPredio[0]->id_ubicacion_fiscal;
            }

            //Datos Fiscal (No. de cuenta)
            $datosFiscal = DB::select('select cuenta from fiscal where clave = ?', array($clave_completa));
            if (count($datosFiscal) != 0) {
                $cuenta = $datosFiscal[0]->cuenta;
            }

            // JS objects from map creation
            $strJS  = '"clave_catas":"' . $clave_completa. '", ';
            $strJS .= '"cuenta":"' . $cuenta. '", ';
            $strJS .= '"municipio":"' . $municipio. '", ';
            $strJS .= '"propietario":"' . $propietario. '", ';
            $strJS .= '"domicilio":"' . $domicilio. '", ';
            $strJS .= '"sup_terr":"' . $sup_terr. '", ';
            $strJS .= '"sup_const":"' . $sup_const. '", ';
            if($tipo_predio == "U"){
                $strJS .= '"tipo_predio":"Urbano"';
            }else{
                $strJS .= '"tipo_predio":"Rural"';
            }

            $_REQUEST["mapW"] = 200;
            $_REQUEST["mapH"] = 200;
            $_REQUEST["GEOEXT"][0] = $xmin ;
            $_REQUEST["GEOEXT"][1] = $ymin ;
            $_REQUEST["GEOEXT"][2] = $xmax ;
            $_REQUEST["GEOEXT"][3] = $ymax ;
            $_REQUEST["groups"] = array("predios");

            // CREATE NEW MAP
            $pmap = new PMAP($map);
            $pmap->pmap_create();

            $mapURL      = $pmap->pmap_returnMapImgURL();

            // Serialize url_points
            $urlPntStr = '';

            // return JS object literals "{}" for XMLHTTP request
            echo "{\"sessionerror\":\"query\",  \"mapURL\":\"$mapURL\",".$strJS."}";
        }
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