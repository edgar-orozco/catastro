<?php
error_reporting(E_ERROR | E_WARNING);
use \PlanoAcotado;

class PlanoAcotadoController extends BaseController {
    var $escala;


    public function index($id = null) {
        $ent = substr($id, 0, 2);
        $mun = substr($id, 3, 3);
        $clave_catas = substr($id, 7, 15);
               
        $predios = predios::where('clave_catas', '=',$clave_catas)
                          ->where('municipio','=',$mun)
                          ->first();
        
        $usosuelo = predios::join('tiposusosuelo','predios.uso_suelo','=','tiposusosuelo.id')
                           ->where('predios.municipio','=',$mun)
                           ->where('predios.clave_catas','=',$clave_catas)
                           ->select('tiposusosuelo.descripcion')
                           ->first();
                           
        $localidad = predios::join('municipios', function($join){
                                $join->on('municipios.entidad','=','predios.entidad');
                                $join->on('municipios.municipio', '=', 'predios.municipio');
                            })
                            ->join('entidades','predios.entidad','=','entidades.entidad')
                            ->where('predios.clave_catas', '=',$clave_catas)
                            ->where('predios.municipio','=',$mun)
                            ->select('entidades.nom_ent', 'municipios.nombre_municipio')
                            ->first();

        $fiscal = fiscal::where('clave','=',$id)
                        ->first();
         
        $datospredio = DB::SELECT("SELECT nombrec, ubicacion FROM datospredio  WHERE clave =('$id')");    
        foreach ($datospredio as $row) {
            $nombre = explode(",", $row->nombrec);
            $ubicacion = $row->ubicacion;            
        }
                
        $dumpPoints = DB::SELECT("SELECT (ST_DumpPoints(geom)).Path[3] as path, 
                                ST_x((ST_DumpPoints(geom)).geom) as x, 
                                ST_y((ST_DumpPoints(geom)).geom) as y,
                                ST_AsLatLonText(ST_Transform((ST_DumpPoints(geom)).geom, 4326), 'D_M''S.SSS\"C') as lat_lon,
                                ST_X(ST_AsText(ST_Transform((ST_DumpPoints(geom)).geom, 4326))) as dlongitud,
                                ST_Y(ST_AsText(ST_Transform((ST_DumpPoints(geom)).geom, 4326))) as dlatitud
                                FROM predios 
                                WHERE entidad = '$ent'
                                AND municipio = '$mun'
                                AND clave_catas = '$clave_catas'"); 

        $i = 0;
        $max = count($dumpPoints);
        foreach ($dumpPoints as $row) {
            $vertice = new PlanoAcotado();
            $i = sizeof($planoacotado);
            
            $vertice->set_id($i);
            $vertice->set_est($row->path - 1);
            if ($i==0){
                $vertice->set_pv(0);                
            }
            else{
                if ($i==$max-1)
                {
                    $vertice->set_pv(1);
                }
                else{
                    $vertice->set_pv($row->path);
                }        
            }
            $vertice->set_x($row->x);
            $vertice->set_y($row->y);
            
            
            if ($i==0){
                $vertice->set_azimut(0);
            }
            else{
                //Cálcula el rumbo y el azimut de cada vértice.
                //Variables afectadas de la clase PlanoAcotado: $azimut, $rumbo, $rumbo_x, $rumbo_y
                $vertice->calculate_rumbo($planoacotado[$i-1]->get_x(),$planoacotado[$i-1]->get_y(),$vertice->get_x(),$vertice->get_y());
                
                //Cálcula la distancia entre un vértice i y el vértice i+1
                $vertice->calculate_distancia($planoacotado[$i-1]->get_x(),$planoacotado[$i-1]->get_y(),$vertice->get_x(),$vertice->get_y());
            }
            
            $vertice->set_convergencia(0);
            $vertice->set_factor(0);
            $lat_lon = explode(" ", $row->lat_lon);
            $vertice->set_latitud($lat_lon[0]);
            $vertice->set_longitud($lat_lon[1]);
            $vertice->calculate_convergencia($row->dlatitud,$row->dlongitud);
            
            $planoacotado[$i]=$vertice;
        }
        
        //Cálcula la superficie del predio 
        $planoacotado[0]->calculate_superficie($planoacotado);
        $planoacotado[0]->calculate_perimetro($planoacotado);
                 
        $meses = array("ENERO","FEBRERO","MARZO","ABRIL","MAYO","JUNIO","JULIO",
                       "AGOSTO","SEPTIEMBRE","OCTUBRE","NOVIEMBRE","DICIEMBRE");       
        $fecha = $meses[date('n')-1]." ".date("Y");
        
        $supconst = 1;
        $suplibre = 2;
        $suptotal = 3;
        $superficie = array($supconst,$suplibre,$suptotal);
        
        $caracteristicas = array(
                        'CIMENTACION DE CONCRETO ARMADO',
                        'MUROS DE BLOCK MACIZO',
                        'LOSA DE AZOTE DE CONCRETO ARMADO',
                        'PISO DE CEMENTO PULIDO',
                        'VENTANAS DE HERRERIA TIPO PERSIANA',
                        'PUERTAS DE HERRERIA',
                        'INSTALACION ELECTRICA Y SANITARIA OCULTA'
                        );
        
        $imgPlanoAcotado = $this->getImgPlanoAcotado($id, $planoacotado);
        $imgCroquis = $this->getImgCroquis($id);
        $escala = $this->escala;
        
                           
        $vista = View::make('cartografia.datos_PlanoAcotadoPDF',
                            compact('id', 'predios', 'mun', 'ubicacion', 'nombre', 'usosuelo', 'superficie', 'caracteristicas', 'fecha',  
                                    'fiscal', 'datospredio', 'localidad', 'planoacotado', 'imgPlanoAcotado', 'imgCroquis', 'escala'));
        $vistastr = $vista->render();
        $pdf = PDF::load($vistastr, 'Letter', 'landscape')->show("PlanoAcotadoPDF");
        
        $response = Response::make($pdf, 200);
        
        $response->header('Content-Type', 'application/pdf');
        return $response;
    }
    
    private function getImgCroquis($id = null){                     
        /**
         * Entidad-Municipio-Zona-Manzana-Predio 
         * (XX-XXX-XXX-XXXX-XXXXX)
        */ 
        $ent = substr($id, 0, 2);
        $mun = substr($id, 3, 3);
        $zon = substr($id, 7, 3);
        $man = substr($id, 11, 4);
        $clave_catas = substr($id, 7, 15);
        
        //Buscamos Manzana por ID
        $regManzana = DB::SELECT("SELECT ST_xmin(geom) as xmin, 
                                         ST_ymin(geom) as ymin, 
                                         ST_xmax(geom) as xmax, 
                                         ST_ymax(geom) as ymax 
                                  FROM manzanas 
                                  WHERE entidad = '$ent'
                                  AND municipio = '$mun'
                                  AND zona      = '$zon'
                                  AND manzana   = '$man'");
    
        if (count($regManzana) != 0) {
            $xmin = $regManzana[0]->xmin-10;
            $ymin = $regManzana[0]->ymin-10;
            $xmax = $regManzana[0]->xmax+10;
            $ymax = $regManzana[0]->ymax+10;
        }
        else{
            //Buscamos Predio por ID
            $regPredio = DB::SELECT("SELECT ST_xmin(geom) as xmin, 
                                             ST_ymin(geom) as ymin, 
                                             ST_xmax(geom) as xmax, 
                                             ST_ymax(geom) as ymax 
                                     FROM predios 
                                     WHERE entidad = '$ent'
                                     AND municipio = '$mun'
                                     AND clave_catas = '$clave_catas'");
            if (count($regPredio) == 0) {
                return 'mapper/images/nofoto-770x345.jpg';
            }
            $xmin = $regPredio[0]->xmin - 10;
            $ymin = $regPredio[0]->ymin - 10;
            $xmax = $regPredio[0]->xmax + 10;
            $ymax = $regPredio[0]->ymax + 10;
        }
                
        $PM_MAP_FILE = "/var/www/html/cartografia/mapfiles/MzaPredio.map";
        $map = ms_newMapObj($PM_MAP_FILE);
        $scaleLayers = 1;
                
        //Configuramos la conexion de datos del mapa
        $conn = Config::get('database.connections.pgsql');
        $host = $conn['host'];
        $database = $conn['database'];
        $username = $conn['username'];
        $password = $conn['password'];
        $connectionString = "user='$username' password='$password' dbname='$database' host=$host port=5432"; 
        
        //Configuramos las capas       
        $layer = $map->getLayerByName('calles');
        $layer->set("connection", $connectionString);
        
        $layer = $map->getLayerByName('Manzanas');
        $layer->set("connection", $connectionString);
        
        //Filtramos el predio
        $layer = $map->getLayerByName('Predios');
        $layer->set("connection", $connectionString);
        $layer->setFilter("clave_catas = '$clave_catas'");
        
        //Creamos el mapa
        $map->setextent($xmin,$ymin,$xmax,$ymax);
        $img = $map->prepareImage();
        $image=$map->draw();
        $mapURL=$image->saveWebImage();
         
        return substr($mapURL, 1, strlen($mapURL));
    }
    
    
    private function getImgPlanoAcotado($id = null, $planoacotado){                     
        /**
         * Entidad-Municipio-Zona-Manzana-Predio 
         * (XX-XXX-XXX-XXXX-XXXXX)
        */ 
        $ent = substr($id, 0, 2);
        $mun = substr($id, 3, 3);
        $zon = substr($id, 7, 3);
        $man = substr($id, 11, 4);
        $clave_catas = substr($id, 7, 15);
        
        //Buscamos Predio por ID
        $regPredio = DB::SELECT("SELECT ST_xmin(geom) as xmin, 
                                              ST_ymin(geom) as ymin, 
                                              ST_xmax(geom) as xmax, 
                                              ST_ymax(geom) as ymax 
                                       FROM predios 
                                       WHERE entidad = '$ent'
                                       AND municipio = '$mun'
                                       AND clave_catas = '$clave_catas'");
        if (count($regPredio) == 0) {
            return 'mapper/images/nofoto-770x345.jpg';
        }
        $xmin = $regPredio[0]->xmin - 1.5;
        $ymin = $regPredio[0]->ymin - 1.5;
        $xmax = $regPredio[0]->xmax + 1.5;
        $ymax = $regPredio[0]->ymax + 1.5;
                
        $PM_MAP_FILE = "/var/www/html/cartografia/mapfiles/PlanoAcotado.map";
        $map = ms_newMapObj($PM_MAP_FILE);
        //$scaleLayers = 5;
                
        //Configuramos la conexion de datos del mapa
        $conn = Config::get('database.connections.pgsql');
        $host = $conn['host'];
        $database = $conn['database'];
        $username = $conn['username'];
        $password = $conn['password'];
        $connectionString = "user='$username' password='$password' dbname='$database' host=$host port=5432"; 
        
        //Configuramos las capas
        $layer = $map->getLayerByName('Colindacias');
        $layer->set("connection", $connectionString);
               
        $layer = $map->getLayerByName('Predios');
        $layer->set("connection", $connectionString);
        $layer->setFilter("clave_catas = '$clave_catas'");
        
        $layer = $map->getLayerByName('Construcciones');
        $layer->set("connection", $connectionString);
        $layer->setFilter("clave_catas = '$clave_catas'");

        /*$layer = $map->getLayerByName('Medidas');
        $layer->set("connection", $connectionString);
        $layer->setFilter("clave_catas = '$clave_catas'");
*/
          
  /*      $layer = $map->getLayerByName('Vertices');
        $layer->set("connection", $connectionString);
        $layer->setFilter("clave_catas = '$clave_catas'");
    
    */    


        $layer = $map->getLayerByName('Vertices');
        $numVert = 0;
        $vertices = sizeof($planoacotado);

        foreach ($planoacotado as $vertice) {
            $numVert++;
            if($numVert == $vertices) break;

            $point = ms_newPointObj();
            $point->setXY($vertice->get_x(), $vertice->get_y());

            $line = ms_newLineObj();
            $line->add($point);

            $pointShape = ms_newShapeObj(MS_SHAPE_POINT);
            $pointShape->add($line);
            $pointShape->set("text", $numVert);

            $layer->addFeature($pointShape);            
        }

        //Creamos el mapa
        $map->setextent($xmin,$ymin,$xmax,$ymax);
        $img = $map->prepareImage();
        $image=$map->draw();
        $this->escala = "1:".round($map->scaledenom);
        $mapURL=$image->saveWebImage();
         
        return substr($mapURL, 1, strlen($mapURL));
    }
    
}