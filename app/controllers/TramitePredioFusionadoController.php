<?php


class TramitePredioFusionadoController extends BaseController
{

    protected $tramite_id;
    protected $departamento_id;
    protected $tramitePredioFusionado;

    public function __construct(TramitePredioFusionado $tramitePredioFusionado){

        $this->beforeFilter('csrf',array('on' => 'post'));
        $this->afterFilter("no-cache");

        $this->tramite_id = Input::get('tramite_id');
        $this->departamento_id = Input::get('departamento_id');
    }

    /**
     * Muestra el formato de captura de los predios a fusionar
     * @return \Illuminate\View\View
     */
    public function index(){
        $tramite_id = Input::get('tramite_id');
        $tipoactividad_id = Input::get('tipoactividad_id');
        $departamento_id = Input::get('departamento_id');

        $vars = [
            'tramite_id',
            'tipoactividad_id',
            'departamento_id',
        ];

        return View::make('tramites.predioFusionado.index',compact($vars));
    }

    /**
     * Guarda los datos de la forma
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(){
        $tramite_id = Input::get('tramite_id');
        $tipoactividad_id = Input::get('tipoactividad_id');
        $departamento_id = Input::get('departamento_id');

        $predios = Input::get('predios');

        $tramite = Tramite::find($tramite_id);

        $municipio = substr($tramite->clave,3,3);
        $estado = substr($tramite->clave,0,2);

        $aOpredios = [];
        foreach($predios as $predio){
            $zona = str_pad($predio['zona'], 3, "0", STR_PAD_LEFT);
            $manzana = str_pad($predio['manzana'], 4, "0", STR_PAD_LEFT);
            $pdio = str_pad($predio['predio'], 6, "0", STR_PAD_LEFT);
            $cta = str_pad($predio['cuenta'], 6, "0", STR_PAD_LEFT);
            $clave_fusionado = $estado."-".$municipio."-".$zona."-".$manzana."-".$pdio;
            $cuenta_fusionado = substr($municipio,1,2)."-".$predio['tipo']."-".$cta;
            $reg = ['clave'=>$clave_fusionado, 'cuenta'=>$cuenta_fusionado, 'tramite_id' => $tramite_id];
            $aOpredios[] = new TramitePredioFusionado($reg);
        }

        //Borramos todos los registros que existan previamente guardados para evitar duplicidad
        $tramite->prediosFusionados()->delete();

        //Guardamos los registros que vengan de la forma.
        $tramite->prediosFusionados()->saveMany($aOpredios);

        //Creamos el registro para actualizar la actividad del tramite
        $actividad = [
          'tramite_id'=> $tramite_id,
          'user_id' => Auth::id(),
          'tipo_id'=> $tipoactividad_id,
        ];

        if($departamento_id) $actividad['departamento_id'] = $departamento_id;

        ActividadTramite::create($actividad);

        //regresamos mensaje de exito a la plantilla de respuesta
        $resultado = 'exitoso';
        $mensaje = 'Se han guardado los predios relacionados';
        Session::flash('success', $mensaje);
        return View::make('tramites.respuestamodal',compact(['resultado','mensaje']));
    }

    /**
     * Muestra la tabla de predios relacionados
     */
    public function showGrid(){
        $tramite_id = Input::get('tramite_id');
        $departamento_id = Input::get('departamento_id');
        $tipoactividad_id = Input::get('tipoactividad_id');
        $predios = TramitePredioFusionado::where('tramite_id',$tramite_id)->get();
        return View::make('tramites.predioFusionado.gridPredios',compact(['predios']));
    }
}