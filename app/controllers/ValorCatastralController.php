<?php

class ValorCatastralController extends \BaseController
{
    public function index(){

    }

    public function create(){

        //Todos los catalogos que se utilizan en combos y opciones en la forma de la manifestacion
        $vars = $this->catalogos();
        return View::make('tramites.valor.create', $vars);
    }

    public function store(){

    }


    private function catalogos(){
        $title = 'Valor Catastral';

        //Título de sección:
        $title_section = "Valor Catastral.";

        //Listado de municipios de tabasco
        //$listaMunicipios =  Municipio::with('entidad')->where('entidad', '27')->orderBy('nombre_municipio')->lists('nombre_municipio','municipio');

         $viasComunicacion = [
          '1'=>'Pavimentada',
          '2'=>'Terracería',
          '3'=>'Camino vecinal',
        ];

        $usoSuelo = [
            '1' => 'SIN CONSTRUCCIÓN (BALDÍOS)',
            '2' => 'RESTAURANTES',
            '3' => 'ESTACIONAMIENTO',
            '4' => 'CINES',
            '5' => 'CLUBES',
            '6' => 'PASTIZALES',
            '7' => 'DEPARTAMENTO EN CONDOMINIO',
            '8' => 'OFICINAS DE SERVICIOS',
        ];
$usoSueloList = [];
        $usoPredio = [
          '1'=>'Habitacional',
          '2'=>'Industrial',
          '3'=>'Agrícola',
        ];

        $tenenciaTierra = [
          '1'=>'Propiedad',
          '2'=>'Ejidal',
          '3'=>'Común',
          '4'=>'Posesión',
        ];

        $serviciosPublicos = [
          '1'=>'Agua',
          '2'=>'Luz',
          '3'=>'Teléfono',
          '4'=>'Banqueta',
          '5'=>'Alumbrado',
          '6'=>'Pavimento',
          '7'=>'Drenaje',
          '8'=>'Transporte',
        ];

        $serviciosPublicos = tiposervicios::orderBy('descripcion')->remember(120)->lists('descripcion', 'id_tiposervicio');

        $tiposConstruccion = [
            '1'=>'ANTIGUAS',
            '2'=>'MODERNAS',
            '3'=>'EDIFICIOS MODERNOS',
            '4'=>'CONSTRUCCIONES ESPECIALES',
            '5'=>'EDIFICIOS DE CONSTRUCCIONES ESPECIALES',
        ];
        $t = array();
        foreach($tiposConstruccion as $k => $v){
            $t[] = ['value'=>$k, 'text'=>$v];
        }
        $tiposConstruccion = $t;

        $techos = [
            '1'=>'INTERÉS SOCIAL',
            '2'=>'POPULAR',
            '3'=>'MEDIO',
            '4'=>'BUENO',
            '5'=>'SUPERIOR',
        ];

        $t = array();
        foreach($techos as $k => $v){
            $t[] = ['value'=>$k, 'text'=>$v];
        }
        $techos = $t;

        $muros = $techos;

        $pisos = $techos;

        $puertas = $techos;
        $ventanas = $puertas;
       $hidraulicas = $techos;
        $electricas = $hidraulicas;
        $sanitarias = $hidraulicas;


        $edosConstruccion = [
          '1'=>'Bueno',
          '2'=>'Regular',
          '3'=>'Malo',
        ];

        $t = array();
        foreach($edosConstruccion as $k => $v){
            $t[] = ['value'=>$k, 'text'=>$v];
        }
        $edosConstruccion = $t;

        $incEsquina = [
            '1'=>'NO COMERCIAL',
            '2'=>'COMERCIAL BAJA',
            '3'=>'COMERCIAL ALTA',
        ];

        $vars = [
          'title','title_section', 'subtitle_section',
          'usoSuelo', 'serviciosPublicos','incEsquina',
          'techos', 'muros', 'pisos', 'puertas', 'ventanas', 'hidraulicas', 'electricas', 'sanitarias', 'instEspeciales',
          'edosConstruccion', 'usosConstruccion', 'tiposConstruccion',
        ];

        return compact($vars);

    }

}