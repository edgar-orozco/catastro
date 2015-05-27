<?php

error_reporting(E_ERROR | E_WARNING);

class mapper_ComplementariosPDFController extends BaseController {

    public function getdatos() {
        return View::make('complementarios.Form-complementariosPDF');
    }

    public function index($id = null, $img = null, $dir = null, $num) {
//        $predios = predios::find(1);
        //echo $id;
        //echo $c= Input::get('id');
//        print_r($img);

      $loc = str_replace('-', ' ', $num);
     $localidad=explode(' ', $loc);
//     echo "<pre>";
//     print_r($localidad);
//     echo "</pre>";
        echo $clave_catas = substr($id, 7, 15);
        $numpredio = substr($id, -6);
        $predios = predios::WHERE('clave_catas', '=', $clave_catas)->get();
        foreach ($predios as $predio) {
            $entidad = $predio->entidad;
            $municipio = $predio->municipio;
            $cla = $predio->clave_catas;
        }
//      echo   $clave = $entidad . '-' . $municipio . '-' . $cla;
      $clave= substr($id, 7, 15);
        $prop = DB::SELECT("SELECT datos_propietarios('$clave')");
        foreach ($prop as $row) {
            $item = explode(",", $row->datos_propietarios);
        }
        $item= DB::SELECT("SELECT nombrec FROM datospredio  WHERE clave =('$id')");
//     var_dump($item);
     foreach ($item as $row) {
            $nombre= explode(",", $row->nombrec);
        }
        
//        $clave_catas = $predios->clave_catas;
//        $centroide= DB::SELECT('SELECT ST_Centroid(geom)  FROM manzanas');
        
        $lat=DB::SELECT("SELECT st_xmin(geom)-5 as xmin, st_ymin(geom)-5 as ymin, st_xmax(geom)+5 as xmax, st_ymax(geom)+5 as ymax    FROM predios WHERE clave_catas='$clave_catas'");
        $condominio = condominios::WHERE('clave_catas', '=', $clave_catas)->get();
        $imagenes = ImagenesLevantamiento::WHERE('clave_catas', '=', $clave_catas)->select('nombre_archivo')->get();
        $vista = View::make('complementarios.datos_complemetarios_PDF', compact('predios', 'nombre', 'condominio', 'imagenes', 'img', 'dir', 'numpredio', 'localidad','prop','lat'));
        $pdf = PDF::load($vista)->show("DatosComplementariosPDF");
        $response = Response::make($pdf, 200);
        $response->header('Content-Type', 'application/pdf');
        return $response;
//       return $vista;
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
