<?php
use Artisaninweb\SoapWrapper\Extension\SoapService;
use PhpSpec\Exception\Exception;

class LineaCaptura extends SoapService {


    /**
     * @var string
     */
    protected $name = 'currency';

    protected $tipoCobro = 1;
    protected $nombreConstribuyente = "";
    protected $referencia = "";
    protected $observacion = "CA PAGO DEL IMPUESTO PREDIAL";
    protected $folio = "";
    protected $noLicencia = "";

    protected $msgError = "";
    public $estatus = true;

    /**
     * @var string
     */
    //protected $wsdl = 'http://currencyconverter.kowabunga.net/converter.asmx?WSDL';
    //protected $wsdl = 'http://www2.inegi.org.mx/servicioindicadores/Indicadores.asmx?WSDL';
    protected $wsdl = 'https://10.14.20.54:9091/DGTIC/DGTIC?wsdl';
    /**
     * @var boolean
     */
    protected $trace = false;

    protected $params = [
      'tipoCobro' => '1',
      'nombre' => 'GONZALEZ GARCIA ESTHER',
        //'referencia' => 'CA010|256,CA011|10,CA013|106,CA014|15',
      'referencia' => 'DT001|150',
      'observacion' => 'CA PAGO DEL IMPUESTO PREDIAL',
      'folio' => '201501000001',
      'noLicencia' => ' ',
    ];

    public function __construct($nombre=null, $referencia=null, $folio=null, $observacion="CA IMPUESTO PREDIAL",  $tipoCobro=1, $noLicencia=' ')
    {
        if($tipoCobro) $this->params['tipoCobro'] = $tipoCobro;
        if($nombre) $this->params['nombre'] = $nombre;
        if($referencia) $this->params['referencia'] = $referencia;
        if($observacion) $this->params['observacion'] = $observacion;
        if($folio) $this->params['folio'] = $folio;
        if($noLicencia) $this->params['noLicencia'] = $noLicencia;

        if(!empty($this->wsdl))
        {
            ini_set('default_socket_timeout', 10);

            $this->options(['exception'=>true]);
            try {
                $this->wsdl($this->wsdl)
                  ->createClient();
                return;
            }
            catch(SoapFault $e){
                $this->msgError = "El servicio de línea de captura no se encuentra disponible. MSG01";
                $this->status = false;
                return;
            }
        }
        throw new Exception("Favor de setar el WSDL.");
    }

    /**
     * Override
     * @return $this
     */
    public function createClient()
    {
        $this->client =  @new SoapClient($this->getWsdl(), $this->getOptions());

        return $this;
    }


    /**
     * Setea los parametros necesarios para la llamada a la función
     * @param $params
     */
    public function setParams($params){
        if(!is_array($params)) return;

        foreach($params as $key => $val) {
            $this->params[$key] = $val;
        }
    }

    public function getLineaCaptura(){

        $res = null;
        try {
            $res = $this->call('cobroDGTIC', [$this->params]);
            if( isset($res->return) ) {
                return $res->return;
            }
            else{
                $this->estatus = false;
                $this->msgError = 'El Servicio de Línea de captura no se encuentra disponible. MSG02';
                return false;
            }
        }
        catch(SoapFault $e){
            $this->estatus = false;
            $this->msgError = 'El Servicio de Línea de captura no se encuentra disponible. MSG03';
            return false;
        }
        catch(Exception $e){
            $this->estatus = false;
            $this->msgError = 'El Servicio de Línea de captura no se encuentra disponible. MSG04';
            return false;
        }
    }

    public function functions()
    {
        return $this->getFunctions();
    }


    public function getErrorMsg(){
        return $this->msgError;
    }

}
