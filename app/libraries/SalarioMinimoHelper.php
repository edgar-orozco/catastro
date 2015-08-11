<?php

class SalarioMinimoHelper {

    public static function getSMV($indicador, $zona) {
        $client = new SoapClient("http://www2.inegi.org.mx/servicioindicadores/Indicadores.asmx?WSDL");
        $param = array(
            'Indicador' => $indicador,
            'ubicacionGeografica' => $zona,
        );
        $ready = $client->obtieneValoresOportunos($param)->obtieneValoresOportunosResult;
//        // $xml = simplexml_load_string($ready->any);
        $array = explode(" ", $ready->any);
//        var_dump($array);
        $periodo = explode('"', $array[24]);
        $array = explode('"', $array[25]);
         $salariom = $array[1];
        $per = $periodo[1];
        $time = explode("/", $per);
//        print_r($time);
//        echo "<br>";
         $anio = $time[0];
         $mes = $time[1];
         
         $arraysmv = array(
            'año' => $anio,
            'mes' => $mes,
            'sm' => $salariom,
        );
       return $arraysmv;
    }

}
