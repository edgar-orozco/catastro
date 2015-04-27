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
           
    		$dbconn = pg_connect("host=127.0.0.1 dbname=catastro user=postgres") or die('No se ha podido conectar: ' . pg_last_error());
   			$sql="select m.nombre_municipio, p.clave_catas, p.superficie_terreno, p.tipo_predio, st_xmin(p.geom)-5, st_ymin(p.geom)-5, st_xmax(p.geom)+5, st_ymax(p.geom)+5  from predios p left join municipios m on p.municipio = m.municipio where ST_Contains(p.geom, ST_SetSRID(ST_Point($x_str,$y_str),32615))";
    		
    		$result = pg_query($sql) or die('La consulta fallo: ' . pg_last_error());

    		if ($result && pg_num_rows($result) != 0){
    		    $row = pg_fetch_row($result); 
                $strJS  = '"clave_catas":"' . $row[1]. '", ';
                $strJS .= '"municipio":"' . $row[0]. '", ';
                $strJS .= '"sup_terr":"' . $row[2]. '", ';
                if($row[3] == "U"){
                    $strJS .= '"tipo_predio":"Urbano"';
                }else{
                    $strJS .= '"tipo_predio":"Rural"';
                }
                
                $_REQUEST["mapW"] = 200;
                $_REQUEST["mapH"] = 200;
                $_REQUEST["GEOEXT"][0] = $row[4] ;                                                
                $_REQUEST["GEOEXT"][1] = $row[5] ;
                $_REQUEST["GEOEXT"][2] = $row[6] ;
                $_REQUEST["GEOEXT"][3] = $row[7] ;
                $_REQUEST["groups"] = array("predios");                
                
                // CREATE NEW MAP
                $pmap = new PMAP($map);
                $pmap->pmap_create();
                
                $mapURL      = $pmap->pmap_returnMapImgURL();
               
                // Serialize url_points
                $urlPntStr = '';
        
                // return JS object literals "{}" for XMLHTTP request 
                echo "{\"sessionerror\":\"query\",  \"mapURL\":\"$mapURL\",".$strJS."}";
            }else{
                echo "{\"sessionerror\":\"true\"}";
            }
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