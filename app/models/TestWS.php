<?php
use Artisaninweb\SoapWrapper\Extension\SoapService;
class TestWS extends SoapService {
    /**
     * @var Nombre del servicio
     */
    protected $name = 'currency';
    /**
     * @var URL del diccionario WSDL del servicio
     */
    protected $wsdl = 'http://www2.inegi.org.mx/servicioindicadores/Indicadores.asmx?WSDL';
   
    /**
     * @var bandera de trazabilidad y debug
     */
    protected $trace = true;
    //Datos necesarios para consultar el ws de tipo de cambio
    protected $data = [
      'Indicador' => '216064',
      'ubicacionGeografica'=>'27',
//      'fechaInicial'     => '2012',
//      'fechaFinal'       => '2015'
    ];
    /**
     * Esta funcion regresa todas las funciones que provee el servicio
     * Es unicamente para consultar que tenemos disponible, que parametros toman y que devuelven
     *
     * @return mixed
     */
    public function functions()
    {
        return $this->getFunctions();
    }
    
    public function obtieneValoresOportunos($data=null){
        return $this->call('obtieneValoresOportunos', [$data] )->obtieneValoresOportunosResult;
    }
//    public function getConversionAmount($data=null){
//        return $this->call('GetConversionAmount', [$data] )->GetConversionAmountResult;
//    }
  
    /**
     * Regresa la conversión de la moneda solicitada 
     */
//    public function getConversionAmount($data=null){
//        return $this->call('GetConversionAmount', [$data] )->GetConversionAmountResult;
//    }
//    /**
//     * Regresa un listado de los nombres de monedas convertibles por el servicio.
//     */
//    public function getCurrencies($data){
//        return $this->call('GetCurrencies',[$data]);
//    }
}