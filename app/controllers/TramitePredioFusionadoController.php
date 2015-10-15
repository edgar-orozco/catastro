<?php


class TramitePredioFusionadoController extends BaseController
{

    protected $tramite_id;
    protected $departamento_id;
    protected $tramitePredioFusionado;

    public function __construct(TramitePredioFusionado $tramitePredioFusionado){
        $this->tramite_id = Input::get('tramite_id');
        $this->departamento_id = Input::get('departamento_id');
    }

    public function index(){

        return View::make('tramites.predioFusionado.index',[]);
    }

    public function store(){
        $tramite_id = Input::get('tramite_id');
        $actividad_id = Input::get('actividad_id');
        $departamento_id = Input::get('departamento_id');

        $predios = Input::get('predios');


    }

    public function show(){

    }
}