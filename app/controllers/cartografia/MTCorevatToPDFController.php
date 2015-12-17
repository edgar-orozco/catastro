<?php

error_reporting(E_ERROR | E_WARNING);

ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
ini_set('default_socket_timeout', 6000);

// setlocale(LC_ALL, 'es_MX.UTF-8');

use \PMap;
use Carbon\Carbon;

require('MTCorevatFPDF.php');

class MTCorevatToPDFController extends BaseController {
    private $xmin = 0;
    private $ymin = 0;
    private $xmax = 0;
    private $ymax = 0;
    private $init = true;
    private $escala;
    private $rangos;
    private $colores_rangos;
    private $localidades = "";



    public function store() {
        $PM_MAP_FILE = "/var/www/html/cartografia/mapfiles/TabascoCorevat.map";
        $map = ms_newMapObj($PM_MAP_FILE);
        $scaleLayers = 1;
        $mapW = $_REQUEST["mapW"];
        $mapH = $_REQUEST["mapH"];

        $ids   = explode(',',$_REQUEST["oIDS"]);
        $ars   = explode(',',$_REQUEST["oARS"]);
        $mun   = $_REQUEST["oMun"];
        $toPDF = $_REQUEST["oToPDF"];

        $arLayer     = array('pink','orange','green','blue','predio_ubicado_1','cafe');
        $arItemQuery = array(2,3,4,5,6,7);
        $IsQuery = true;

        for ($i=0; $i<count($ids); ++$i) {
            $arr1 = $this->getQuery(2,$mun,$ars[$i]);
            // echo "{\"sessionerror\":\"QueryError\","."Error: ".$arr1."}";
            // return;
            if ( $arr1 != '' ){
                $layer = $map->getLayerByName($arLayer[$ids[$i]]);
                $layer = $this->createLayerFromClaveCatasWithAvaluos($arr1, $mun, 0, $layer);                
                $IsQuery = false;
            }

        }

        if ( $IsQuery ){
            $strJS  = '"msgError":"No se encontraron datos: \\n \\nClaves: '.$arr1.'\\nMunicipio: '.$mun.'  "';
            echo "{\"sessionerror\":\"QueryError\",".$strJS."}";
            return;
        }

        $_REQUEST["extent"] = ($this->xmin - 1.5) . "+" . ($this->ymin - 1.5) . "+" . ($this->xmax + 1.5) . "+" . ($this->ymax + 1.5);

        $pmap = new PMAP($map); 
        $pmap->pmap_create();

        $mapURL      = $pmap->pmap_returnMapImgURL();
        $scalebarURL = $pmap->pmap_returnScalebarImgURL();
        $mapJS       = $pmap->pmap_returnMapJSParams();
        $mapwidth    = $pmap->pmap_returnMapW();
        $mapheight   = $pmap->pmap_returnMapH();
        $geo_scale   = $pmap->pmap_returnGeoScale();
        $escala = "1:".round($geo_scale);

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


        echo "{\"sessionerror\":\"false\",  \"mapURL\":\"$mapURL\", \"scalebarURL\":\"$mapURL\", \"geo_scale\":\"$mapURL\", \"escala\":\"$escala\", \"municipio\":\"$mun\", \"localidades\":\"$this->localidades\",".$strJS."}";

    }

    public function index() {

        $mapURL   = $_REQUEST["mapURL"];
        $escala = $_REQUEST["escala"];

                          
        $vista = View::make('cartografia.MTCorevat',
                            compact('mapURL', 'escala'));

        $vistastr = $vista->render();
        $pdf = PDF::load($vistastr, 'Letter', 'landscape')->show("MTCorevat");
        
        $response = Response::make($pdf, 200);
        
        $response->header('Content-Type', 'application/pdf');

        return $response;

    }

    public function printMT(){


    $pdf = new MTCorevatFPDF('L','mm','Letter');
    $pdf->mapURL = public_path() . $_POST["mapURL"];
    $pdf->escala = $_POST["escala"];
    $pdf->rangos = explode(',',$_POST["rangos"]);
    $pdf->colores = explode(',',$_POST["colores"]);

    $munn = $_POST["municipio"];
    $mun = Municipios::select('idmunicipio','municipio')->where('clave', '=', $munn)->get();
    $pdf->municipio =  strtoupper($mun[0]->municipio);
    $idmun = $mun[0]->idmunicipio;
    
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetX(0);
    $pdf->SetY(0);

    if (file_exists($pdf->mapURL)) {
        $pdf->Image($pdf->mapURL, 5, 35, 200, 140);
    }else{

    }

    $pdf->RoundedRect(5, 5, 200, 205, 2, '1234', '');

    $pdf->Image( public_path() . "/css/images/main/main-logo.gif", 207, 5, 32, 16);
    $pdf->Image( public_path() . "/css/images/home/secrt.gif", 239, 5, 20, 16);
    $pdf->Image( public_path() . "/css/images/main/logo-header.gif", 259, 5, 16, 16);

    $line = 30;
    $pdf->RoundedRect(207, $line, 67, 10, 1, '1234', 'FD');
    $pdf->Ln(0);
    $pdf->SetY($line+2);
    $pdf->SetX(207);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(67, 6, utf8_decode('A V A L U O S'), '', 1, 'C', 0);

    $pdf->SetFillColor(224, 224, 224);

    $line = 45;
    $pdf->RoundedRect(207, $line, 67, 8, 1, '12', 'FD');
    $pdf->Ln(0);
    $pdf->SetY($line + 1);
    $pdf->SetX(207);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(67, 6, 'MUNICIPIO', '', 1, 'C', 0);
    $pdf->SetFont('Arial', '', 10);

    $pdf->RoundedRect(207, $line+8, 67, 10, 1, '', '');    
    $pdf->SetY( $pdf->getY() + 3 );
    $pdf->Ln(0);
    $pdf->SetX(208);
    $pdf->SetFillColor(255,255,255);
    $pdf->Cell(65, 6, $pdf->municipio, '', 1, 'C', 1);


    $pdf->SetFillColor(224, 224, 224);

    $line = 65;
    $pdf->RoundedRect(207, $line, 67, 8, 1, '12', 'FD');
    $pdf->Ln(0);
    $pdf->SetY($line + 1);
    $pdf->SetX(207);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(67, 6, 'ESTADO', '', 1, 'C', 0);
    $pdf->SetFont('Arial', '', 10);

    $pdf->RoundedRect(207, $line+8, 67, 10, 1, '', '');    
    $pdf->SetY( $pdf->getY() + 3 );
    $pdf->Ln(0);
    $pdf->SetX(208);
    $pdf->SetFillColor(255,255,255);
    $pdf->Cell(65, 6, 'TABASCO', '', 1, 'C', 1);

    $pdf->SetFillColor(224, 224, 224);
    $line = 85;
    $pdf->RoundedRect(207, $line, 67, 8, 1, '12', 'FD');
    $pdf->Ln(0);
    $pdf->SetY($line + 1);
    $pdf->SetX(207);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(67, 6, 'VALORES', '', 1, 'C', 0);
    $pdf->SetFont('Arial', '', 10);

    $pdf->RoundedRect(207, $line + 8, 67, ( 10 * count( $pdf->rangos ) ), 1, '', '');    
    $pdf->SetFillColor(255,255,255);
    for($i=0;$i<count( $pdf->rangos ); $i++){
        $pdf->SetY( $pdf->getY() + 4 );
        $pdf->Ln(0);
        $pdf->SetX(208);
        $_x = $pdf->getX();
        $_y = $pdf->getY();
        $rgb = $pdf->hex2rgb("#".$pdf->colores[$i]);
        $pdf->SetFillColor($rgb[0],$rgb[1],$rgb[2]);        
        $pdf->RoundedRect($_x, $_y, 5, 5, 1, '', 'DF');    
        $pdf->SetFillColor(255,255,255);
        $pdf->SetX(217);
        $rng = explode('-',$pdf->rangos[$i]);
        $rango = "DE ".number_format($rng[0], 2, '.', ',').' A '.number_format($rng[1], 2, '.', ',');
        $pdf->Cell(40, 6, $rango, '', 1, 'L', 1);
    }

    $pdf->SetFillColor(224, 224, 224);

    $line = $pdf->getY()+3;
    $pdf->RoundedRect(207, $line, 67, 8, 1, '12', 'FD');
    $pdf->Ln(0);
    $pdf->SetY($line + 1);
    $pdf->SetX(207);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(67, 6, 'ESCALA', '', 1, 'C', 0);
    $pdf->SetFont('Arial', '', 10);

    $pdf->RoundedRect(207, $line+8, 67, 10, 1, '', '');    
    $pdf->SetY( $pdf->getY() + 3 );
    $pdf->Ln(0);
    $pdf->SetX(208);
    $pdf->SetFillColor(255,255,255);
    $pdf->Cell(65, 6, $pdf->escala, '', 1, 'C', 1);


    $pdf->Output();

    }

    private function getQuery($type=0,$municipio="",$strrange='-'){
        switch ($type) {
            case 1:

                $arr0 = Avaluos::select('avaluos.cuenta_catastral')
                            ->leftJoin('avaluo_conclusiones', 'avaluos.idavaluo', '=', 'avaluo_conclusiones.idavaluo')
                            ->leftJoin('municipios', 'avaluos.idmunicipio', '=', 'municipios.idmunicipio')
                            ->where('avaluos.idavaluo', '>', '0')
                            ->where('avaluos.cuenta_catastral', '!=', '')
                            ->orderBy('avaluo_conclusiones.valor_concluido','asc')
                            ->limit(5)
                            ->lists('cuenta_catastral');

                break;
            
            case 2:

                $range = explode('-',$strrange);
                $arr0 = Avaluos::select('avaluos.cuenta_catastral')
                            ->leftJoin('avaluo_conclusiones', 'avaluos.idavaluo', '=', 'avaluo_conclusiones.idavaluo')
                            ->leftJoin('municipios', 'avaluos.idmunicipio', '=', 'municipios.idmunicipio')
                            ->where('avaluo_conclusiones.valor_concluido', '>', $range[0])
                            ->where('avaluo_conclusiones.valor_concluido', '<=', $range[1])
                            ->where('avaluos.cuenta_catastral', '!=', '')
                            ->where('municipios.clave', '=', $municipio)
                            ->orderBy('avaluos.idavaluo','desc')
                            ->limit(60)
                            ->lists('cuenta_catastral');

                break;

            case 3:


            default:

                $arr0 = Avaluos::select('avaluos.cuenta_catastral')
                            ->leftJoin('avaluo_conclusiones', 'avaluos.idavaluo', '=', 'avaluo_conclusiones.idavaluo')
                            ->leftJoin('municipios', 'avaluos.idmunicipio', '=', 'municipios.idmunicipio')
                            ->where('avaluos.idavaluo', '>', '0')
                            ->where('avaluos.cuenta_catastral', '!=', '')
                            ->orderBy('avaluo_conclusiones.valor_concluido','desc')
                            ->limit(5)
                            ->lists('cuenta_catastral');

                break;
        }

        $mun = Municipios::select('idmunicipio','municipio')->where('clave', '=', $municipio)->get();

        $arr1 = '';            
        foreach ($arr0 as $i => $value) {
            $arr1 .= $arr1 == "" ? "'".$arr0[$i]."'" : ",'".$arr0[$i]."'";
            $locs = $this->getLocalidad($arr0[$i],$mun[0]->idmunicipio);
            $pos = strpos($this->localidades, $locs);
            if ($pos === false) {
                $this->localidades .= $this->localidades == "" ? $locs : "|".$locs;
            }
            $this->localidades .= $locs;
        }        

        return $arr1;

    }

    function createLayerFromClaveCatasWithAvaluos($arr1, $mun, $type=0, $layer){

        if ( intval($mun) <= 0 ){
            $result = DB::select("select  ST_AsGeoJSON(geom) AS geom, st_xmin(p.geom)-5 as xmin, st_ymin(p.geom)-5 as ymin, st_xmax(p.geom)+5 as xmax, st_ymax(p.geom)+5 as ymax, clave_catas  from predios p where p.clave_catas IN (".$arr1.") "  );
        }else{
            $result = DB::select("select  ST_AsGeoJSON(geom) AS geom, st_xmin(p.geom)-5 as xmin, st_ymin(p.geom)-5 as ymin, st_xmax(p.geom)+5 as xmax, st_ymax(p.geom)+5 as ymax, clave_catas  from predios p where p.municipio = '".$mun."' and p.clave_catas IN (".$arr1.") "  );
        }    

        if (count($result) <= 0) {
            $strJS  = '"msgError":"No se encontraron datos: \\n \\nClaves: '.$arr1.'\\nMunicipio: '.$mun.'  "';
            echo "{\"sessionerror\":\"QueryError\",".$strJS."}";
            return;
        }

        foreach ($result as $k => $value) {

            $row = $result[$k];
            
            if ( $this->init ) {
                $this->xmin = $row->xmin;
                $this->ymin = $row->ymin;
                $this->xmax = $row->xmax;
                $this->ymax = $row->ymax;
                $this->init = false;
            }else{


                $this->xmin = $row->xmin < $this->xmin ? $row->xmin : $this->xmin;
                $this->ymin = $row->ymin < $this->ymin ? $row->ymin : $this->ymin;
                $this->xmax = $row->xmax > $this->xmax ? $row->xmax : $this->xmax;
                $this->ymax = $row->ymax > $this->ymax ? $row->ymax : $this->ymax;
            
            }

            $geom = json_decode($row->geom);

            $layer->setFilter("clave_catas = '".$row->clave_catas."'");
            foreach($geom as $key=>$value){
                if ( $key == "coordinates" ){
                    $coord = $value;
                    $polygon= ms_newShapeObj(MS_SHAPE_POLYGON);
                    foreach($coord as $key=>$value){
                        $coord2 = $value;
                        foreach($coord2 as $key=>$value){    
                            $coord3 = $value;
                            $polyLine = ms_newLineObj();
                            foreach($coord3 as $key=>$value){
                                $coord4 = $value;
                                $polyLine->addXY( $coord4[0], $coord4[1] );
                            }
                            $polygon->add($polyLine);
                            $polygon->set("text",$row->clave_catas);

                        }
                    }
                    $layer->addFeature($polygon);            
                }
            }
        }

        return $layer;

    }

    function getLocalidad($clave_catas,$mun){

        $localidad = predios::join('municipios', function($join){
                                $join->on('municipios.entidad','=','predios.entidad');
                                $join->on('municipios.municipio', '=', 'predios.municipio');
                            })
                            ->join('entidades','predios.entidad','=','entidades.entidad')
                            ->where('predios.clave_catas', '=',$clave_catas)
                            ->where('predios.municipio','=',$mun)
                            ->select('entidades.nom_ent', 'municipios.nombre_municipio')
                            ->get();
        return count($localidad);

    }


 



}