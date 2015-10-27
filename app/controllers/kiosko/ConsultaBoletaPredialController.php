<?php

use Catastro\Repos\Padron\PadronFiscalRepository;

class ConsultaBoletaPredialController extends \BaseController
{

    protected $fiscal;

    public function __construct(PadronFiscalRepository $fiscal){

        defined('_IMPUESTO_PREDIAL_') || define('_IMPUESTO_PREDIAL_', 'CA010');
        defined('_ACTUALIZACION_IMPUESTO_PREDIAL_') || define('_ACTUALIZACION_IMPUESTO_PREDIAL_', 'CA011');
        defined('_RECARGOS_IMPUESTO_PREDIAL_') || define('_RECARGOS_IMPUESTO_PREDIAL_', 'CA013');
        defined('_GASTOS_EJECUCION_IMPUESTO_PREDIAL_') || define('_GASTOS_EJECUCION_IMPUESTO_PREDIAL_', 'CA014');


        $this->fiscal = $fiscal;
        $this->afterFilter("no-cache");
    }

    public function index(){

        $listaMunicipios =  Municipio::with('entidad')->where('entidad', '27')->orderBy('nombre_municipio')->remember(120)->lists('nombre_municipio','municipio');

        $semestres = ['1', '2'];
        $anioIni = 2010;
        $anioFin = 2015;

        for($i = $anioIni; $i <= $anioFin; $i++){
            foreach($semestres as $semestre){
                $listaPeriodos[$i."|".$semestre] = $i . " Semestre " . $semestre;
            }
        }

        return View::make('kiosko.ConsultaBoletaPredial.index',compact(['listaMunicipios','listaPeriodos']));
    }


    public function consulta(){
        $entidad = '27'; //Nomas tabasco
        $zona = Input::get('clave_zona');
        $ultimo_periodo = Input::get('ultimo_periodo');
        if(!$ultimo_periodo){
            Session::flash('error',"Porfavor, Seleccione el periodo a simular.");
            return Redirect::back()->withInput();
        }
        list($anioDebioPagar, $mesDebioPagar) = explode("|",$ultimo_periodo);

        if($mesDebioPagar == 1) $mesDebioPagar = 1;
        if($mesDebioPagar == 2) $mesDebioPagar = 6;

        $manzana = Input::get('clave_manzana');
        $predio = Input::get('clave_predio');
        $cuenta = Input::get('cuenta');
        $tipo = Input::get('tipo');
        $municipio = Input::get('municipio');
        if(!$municipio){
            Session::flash('error',"Porfavor, Seleccione el municipio donde se ubica el predio.");
            return Redirect::back()->withInput();
        }

        $anioActual = date("Y");
        $mesActual = date("m");

        $indiceActualizacion = 0;

        try {
            $indiceActualizacion = (new ImpuestoPredialHelper() )->indiceActualizacion($anioActual, $mesActual, $anioDebioPagar, $mesDebioPagar );
        }
        catch(INPCInexistenteException $e){
            Session::flash('error',$e->getMessage());
            return Redirect::back()->withInput();
        }

        //TODO: En la base de datos solo esta configurado en la tabla configuracion_municipal los municipios gid 1 y 2;
        $gidMunicipio = 2;

        $clave = sprintf("%02d-%03d-%03d-%04d-%06d", $entidad, $municipio, $zona, $manzana, $predio);
        $cta = sprintf("%02d-%s-%06d", substr($municipio,1,2), $tipo, $cuenta);
        $predio = $this->fiscal->getByClaveYCuenta($clave,$cta);
        $referencias = [];

        //Impuesto predial clave CA010
        if(!$predio) {
            Session::flash('error','No existe ningún predio con esos datos dado de alta en el padrón catastral. Verifique los datos e intente nuevamente.');
            return Redirect::back()->withInput();
        }

        $referencias[_IMPUESTO_PREDIAL_] = $predio->impuesto;

        $res = DB::select("SELECT sp_get_concepto_adeudo(?,?) AS adeudo",[$clave, $gidMunicipio]);
        $actualizacion = 0.00;
        $recargos = 0.00;
        $gastosejecucion = 0.00;

        if(count($res)>0){
            $adeudo = $res[0]->adeudo;
            $conceptos = explode("-",$adeudo);
            //print_r($conceptos);

            //$actualizacion = $conceptos[0];
            //No usamos el SP del concepto aduedo para la actualizacion porque usamos la nuestra
            $actualizacion = abs($predio->impuesto * $indiceActualizacion - $predio->impuesto);

            if($actualizacion) $referencias[_ACTUALIZACION_IMPUESTO_PREDIAL_] = $actualizacion;
            $recargos = $conceptos[1];
            if($recargos) $referencias[_RECARGOS_IMPUESTO_PREDIAL_] = $recargos;
            $gastosejecucion = $conceptos[2];
            if($gastosejecucion) $referencias[_GASTOS_EJECUCION_IMPUESTO_PREDIAL_] = $gastosejecucion;
        }

        $refs = [];
        foreach($referencias as $key =>$val ){
            $refs[] = $key."|".$val;
        }
        $referencias = implode(",",$refs);

        $total = $predio->impuesto + $actualizacion + $recargos + $gastosejecucion;

        //La linea de captura
        $nombre = "NO REGISTRADO";
        if($predio->propietarios){
            $nombre = $predio->propietarios->last()->nombrec;
        }

        //Folio De la boleta:
        //TODO: Hacer algo con este numero generado aleatoriamente para la prueba
        $f = rand(0,100);
        $folio = date("Y")."01".str_pad($f,6,"0",STR_PAD_LEFT);

        error_log($referencias);

        //TODO: En lo que dan de alta las claves esas.
        $referencias = "DT001|0";

        $lc = new LineaCaptura($nombre, $referencias, $folio);
        if(!$lc->estatus){
            Session::flash('error',$lc->getErrorMsg());
            return Redirect::back()->withInput();
        }

        $linea = $lc->getLineaCaptura();
        if(is_array($linea)){

            $linea_captura['finanzas'] = $linea[6];
            $linea_captura['oxxo'] = $linea[7];
            $linea_captura['banamex'] = $linea[8];
            $linea_captura['vigencia_del'] = $linea[2];
            $linea_captura['vigencia_al'] = $linea[3];
            $linea_captura['transaccion'] = date("Y")."/".$linea[1];
        }
        else{
            Session::flash('error',$lc->getErrorMsg());
            return Redirect::back()->withInput();
        }

        //barcodes
        $linea_captura_cb['finanzas'] = ".".DNS1D::getBarcodePNGPath($linea_captura['finanzas'], "C128");
        $linea_captura_cb['oxxo'] = ".".DNS1D::getBarcodePNGPath($linea_captura['oxxo'], "C128");

        $directo = '';
        $logo='';
        $vars = [
          'predio','directo','logo',
          'actualizacion', 'recargos', 'gastosejecucion', 'total',
            'linea_captura', 'linea_captura_cb'
        ];

        //return View::make('kiosko.ConsultaBoletaPredial.boleta',compact($vars));

        //Se Genera PDF
        $vista = View::make('kiosko.ConsultaBoletaPredial.boleta',compact($vars));
        $pdf = PDF::load($vista, 'letter')->show();
        $response = Response::make($pdf, 200);
        $response->header('Content-Type', 'application/pdf');
        return $response;


    }



}