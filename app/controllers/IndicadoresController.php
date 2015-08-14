<?php

class IndicadoresController extends BaseController {

    function crearINPC() {

        $arrayinpc = IndicadoresHelper::getinpc();
        $anio = $arrayinpc['año'];
        $mes = $arrayinpc['mes'];
        $inpc = $arrayinpc['inpc'];
        //$inpcs = DB::SELECT("SELECT * FROM inpc WHERE mes='$mes' AND anio = '$anio'");
        $inpcs = inpc::where('mes', '=', $mes)
                ->where('anio', '=', $anio)
                ->get();
        $count = count($inpcs);
        if ($count == 0) {
            $n = new inpc();
            $n->mes = $mes;
            $n->anio = $anio;
            $n->inpc = $inpc;
            $n->save();
        }
//        return View::make('SMinimoV', compact('count'));
        return $arrayinpc;
//        echo "<br>";
    }

    function crearSMV() {
        $arrayzona = array(
            'Zona1' => 'A',
            'Zona2' => 'B',
            'Zona3' => 'C',
            'Zona4' => 'G'
        );
        $arrayindicador = array(
            'Indicador1' => '215837',
            'Indicador2' => '215838',
            'Indicador3' => '215839',
            'Indicador4' => '215840'
        );
        $count = count($arrayindicador);

        for ($x = 1; $x <= $count; $x++) {
            $ind = $arrayindicador["Indicador" . $x];
            $zona = $arrayzona["Zona" . $x];
            $arraysmv = SalarioMinimoHelper::getSMV($ind, $zona);
//            echo "<pre>";
//            print_r($arraysmv);
//            echo $zona;
//            echo "</pre>";
//            echo "<br>";
            //}
            $anio = $arraysmv['año'];
            $zona = $zona;
            $smv = $arraysmv['sm'];

            if ($zona == 'A') {

                $arrayzonaA = array(
                    'Anio' => $arraysmv['año'],
                    'zona' => $zona,
                    'smv' => $arraysmv['sm']
                );
            }
            if ($zona == 'B') {

                $arrayzonaB = array(
                    'Anio' => $arraysmv['año'],
                    'zona' => $zona,
                    'smv' => $arraysmv['sm']
                );
            }
            if ($zona == 'C') {

                $arrayzonaC = array(
                    'Anio' => $arraysmv['año'],
                    'zona' => $zona,
                    'smv' => $arraysmv['sm']
                );
            }
            if ($zona == 'G') {

                $arrayzonaG = array(
                    'Anio' => $arraysmv['año'],
                    'zona' => $zona,
                    'smv' => $arraysmv['sm']
                );
            }

            $n = new salario;
            $n->anio = $anio;
            $n->zona = $zona;
            $n->salario_minimo = $smv;
            $n->save();
        }

        $arraysmzona = array(
            'ZonaA' => $arrayzonaA,
            'ZonaB' => $arrayzonaB,
            'ZonaC' => $arrayzonaC,
            'ZonaG' => $arrayzonaG,
        );

//        var_dump($arraysmzona);
        return $arraysmzona;
//        $arraysmv = SalarioMinimoHelper::getSMV('215838', 'A');
//        return View::make('SMinimoV', compact($arraysmv));
    }

}
