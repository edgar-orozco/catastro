<?php

class ConsultaEspacialPredioController extends \BaseController {
	public function store(){

        $PM_MAP_FILE = "/var/www/html/cartografia/mapfiles/MzaPredio.map";
        $map = ms_newMapObj($PM_MAP_FILE);
        $scaleLayers = 1;       

        if(isset($_REQUEST["mode"]) && $_REQUEST["mode"] == "query"){
            
            $clkpoint = ms_newPointObj();
        	$old_extent = ms_newRectObj();
            $imgxy_str = $_REQUEST["imgxy"];
            $imgxy_arr = explode("+", $imgxy_str);
            if($imgxy_arr[0] == 0 || $imgxy_arr[1] == 0){
                $strJS = '"msgError":"No existe ningún predio en el área seleccionada."';
                echo "{\"sessionerror\":\"QueryError\"," . $strJS . "}";
                return;
            }

            $clkpoint->setXY($imgxy_arr[0],$imgxy_arr[1]);
            $old_extent->setextent($_REQUEST["GEOEXT"][0],$_REQUEST["GEOEXT"][1],$_REQUEST["GEOEXT"][2],$_REQUEST["GEOEXT"][3]);
            $mapW = $_REQUEST["mapW"];
            $mapH = $_REQUEST["mapH"];
        	list($x,$y) = $this->img2map($mapW,$mapH,$clkpoint,$old_extent);
        	$x_str = sprintf("%3.6f",$x);
        	$y_str = sprintf("%3.6f",$y);
            $extentMza = 0;

            //Buscamos mza por geolocalización
            $regManzana = DB::select('select st_xmin(geom) as xmin, st_ymin(geom) as ymin, st_xmax(geom) as xmax, st_ymax(geom) as ymax from manzanas where ST_Contains(geom, ST_SetSRID(ST_Point(?,?),32615))', array($x_str,$y_str));
            if (count($regManzana) != 0) {
                $xmin = $regManzana[0]->xmin-10;
                $ymin = $regManzana[0]->ymin-10;
                $xmax = $regManzana[0]->xmax+10;
                $ymax = $regManzana[0]->ymax+10;
                $extentMza = 1;
            }

            //Buscamos predio por geolocalización
            $registrosPredio = DB::select('select entidad, gid, municipio, clave_catas, tipo_predio, superficie_terreno, superficie_construccion , ST_AsLatLonText(st_centroid(geom), \'D°M\'\'S.SSS\"C\') as lat_lon, st_xmin(geom) as xmin, st_ymin(geom) as ymin, st_xmax(geom) as xmax, st_ymax(geom) as ymax from predios where ST_Contains(geom, ST_SetSRID(ST_Point(?,?),32615))', array($x_str,$y_str));
            if (count($registrosPredio) == 0) {
                $strJS = '"msgError":"No existe ningún predio en el área seleccionada."';
                echo "{\"sessionerror\":\"QueryError\"," . $strJS . "}";
                return;
            }

            $predio = $registrosPredio[0];
            $gid_predio = $predio->gid;
            $entidad = $predio->entidad;
            $municipio = $predio->municipio;
            $clave_catas = $predio->clave_catas;
            $clave_completa = $predio->entidad."-".$predio->municipio."-".$predio->clave_catas;
            $sup_terr = $predio->superficie_terreno;
            $sup_const = $predio->superficie_construccion;
            $tipo_predio = $predio->tipo_predio;
            $lat_lon = explode(" ", $predio->lat_lon);
            $latitud = $lat_lon[0];
            $longitud = $lat_lon[1];

            //si no encontró manzana tomamos el extent del predio
            if($extentMza == 0) {
                $xmin = $predio->xmin - 10;
                $ymin = $predio->ymin - 10;
                $xmax = $predio->xmax + 10;
                $ymax = $predio->ymax + 10;
            }

            //Si viene vacio sup_terr
            if ($sup_terr == "") $sup_terr = "0.00";



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
            

            //Imagen de la Fachada del predio. Consulta
            $fachadas = ImagenesLevantamiento::where(function($consult)
                {
                    $consult->where('id_tipoimagen', 1)->orwhere('id_tipoimagen', 2);
                })
            ->where('municipio', $municipio)
            ->where('gid_predio', $gid_predio)
            ->get();
            
            //Contiene imagen de la fachada?
            if($fachadas->count()!= 0)
            {
                //Recorre cada registro hasta encontrar una imagen valida.
                foreach ($fachadas as $fachada) 
                {
                    $extension = explode('.', $fachada->nombre_archivo);
                    if (in_array(strtolower($extension[1]), array('png', 'jpeg', 'gif', 'bmp', 'vnd.microsoft.icon', 'jpg')))
                    {
                        $fachada = $fachada->nombre_archivo;
                        break;
                    }
                    else
                    {
                        $fachada = '/cartografia/images/nofoto-770x345.jpg';
                    }
                }
                
            }
            else
            {
                $fachada = '/cartografia/images/nofoto-770x345.jpg';
            }


            // JS objects from map creation
            $strJS  = '"clave_catas":"' . $clave_completa. '", ';
            $strJS .= '"cuenta":"' . $cuenta. '", ';
            $strJS .= '"municipio":"' . $municipio. '", ';
            $strJS .= '"propietario":"' . $propietario. '", ';
            $strJS .= '"domicilio":"' . $domicilio. '", ';
            $strJS .= '"sup_terr":"' . $sup_terr. '", ';
            $strJS .= '"sup_const":"' . $sup_const. '", ';
            $strJS .= '"latitud":"' . $latitud. '", ';
            $strJS .= '"longitud":"' . $longitud. '", ';
            $strJS .= '"url_imagen":"' . $fachada. '", ';
            if($tipo_predio == "U"){
                $strJS .= '"tipo_predio":"Urbano"';
            }else{
                $strJS .= '"tipo_predio":"Rural"';
            }

            //configuramos la conexion de datos del mapa
            $conn = Config::get('database.connections.pgsql');
            $host = $conn['host'];
            $database = $conn['database'];
            $username = $conn['username'];
            $password = $conn['password'];
            $connectionString = "user='$username' password='$password' dbname='$database' host=$host port=5432";
            $layer = $map->getLayerByName('Manzanas');
            $layer->set("connection", $connectionString);

            // filtramos el predio
            $layer = $map->getLayerByName('Predios');
            $layer->set("connection", $connectionString);
            $layer->setFilter("clave_catas = '$clave_catas'");

            // Calles
            $layer = $map->getLayerByName('calles');
            $layer->set("connection", $connectionString);
            
            // creamos el mapa
            $map->setextent($xmin,$ymin,$xmax,$ymax);
            $img = $map->prepareImage();
            $image=$map->draw();
            $mapURL=$image->saveWebImage();

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