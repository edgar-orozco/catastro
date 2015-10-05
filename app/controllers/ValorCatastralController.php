<?php

class ValorCatastralController extends \BaseController
{
    public function index(){

    }

    public function create(){

        //Todos los catalogos que se utilizan en combos y opciones en la forma de la manifestacion
        $vars = $this->catalogos();

        //Eliminar este dato que se pone asi para que se puedan hacer pruebas
        $tipo_predio = Input::get('tipo');
        $vars['tipo_predio'] = strtoupper($tipo_predio);

        return View::make('tramites.valor.create', $vars);
    }

    public function store(){

    }


    private function catalogos(){

        //TODO: Eliminar datos harcodeados de prueba
        $municipio = '014';

        $title = 'Valor Catastral';

        //Título de sección:
        $title_section = "Valor Catastral.";

        //Listado de municipios de tabasco
        //$listaMunicipios =  Municipio::with('entidad')->where('entidad', '27')->orderBy('nombre_municipio')->lists('nombre_municipio','municipio');

         $viasComunicacion = [
          '1'=>'CARRETERA PAVIMENTADA',
          '2'=>'CARRETERA DE TERRACERIA',
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
            '9' => 'CASA HABITACIÓN',
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
            '01'=>'ANTIGUAS',
            '02'=>'MODERNAS',
            '03'=>'EDIFICIOS MODERNOS',
            '04'=>'CONSTRUCCIONES ESPECIALES',
            '05'=>'EDIFICIOS DE CONSTRUCCIONES ESPECIALES',
        ];

        $categoriasConstruccion = [
            '01' => [  //Antiguas
                '01' => 'ECONÓMICA',
                '02' => 'MEDIO',
                '03' => 'SUPERIOR',
            ],
            '02' => [ //Modernas
                '04' => 'INTERÉS SOCIAL',
                '05' => 'POPULAR',
                '06' => 'MEDIO',
                '07' => 'BUENO',
                '08' => 'SUPERIOR',
            ],
            '03' => [ //Edificios modernos
                '09' => 'INTERÉS SOCIAL',
                '10' => 'MEDIO',
                '11' => 'SUPERIOR',
            ],
            '04' => [ //Edificios construcciones especiales
                '12' => 'CORRIENTE',
                '13' => 'MEDIO',
                '14' => 'BUENO',
            ],
            '05' => [ //Edificio construcciones especiales
                '15' => 'MEDIO',
                '16' => 'BUENO',
            ]
        ];


        $t = array();
        foreach($tiposConstruccion as $k => $v){
            $t[] = ['value'=>$k, 'text'=>$v];
        }
        $tiposConstruccion = $t;

        $edosConstruccion = [
          '1'=>'BUENO',
          '2'=>'REGULAR',
          '3'=>'MALO',
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

        $elementosConstruccion = [
            'techos'=>'03',
            'muros'=>'04',
            'pisos'=>'17',
            'puertas'=>'09',
            'hidraulicas'=>'05',
            'electricas'=>'07',
            'sanitarias'=>'06',
        ];

        $oVC = ValorConstruccion::where('municipio',$municipio)->get();
        $valoresConstruccion = [];
        foreach($oVC as $vc){
            $valoresConstruccion[$vc->municipio][$vc->tipo_construccion][$vc->categoria][$vc->elemento] = [
              '1'=>$vc->factor1,
              '2'=>$vc->factor2,
              '3'=>$vc->factor3,
            ];
        }

        ///Catálogos para rústicos
        $distCabmun = [
          '1' => "MENOS DE 5 Km.",
          '2' => "ENTRE 5 Y 10 Km.",
          '3' => "ENTRE 10 Y 15 Km.",
        ];

        $distCenpob = [
          '1' => "MENOS DE 5 Km.",
          '2' => "ENTRE 5 Y 10 Km.",
        ];

        //Valores para albercas
        $tiposAlbercas = [
            '1' => 'ECONÓMICA BUENA',
            '2' => 'ECONÓMICA REGULAR',
            '3' => 'ECONÓMICA MALA',
            '4' => 'MEDIANA BUENA',
            '5' => 'MEDIANA REGULAR',
            '6' => 'MEDIANA MALA',
            '7' => 'LUJO BUENA',
            '8' => 'LUJO REGULAR',
            '9' => 'LUJO MALA',
        ];

        $valoresAlbercas = [
            '1' => 950,
            '2' => 900,
            '3' => 850,

            '4' => 1200,
            '5' => 1100,
            '6' => 1000,

            '7' => 1500,
            '8' => 1400,
            '9' => 1300,
        ];

        $vars = [
            'title','title_section', 'subtitle_section',
            'usoSuelo', 'serviciosPublicos','incEsquina','municipio',
            //'techos', 'muros', 'pisos', 'puertas', 'ventanas', 'hidraulicas', 'electricas', 'sanitarias', 'instEspeciales',
            'edosConstruccion', 'usosConstruccion', 'tiposConstruccion', 'categoriasConstruccion', 'valoresConstruccion',
            'elementosConstruccion',
            'tipo_terreno',
            'viasComunicacion','distCabmun','distCenpob',
            'tiposAlbercas', 'valoresAlbercas',
        ];

        return compact($vars);

    }

}