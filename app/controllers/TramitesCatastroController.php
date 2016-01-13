<?php

class TramitesCatastroController extends BaseController {

    public function ObtenerValoresWS() {
        $inputs = Input::all();
        $nombres = Input::get('nombre');
        $paterno = Input::get('paterno');
        $materno = Input::get('materno');
        $comentarios = Input::get('observacion');
        $oficio = Input::get('numero_oficio');
//        var_dump($inputs);
        $soapClient = new SoapClient('https://recaudanet.spf.tabasco.gob.mx:9091/DGTIC/DGTIC?wsdl');
// para obtener las funciones disponibles en el servicio web
//        $functions = $soapClient->__getFunctions();
//         echo "<pre>";
////       print_r($functions);
//         echo "</pre>";
        $nombre = $nombres;
        $apepa = $paterno;
        $apema = $materno;
        $comentario = $comentarios;
        $folio = $oficio;
        if ($nombre == "" && $apepa == "" && $apema == "" && $comentario == "" && $folio == "") {
            $url = "";
            return View::make('webServiceForm', compact('url'));
        } else {
            $param = array(
                'tipoCobro' => '1',
                'nombre' => $nombre . $apepa . $apema,
                'referencia' => 'DT001|0',
                //'observacion' => 'Por expedicion y reposicion de licencias para conducir con vigencia de dos años para chofer',
                'observacion' => $comentario,
                'folio' => $folio,
                'noLicencia' => ' ',
                'name' => 'Landy'
            );
            $ready = $soapClient->cobroDGTIC($param)->return;
            $url = $ready[9];
//            echo $url;
            return Redirect::to($url);
        }
    }

}
