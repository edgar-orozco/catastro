<?php

class IndicadoresHelper {

    public static function getinpc() {
        $client = new SoapClient("http://www2.inegi.org.mx/servicioindicadores/Indicadores.asmx?WSDL");
        $param = array(
            'Indicador' => '216064',
            'ubicacionGeografica' => '27',
        );
        $ready = $client->obtieneValoresOportunos($param)->obtieneValoresOportunosResult;
        // $xml = simplexml_load_string($ready->any);
        $array = explode(" ", $ready->any);
        $periodo = explode('"', $array[24]);
        $array = explode('"', $array[25]);
        $inpc = $array[1];
        $per = $periodo[1];
        $time = explode("/", $per);
        $anio = $time[0];
        $mes = $time[1];

        $arrayinpc = array(
            'año' => $anio,
            'mes' => $mes,
            'inpc' => $inpc,
        );
       return $arrayinpc;
    }

}
