<?php

use \PMap;

class ConsultaAlfaCorevatController extends \BaseController {
	public function store(){

        $tipoQuery = $_REQUEST["query"];

        $type = $_REQUEST["variables"][0];
        $mun = $_REQUEST["variables"][1];

        $arr1 = $this->getQuery($type,$mun);

        // echo "{\"sessionerror\":\"QueryError\","."Error: ".$arr1."}";
        // return;

        if ( $arr1 == '' ){
            $strJS = '"msgError":"No se encontraron datos."';
            echo "{\"sessionerror\":\"QueryError\"," . $strJS . "}";
            return;
        }

        $PM_MAP_FILE = "/var/www/html/cartografia/mapfiles/TabascoCorevat.map";
        $map = ms_newMapObj($PM_MAP_FILE);
        $scaleLayers = 1;
        $mapW = $_REQUEST["mapW"];
        $mapH = $_REQUEST["mapH"];
        $municipio = $_REQUEST["variables"][0];
        $clave_catas = $_REQUEST["variables"][1];

        if ( intval($mun) <= 0 ){
            $result = DB::select("select st_xmin(p.geom)-5 as xmin, st_ymin(p.geom)-5 as ymin, st_xmax(p.geom)+5 as xmax, st_ymax(p.geom)+5 as ymax  from predios p where p.clave_catas IN (".$arr1.") "  );
        }else{
            $result = DB::select("select st_xmin(p.geom)-5 as xmin, st_ymin(p.geom)-5 as ymin, st_xmax(p.geom)+5 as xmax, st_ymax(p.geom)+5 as ymax  from predios p where p.municipio = '".$mun."' and p.clave_catas IN (".$arr1.") "  );
        }    

        if (count($result) == 0) {
            $strJS  = '"msgError":"No se encontraron datos: \\n \\nClaves: '.$arr1.'\\nMunicipio: '.$mun.'  "';
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

    private function getQuery($type=0,$municipio="000"){
        switch ($type) {
            case 1:

                $arr0 = Avaluos::select('avaluos.cuenta_catastral')
                            ->leftJoin('avaluo_conclusiones', 'avaluos.idavaluo', '=', 'avaluo_conclusiones.idavaluo')
                            ->leftJoin('municipios', 'avaluos.idmunicipio', '=', 'municipios.idmunicipio')
                            ->where('avaluos.idavaluo', '>', '0')
                            ->where('avaluos.cuenta_catastral', '!=', '')
                            ->orderBy('avaluo_conclusiones.valor_concluido','asc')
                            ->limit(10)
                            ->lists('cuenta_catastral');

                break;
            
            case 2:

                $arr0 = Avaluos::select('avaluos.cuenta_catastral')
                            ->leftJoin('avaluo_conclusiones', 'avaluos.idavaluo', '=', 'avaluo_conclusiones.idavaluo')
                            ->leftJoin('municipios', 'avaluos.idmunicipio', '=', 'municipios.idmunicipio')
                            ->where('avaluos.idavaluo', '>', '0')
                            ->where('avaluos.cuenta_catastral', '!=', '')
                            ->where('municipios.clave', '=', $municipio)
                            ->orderBy('avaluo_conclusiones.valor_concluido','desc')
                            ->limit(10)
                            ->lists('cuenta_catastral');

                break;
                        
            default:

                $arr0 = Avaluos::select('avaluos.cuenta_catastral')
                            ->leftJoin('avaluo_conclusiones', 'avaluos.idavaluo', '=', 'avaluo_conclusiones.idavaluo')
                            ->leftJoin('municipios', 'avaluos.idmunicipio', '=', 'municipios.idmunicipio')
                            ->where('avaluos.idavaluo', '>', '0')
                            ->where('avaluos.cuenta_catastral', '!=', '')
                            ->orderBy('avaluo_conclusiones.valor_concluido','desc')
                            ->limit(10)
                            ->lists('cuenta_catastral');

                break;
        }

        $arr1 = '';            
        foreach ($arr0 as $i => $value) {
            $arr1 .= $arr1 == "" ? "'".$arr0[$i]."'" : ",'".$arr0[$i]."'";
        }        

        return $arr1;

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