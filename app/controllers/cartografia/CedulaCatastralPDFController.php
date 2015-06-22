<?php

error_reporting(E_ERROR | E_WARNING);

class cedulaCatastralPDFController extends BaseController {

    public function getdatos() {
        return View::make('complementarios.Form-complementariosPDF');
    }

    public function index($id = null, $img = null, $dir = null, $num = null) {

//        echo $id;
        $mun = substr($id, 3, -16);
        $loc = str_replace('-', ' ', $num);
        $localidad = explode(' ', $loc);
        $clave_catas = substr($id, 7, 15);
        $numpredio = substr($id, -6);
        $predios = predios::WHERE('clave_catas', '=', $clave_catas)->Where('municipio','=',$mun)->get();
//        foreach ($predios as $predio) {
//            $entidad = $predio->entidad;
//            $municipio = $predio->municipio;
//            $cla = $predio->clave_catas;
//        }
//        
//      echo   $clave = $entidad . '-' . $municipio . '-' . $cla;+
  
               
        $clave = substr($id, 7, 15);
        $prop = DB::SELECT("SELECT datos_propietarios('$clave')");
        foreach ($prop as $row) {
            $item = explode(",", $row->datos_propietarios);
        }
        $item = DB::SELECT("SELECT nombrec FROM datospredio  WHERE clave =('$id')");
        foreach ($item as $row) {
            $nombre = explode(",", $row->nombrec);
        }
//        print_r($nombre);
//        $clave_catas = $predios->clave_catas;
//        $centroide= DB::SELECT('SELECT ST_Centroid(geom)  FROM manzanas');
        //$lat=DB::SELECT("SELECT st_xmin(geom)-5 as xmin, st_ymin(geom)-5 as ymin, st_xmax(geom)+5 as xmax, st_ymax(geom)+5 as ymax    FROM predios WHERE clave_catas='$clave_catas'");
        $lat = DB::SELECT("select ST_AsLatLonText(st_centroid(geom), 'D°M\''S.SSS\"C') as lat_long from predios where clave_catas = '$clave_catas' and municipio = '$mun'");
        $condominio = condominios::WHERE('clave_catas', '=', $clave_catas)->get();
        $imagenes = ImagenesLevantamiento::WHERE('clave_catas', '=', $clave_catas)->select('nombre_archivo')->get();
        $vista = View::make('complementarios.datos_complemetarios_PDF', compact('predios', 'nombre', 'condominio', 'imagenes', 'img', 'localidad','dir', 'numpredio', 'lat'));
        $pdf = PDF::load($vista)->show("DatosComplementariosPDF");
        $response = Response::make($pdf, 200);
        $response->header('Content-Type', 'application/pdf');
        return $response;
//        return $vista;
    }

    public function getanexos() {
        return View::make('complementarios.form-anexos');
    }

    public function anexos() {
        $clave_catas = Input::get('clave');
        $predios = predios::WHERE('clave_catas', '=', $clave_catas)->get();
        $vista = View::make('complementarios.anexos-pdf', compact('predios'));
        $pdf = PDF::load($vista)->show("AnexosPDF");
        $response = Response::make($pdf, 200);
        $response->header('Content-Type', 'application/pdf');
        return $response;
//        return $vista;
    }

}
