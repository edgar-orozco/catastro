<?php
use Artisaninweb\SoapWrapper\Extension\SoapService;
class PruebaWS extends SoapService {
    /**
     * @var Nombre del servicio
     */
    protected $name = 'currency';
    /**
     * @var URL del diccionario WSDL del servicio
     */
    protected $wsdl = 'http://currencyconverter.kowabunga.net/converter.asmx?WSDL';
    /**
     * @var bandera de trazabilidad y debug
     */
    protected $trace = true;
    //Datos necesarios para consultar el ws de tipo de cambio
    protected $data = [
      'CurrencyFrom' => 'USD',
      'CurrencyTo'   => 'MXN',
      'RateDate'     => '2015-07-12',
      'Amount'       => '1'
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
    
    /**
     * Regresa la conversión de la moneda solicitada 
     */
    public function getConversionAmount($data=null){
        return $this->call('GetConversionAmount', [$data] )->GetConversionAmountResult;
    }
    /**
     * Regresa un listado de los nombres de monedas convertibles por el servicio.
     */
    public function getCurrencies($data){
        return $this->call('GetCurrencies',[$data]);
    }
}
