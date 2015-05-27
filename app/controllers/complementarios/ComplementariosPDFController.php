<?php

error_reporting(E_ERROR | E_WARNING);

class complementarios_ComplementariosPDFController extends BaseController {

    public function getdatos() {
        return View::make('complementarios.Form-complementariosPDF');
    }

    public function index() {
//        $predios = predios::find(1);
        $clave_catas = Input::get('clave');
        $predios = predios::WHERE('clave_catas', '=', $clave_catas)->get();
        foreach ($predios as $predio) {
            $entidad = $predio->entidad;
            $municipio = $predio->municipio;
            $cla = $predio->clave_catas;
        }
        $clave = $entidad . '-' . $municipio . '-' . $cla;

        $prop = DB::SELECT("SELECT datos_propietarios('$clave')");
      
        foreach ($prop as $row) {
            $item = explode(",", $row->datos_propietarios);
        }
        $clave_catas = $predios->clave_catas;
        $condominio = condominios::WHERE('clave_catas', '=', $clave_catas)->get();
        $imagenes = ImagenesLevantamiento::WHERE('clave_catas', '=', $clave_catas)->select('nombre_archivo')->get();
        $vista = View::make('complementarios.datos_complemetarios_PDF', compact('predios', 'item', 'condominio','imagenes'));
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
