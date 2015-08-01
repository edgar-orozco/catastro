<?php

class IndicadoresHelper
{
     public function getinpc() {

        $client = new SoapClient("http://www2.inegi.org.mx/servicioindicadores/Indicadores.asmx?WSDL");
        $param = array(
            'Indicador' => '216064',
            'ubicacionGeografica' => '27',
        );
        $ready = $client->obtieneValoresOportunos($param)->obtieneValoresOportunosResult;
        $xml = simplexml_load_string($ready->any);



//
//        $resultXML = simplexml_load_string($result);
//        $item = $resultXML->obtieneValoresOportunosResponse->obtieneValoresOportunosResul;
        echo "<pre>";
        print_r($xml);
 echo "</pre>";

        $vista = View::make('PDF-RegistroEscritura');
        return $vista;
    }
}