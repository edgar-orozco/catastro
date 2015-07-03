<?php

error_reporting(E_ERROR | E_WARNING);

class complementarios_ComplementariosPDFController extends BaseController {

    public function getanexos() {
        
        $municipios = Municipio::orderBy('nombre_municipio', 'ASC')->lists('nombre_municipio', 'municipio');
        return View::make('complementarios.form-anexos', compact('municipios'));
    }

    public function anexos($id = null) {
        $clave_catas = Input::get('clave');
        $mun = Input::get('municipio');
        $PM_MAP_FILE = "/var/www/html/geografica/MzaPredio.map";
        $map = ms_newMapObj($PM_MAP_FILE);
        $scaleLayers = 1;

        //Buscamos predio por geolocalización
        $registrosPredio = DB::select("select entidad, gid, municipio, clave_catas, tipo_predio, superficie_terreno, superficie_construccion , st_xmin(geom) as xmin, st_ymin(geom) as ymin, st_xmax(geom) as xmax, st_ymax(geom) as ymax from predios where clave_catas='$clave_catas'");

        $predio = $registrosPredio[0];
        $gid_predio = $predio->gid;
        $entidad = $predio->entidad;
        $mun = $predio->municipio;
        $clave_catas = $predio->clave_catas;
        $clave_completa = $predio->entidad . "-" . $mun . "-" . $predio->clave_catas;
        $sup_terr = $predio->superficie_terreno;
        $sup_const = $predio->superficie_construccion;
        $tipo_predio = $predio->tipo_predio;
        $lat_lon = explode(" ", $predio->lat_lon);
        $latitud = $lat_lon[0];
        $longitud = $lat_lon[1];

        //si no encontró manzana tomamos el extent del predio
        if ($extentMza == 0) {
            $xmin = $predio->xmin - 10;
            $ymin = $predio->ymin - 10;
            $xmax = $predio->xmax + 10;
            $ymax = $predio->ymax + 10;
        }

        $propietario = "";
        $domicilio = "";
        $id_ubicacion = "";
        $asentamiento = "";
        $cuenta = "";
        //buscamos datos de predio (propietario y ubicación) por clave_catastral
        $datosPredio = DB::select("select nombrec, ubicacion, id_ubicacion_fiscal from datospredio where clave ='27-008" . $clave_catas . "'");
        if (count($datosPredio) != 0) {
            $propietario = $datosPredio[0]->nombrec;
            $domicilio = $datosPredio[0]->ubicacion;
            $id_ubicacion = $datosPredio[0]->id_ubicacion_fiscal;
        }

        //Datos Fiscal (No. de cuenta)
        $datosFiscal = DB::select("select cuenta from fiscal where clave = ?", array($clave_completa));
        if (count($datosFiscal) != 0) {
            $cuenta = $datosFiscal[0]->cuenta;
        }


        //Imagen de la Fachada del predio. Consulta
        $fachadas = ImagenesLevantamiento::where(function($consult) {
                    $consult->where('id_tipoimagen', 1)->orwhere('id_tipoimagen', 2);
                })
                ->where('municipio', $municipio)
                ->where('gid_predio', $gid_predio)
                ->get();


        // JS objects from map creation
        $strJS = '"clave_catas":"' . $clave_catas . '", ';
        $strJS .= '"cuenta":"' . $cuenta . '", ';
        $strJS .= '"municipio":"' . $mun . '", ';
        $strJS .= '"propietario":"' . $propietario . '", ';
        $strJS .= '"domicilio":"' . $domicilio . '", ';
        $strJS .= '"sup_terr":"' . $sup_terr . '", ';
        $strJS .= '"sup_const":"' . $sup_const . '", ';
        $strJS .= '"latitud":"' . $latitud . '", ';
        $strJS .= '"longitud":"' . $longitud . '", ';
        $strJS .= '"url_imagen":"' . $fachada . '", ';
        if ($tipo_predio == "U") {
            $strJS .= '"tipo_predio":"Urbano"';
        } else {
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
        // creamos el mapa
        $map->setextent($xmin, $ymin, $xmax, $ymax);
        $img = $map->prepareImage();
        $image = $map->draw();
        $mapURL = $image->saveWebImage();

        // Serialize url_points
        $urlPntStr = '';

        $predios = predios::WHERE('clave_catas', '=', $clave_catas)->Where('municipio', '=', '008')->get();
        $localidad = DB::select("SELECT nombrec, ubicacion, id_ubicacion_fiscal FROM datospredio WHERE clave = '27-$mun-" . $clave_catas . "'");
        $lat = DB::SELECT("SELECT ST_AsLatLonText(st_centroid(geom), 'D°M\''S.SSS\"C') AS lat_long FROM predios WHERE clave_catas = '$clave_catas' AND municipio = '$mun'");
        $centros = DB::SELECT("SELECT st_centroid(geom) AS centro FROM predios WHERE clave_catas = '$clave_catas' AND municipio = '$mun'");
        $id_p = DB::SELECT("SELECT * FROM propietarios WHERE clave ='27-$mun-$clave_catas'");
        foreach ($id_p as $p) {
            $personas = $p->id_propietario;
        }
        $totalp = DB::SELECT("SELECT count(id_p) as total FROM personas WHERE id_p='$personas'");
        $rfc = DB::SELECT("SELECT rfc,curp FROM personas WHERE id_p='$personas'");
        $niveles = DB::SELECT("SELECT MAX(nivel) AS numnivel FROM construcciones WHERE clave_catas ='$clave_catas'");
        $super = DB::SELECT("SELECT * FROM condominios WHERE clave_catas ='$clave_catas'");
        $vista = View::make('complementarios.anexos-pdf', compact('predios', 'localidad', 'lat', 'mapURL', 'centros', 'totalp', 'rfc', 'niveles', 'super'));
        $pdf = PDF::load($vista)->show("AnexosPDF");
        $response = Response::make($pdf, 200);
        $response->header('Content-Type', 'application/pdf');
        return $response;
//        return $vista;
    }

}
