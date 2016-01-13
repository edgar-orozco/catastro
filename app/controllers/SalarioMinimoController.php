<?php

class SalarioMinimoController extends BaseController {

    public function getSalariomin() {


//        $client = new SoapClient("http://www2.inegi.org.mx/servicioindicadores/Indicadores.asmx?WSDL");
//        $param = array(
//            'Indicador' => '215839',
//            'ubicacionGeografica' => 'B',
//        );
//        $ready = $client->obtieneValoresOportunos($param)->obtieneValoresOportunosResult;
//
////        $ready = $client->obtieneValoresOportunos($param)->obtieneValoresOportunosResult;
////        // $xml = simplexml_load_string($ready->any);
//        $array = explode(" ", $ready->any);
////        var_dump($array);
//        $periodo = explode('"', $array[24]);
//        $array = explode('"', $array[25]);
//       echo  $salariom = $array[1];
//        $per = $periodo[1];
//        $time = explode("/", $per);
////        print_r($time);
//        echo "<br>";
//        echo $anio = $time[0];
//        echo $mes = $time[1];
//        $sm=SalarioMinimoHelper::getSMV('215839','A');
//        print_r($sm);
//        $sm = IndicadoresHelper::getinpc();
//        dd($sm);
//        FechasHelper::check_in_range($fecha1, $fecha2, $ftermina);
//        echo print_r($smv);
//        $smv=FechasHelper::check_in_range('2015-08-06', '2015-08-06','2015-08-06');
//        print_r($smv);
        
        $smv= SalarioMinimoHelper::getSMV('215840','C');
        print_r($smv);
        
        return View::make('SMinimoV');
    }

}
