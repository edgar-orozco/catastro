<?php

use \PMap;

class MapLoadController extends \BaseController {
	public function store(){
	   
        $PM_MAP_FILE = "/var/www/html/Tabasco.map";
        $map = ms_newMapObj($PM_MAP_FILE);
        $scaleLayers = 1;       
	   
        // CREATE NEW MAP
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
        $strJS .= '"refH":"' . $mapJS['refH'] . '", ';
        $strJS .= '"minx_geo":"' . $mapJS['minx_geo'] . '", ';
        $strJS .= '"maxy_geo":"' . $mapJS['maxy_geo'] . '", ';
        $strJS .= '"xdelta_geo":"' . $mapJS['xdelta_geo'] . '", ';
        $strJS .= '"ydelta_geo":"' . $mapJS['ydelta_geo'] . '", ';
        $strJS .= '"refBoxStr":"' . $mapJS['refBoxStr'] . '" ';
        
        
        // Serialize url_points
        $urlPntStr = '';
        
        // return JS object literals "{}" for XMLHTTP request 
        echo "{\"sessionerror\":\"false\",  \"mapURL\":\"$mapURL\", \"scalebarURL\":\"$scalebarURL\", \"geo_scale\":\"$geo_scale\"}";
    
	}    

}
?>