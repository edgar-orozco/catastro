<?php

use \Catastro\Repos\Padron\PadronRepositoryInterface;

class ValorCatastralController extends \BaseController
{

    protected $padron;
    protected $tipotramite;
    protected $tramite;
    protected $manifestacion;
    protected $valuacionPredio;
    protected $datosValuacionTerreno;
    protected $datosValuacionConstrucciones;
    /**
     * @param PadronRepositoryInterface $padron
     * @param Tipotramite $tipotramite
     * @param Tramite $tramite
     * @param Manifestacion $manifestacion
     * @param ValuacionPredio $valuacionPredio
     * @param DatosValuacionTerrenos $datosvaluacionterreno
     */
    public function __construct(PadronRepositoryInterface $padron, Tipotramite $tipotramite, Tramite $tramite, Manifestacion $manifestacion, ValuacionPredio $valuacionPredio, DatosValuacionTerrenos $datosValuacionTerreno, DatosValuacionConstrucciones $datosValuacionConstrucciones)
    {
        $this->padron = $padron;
        $this->tipotramite = $tipotramite;
        $this->tramite = $tramite;
        $this->Manifestacion = $manifestacion;
        $this->ValuacionPredio = $valuacionPredio;
        $this->DatosValuacionTerrenos = $datosValuacionTerreno;
        $this->DatosValuacionConstrucciones = $datosValuacionConstrucciones;
    }

    public function index(){

    }

    public function create(){

        $tramite_id = Input::get('tramite_id');
        $tramite = Tramite::find($tramite_id);
        $municipio = $tramite->municipio;
        $vars['municipio'] = $municipio;
        $clave = $tramite->clave;
        //Todos los catalogos que se utilizan en combos y opciones en la forma de la manifestacion
        $vars = $this->catalogos($municipio);

        //$predio = $this->padron->getByClaveOCuenta($tramite->clave);
        $predio = $this->Manifestacion->where('clave',$clave)->orderBy('id', 'desc')->first();

        $tipo_predio = $predio->tipo_predio;
        $vars['tipo_predio'] = strtoupper($tipo_predio);
        $vars['superficie_terreno'] = $predio->sup_terreno;
        $vars['predio'] = $predio;
        $vars['clave'] = $predio->clave;
        $vars['cuenta'] = $predio->cuenta;
        $vars['tramite'] = $tramite_id;

        return View::make('tramites.valor.create', $vars);
    }

    public function store(){
        //hablamos todos los inputs
        $input = Input::All();
        $rustico = Input::get("dem_pct_rustico");

        //guardamos en la tabla ValuacionPredio
        $valuacion = new ValuacionPredio;
        $valuacion->tramite_id = $input["tramite_id"];
        $valuacion->clave = $input["clave"];
        $valuacion->cuenta = $input["cuenta"];
        $valuacion->valor_terreno = str_replace(",","",$input["valor_terreno"]);
        $valuacion->valor_construccion = str_replace(",","",$input["valor_construccion"]);
        $valuacion->fecha_valuacion = date('Y-m-d');
        $valuacion->demerito_terreno = str_replace(",","",$input["dem_terreno"]);
        $valuacion->demerito_construccion = str_replace(",","",$input["dem_construccion"]);
        $valuacion->incremento_terreno = str_replace(",","",$input["inc_terreno"]);
        $valuacion->incremento_construccion = str_replace(",","",$input["inc_construccion"]);
        $valuacion->valor_ajustado_terreno = str_replace(",","",$input["vajust_terreno"]);
        $valuacion->valor_ajustado_construccion = str_replace(",","",$input["vajust_construccion"]);
        $valuacion->valor_catastral = str_replace(",","",$input["valor_catastral"]);
        $valuacion->save();

        //gurdamos en la tabla datos_valuacion_terreno
        $terreno = new DatosValuacionTerrenos;
        $terreno->valuacion_id = $valuacion->id;
        $terreno->clave = $input["clave"];
        $terreno->cuenta = $input["cuenta"];
        $terreno->sup_terreno = $input["sup_terreno"];
        $terreno->valor_calle = $input["valor_calle"];
        $terreno->usosuelo_id = $input["usosuelo_id"];
        $terreno->incremnento_esquina_id = $input["inc_esquina_id"];
        $terreno->demerito_escaso_frente = $input["dem_frente"];
        $terreno->demerito_profundidad_frente = $input["dem_prof_frente"];
        $terreno->demerito_profundidad = $input["dem_prof_prof"];
        $terreno->demerito_irregular = $input["dem_irregular"];
        $terreno->demerito_superficie_excavada = $input["dem_sup_excavada"];
        $terreno->demerito_profundidad_excavada = $input["dem_prof_excavada"];
        $terreno->demerito_desnivel_area = $input["dem_desnivel_area"];
        $terreno->demerito_desnivel_porcentaje = $input["dem_desnivel_pct"];
        $terreno->superficie_paso_servidumbre = $input["sup_paso_servidumbre"];
        $terreno->demerito_porcentaje = $rustico;
        $terreno->observaciones = $input["observaciones"];
        $terreno->save();

        //guardamos en la tabla datos_valuacion_construcciones
        $datosConstruccion = json_decode(Input::get('datos_construccion'), true);
        $construcciones = $datosConstruccion['construcciones'];
        $construccionesAlbercas = $datosConstruccion['construccionesAlbercas'];
        
        //acomodamos los campos segun las tabla datos_valuacion_construcciones para las construcciones
        foreach( $construcciones as $construccion) {
            $construccion['valuacion_id']=$valuacion->id;
            $construccion['clave']=$input["clave"];
            $construccion['cuenta']=$input["cuenta"];
            $construccion['valuacion_terreno_id']=$terreno->id;
            $construccion['sup_terreno']=$construccion['sup_construccion'];
            $construccion['conservacion_id']=$construccion['edo_construccion'];
            $construccion['tipo_id']=$construccion['tipo_construccion'];
            $construccion['piso_id']=$construccion['pisos'];
            $construccion['techo_id']=$construccion['techos'];
            $construccion['muros_id']=$construccion['muros'];
            $construccion['hidraulicas_id']=$construccion['hidraulicas'];
            $construccion['sanitarias_id']=$construccion['sanitarias'];
            $construccion['electricas_id']=$construccion['electricas'];
            $construccion['avance']=$construccion['avance'];
            $construccion['anio_construccion']=$construccion['antiguedad'];
            $construccion['puerta_id']=$construccion['puertas'];
            $construccion['numero_niveles']=$construccion['num_niveles'];
            $Construccion[] = new DatosValuacionConstrucciones($construccion);
        }
        //Expresamos la felicidad que ya gurdo
        $valuacion->ValuacionConstruccion()->saveMany($Construccion);

        //vemos si tiene datos en alberca
        if ($construccionesAlbercas ) {
            //acomodamos los compos segun la tabla datos_valuacion_construcciones para las alvercas
            foreach ($construccionesAlbercas as $alberca) {
                $alberca['valuacion_id']=$valuacion->id;
                $alberca['clave']=$input["clave"];
                $alberca['cuenta']=$input["cuenta"];
                $alberca['valuacion_terreno_id']=$terreno->id;
                $alberca['sup_terreno']=$alberca['superficie_alberca'];
                $alberca['es_alberca']=1;
                $alberca['tipoalberca_id']=$alberca['tipoalberca'];
                $alberca['avance']=$alberca['avance'];
                $alberca['anio_construccion']=$alberca['antiguedad'];
                $Alberca[] = new DatosValuacionConstrucciones($alberca);
            }
            //Expresamos la felicidad que ya gurdo
            $valuacion->ValuacionConstruccion()->saveMany($Alberca);
        }
        
        return Redirect::to('tramites/valorCatastral/'. $valuacion->id);
    }

    public function valorCatastral($id) {
        //traigo el id de valuacion predio
        //$id = 101;
        //consulto a la tabla valuacion predio
        $valuacion = $this->ValuacionPredio->where('id',$id)->first();
        //suma de todas las  sup_terreno
        foreach ($valuacion->ValuacionConstruccion as $construccion) {
            $cons[] = $construccion->sup_terreno;
        }
        $Cons=array_sum($cons);
        //tramite
        $tramites=$this->tramite->where('id',$valuacion->tramite_id)->first();
        //traemos el dato del propietario del padron
        $datos = $this->padron->getByClaveOCuenta($valuacion->clave);
        //traemos la clable para hacer un explode y sacar los siguientes datos
        $clave = explode('-', $valuacion->clave);
        $municipio=$clave[1];
        $zona=$clave[2];
        $manzana=$clave[3];
        $predio=$clave[4];
        //traigo el municipio
        $municipios = Municipio::where('municipio','=',$municipio)->first();
        //traigo el nombre del logo del municipio
        $configuracion = configuracionMunicipal::where('municipio','=', $municipios->gid)->first();
        //lo mandamos com PDF la vista
        $vista = View::make('ventanilla.valorCatastral', compact('valuacion','Cons','tramites','datos','zona','manzana','predio','municipios','configuracion'));
        $pdf = PDF::load($vista)->show('Valor Catastral'.' '.$valuacion->cuenta);
        $response = Response::make($pdf, 200);
        $response->header('Content-Type', 'application/pdf');
        return $vista;
    }

    /**
     * Regresa la vista del resumen del valor en una tablita
     * @param $id
     * @return \Illuminate\View\View
     */
    public function showGrid(){

        $tramite_id = Input::get('tramite_id');

        //TODO: Aquí se tiene que consultar el registro mediante el tramite_id y/o actividad_id
        $valor_terreno = 12345.67;

        $valor_construccion = 123456.78;
        $demeritos_terreno = 123456.78;
        $demeritos_construccion = 123456.78;
        $incrementos_terreno = 123456.78;
        $ajustado_terreno = 123456.78;
        $ajustado_construccion = 123456.78;
        $valor_catastral = 123456.78;

        $argumentos = [
            'valor_terreno',
            'valor_construccion',
            'demeritos_terreno',
            'demeritos_construccion',
            'incrementos_terreno',
            'ajustado_terreno',
            'ajustado_construccion',
            'valor_catastral'
        ];

        return View::make('tramites.valor._grid_valor',compact($argumentos));
    }

    private function catalogos($municipio){

        //TODO: Eliminar datos harcodeados de prueba
        //$municipio = '014';

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