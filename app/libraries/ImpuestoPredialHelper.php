<?php

use Symfony\Component\Config\Definition\Exception\Exception;

class ImpuestoPredialHelper {


    /**
     * Calcula el indice de actualizacion del impuesto predial
     * Según el código fiscal de la federación vigente a la fecha de desarrollo
     * http://info4.juridicas.unam.mx/ijure/fed/6/28.htm
     *
     * @param $anioPago
     * @param $mesPago
     * @param $anioDebioPagar
     * @param $mesDebioPagar
     * @return float
     * @throws \INPCInexistenteException
     */
    public function indiceActualizacion($anioPago, $mesPago, $anioDebioPagar, $mesDebioPagar){

        //Se obtiene el INPC del periodo anterior al mes del pago.

        $fecha = strtotime($anioPago."-".$mesPago."-01 - 1 month");
        $anioINPCFin = date("Y",$fecha);
        $mesINPCFin = date("m",$fecha);

        $inpcObj = inpc::where('anio', $anioINPCFin)->where('mes',$mesINPCFin)->first();
        if(!$inpcObj){
            throw new INPCInexistenteException("No se encuentra el INPC para el periodo $anioINPCFin - $mesINPCFin");
        }

        $inpcPago = $inpcObj->inpc;

        $fecha = strtotime($anioDebioPagar."-".$mesDebioPagar."-01 - 1 month");
        $anioINPCDebioPagar = date("Y",$fecha);
        $mesINPCDebioPagar = date("m",$fecha);

        $inpcDebioObj = inpc::where('anio', $anioINPCDebioPagar)->where('mes',$mesINPCDebioPagar)->first();
        if(!$inpcDebioObj || $inpcDebioObj->inpc == 0 ){
            throw new INPCInexistenteException("No se encuentra el INPC para el periodo $anioINPCDebioPagar - $mesINPCDebioPagar");
        }

        $inpcDebioPagar = $inpcDebioObj->inpc;

        $indice = $inpcPago / $inpcDebioPagar;

        return $indice;
    }


}