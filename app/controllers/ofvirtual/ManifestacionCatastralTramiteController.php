<?php

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

class ManifestacionCatastralTramiteController extends \BaseController
{
    /**
     * Reglas de validación para datos de identificacion
     */
    protected $validaIdentificacion = array(
      'municipio'=>'required',
      'movimiento'=>'required',
      'tipo_propietario'=>'required',
      'cuenta_predio'=>'required|min:6|numeric',
      'clave_zona'=>'required|min:3|numeric',
      'clave_manzana'=>'required|min:4|numeric',
      'clave_predio'=>'required|min:6|numeric',
      'cuenta_afectada'=>['required','Regex:/^\d{6}-[RrUu]{1}+$/'],
      'memo_num'=>'numeric',
      'tipo_predio'=>['required','Regex:/[RrUu]{1}/'],
    );


    protected $validaRegPub = array(
        'fecha_titulo' => "date|before:today",
        'fecha_escritura' => "date|before:today",
    );

    protected $manifestacion;

    public function __construct(Manifestacion $manifestacion) {

        $this->manifestacion = $manifestacion;

        $this->beforeFilter('csrf',array('on' => 'post'));
        $this->afterFilter("no-cache");

    }

    /**
     * Muestra el listado de manifestaciones y el botón de crear nueva manifestación catastral
     * @return \Illuminate\View\View
     */
    public function index(){
        $title = 'Manifestación Catastral';

        //Título de sección:
        $title_section = "Manifestación Catastral.";

        //Subtítulo de sección:
        $subtitle_section = "Crear, modificar, buscar, imprimir";


        return View::make('ofvirtual.notario.manifestacion.createTramite',comptact('title','title_section', 'subtitle_section'));

    }


    /**
     * Muestra la forma para crear nuevos registros de manifestacion catastral
     * @return \Illuminate\View\View
     */
    public function create(){

        //Todos los catalogos que se utilizan en combos y opciones en la forma de la manifestacion
        $vars = $this->catalogos();

        $JsonColindancias = json_encode([]);

        $manifestacion = $this->manifestacion;

        $vars['JsonColindancias'] = $JsonColindancias;
        $vars['manifestacion'] = $manifestacion;

        return View::make('ofvirtual.notario.manifestacion.create', $vars);
    }


    /**
     * Almacena la manifestacion en base de datos
     */
    public function store(){

        if(Input::get('_token') != Session::get('_token')){
            Log::info('El token no es el mismo!!!');
            return Redirect::to('/ofvirtual/notario')->with('error','El envío de datos ya no es válido, otra forma se ha enviado previamente.');
        }

        $manifestacion = Input::get('manifestacion');

        //Validamos los datos de ideentificación del documento o tramite
        $v = Validator::make($manifestacion, $this->validaIdentificacion);
        if(!$v->passes()) {
            return Redirect::back()->withInput()->withErrors($v);
        }

        //Validamos los datos en datos de registro publico

        DB::transaction(function() {

            $manifestacion = Input::get('manifestacion');
            $enajenante = Input::get('enajenante');
            $domicilio_enajenante = Input::get('domicilioEnajenante');
            $adquiriente = Input::get('adquiriente');
            $domicilio_adquiriente = Input::get('domicilioAdquiriente');

            $direccion_predio_urbano = Input::get('direccion_predio_urbano');
            $direccion_predio_rustico = Input::get('direccion_predio_rustico');


            $datos_construccion = Input::get('datos_construccion');

            $dConstrucciones = json_decode($datos_construccion);

            //print_r($s->construcciones);
            $dConstrucciones = (array) $dConstrucciones;
            if(isset($dConstrucciones['construcciones'])){
                $dConstrucciones =  $dConstrucciones['construcciones'];
            }

            //// Enajenantes y adquirientes
            $en = new personas();
            $en->fill($enajenante);
            $en->save();

            $endir = new Domicilio();
            $endir->fill($domicilio_enajenante);
            $endir->save();

            $ad = new personas();
            $ad->fill($adquiriente);
            $ad->save();

            $addir = new Domicilio();
            $addir->fill($domicilio_adquiriente);
            $addir->save();

            //// La manifestacion
            $m = new Manifestacion();
            $m->fill($manifestacion);

            $m->clave = "27-" . $m->municipio . "-" . $m->clave_zona . "-" . $m->clave_manzana . "-" . $m->clave_predio;
            $m->cuenta = substr($m->municipio,1) . "-" . $m->tipo_predio . "-" . $m->cuenta_predio;

            $m->enajenante()->associate($en);
            $m->domicilioEnajenante()->associate($endir);

            $m->adquiriente()->associate($ad);
            $m->domicilioAdquiriente()->associate($addir);


            /*TODO: ver lo de la direccion del predio rustico y el predio urbano
            $m->direccionRustico()->associate($dir_rustico);
            $m->direccionUrbano()->associate($dire_urbano);
            */

            $m->save();
            //print_r($s->contrucciones);

            /// Estos datos dependen del manifestacion_id
            $Colindancias = [];
            foreach (Input::get('colindancias', []) as $colindancia) {
                $colindancia['manifestacion_id'] = $m->id;
                $Colindancias[] = new ManifestacionColindancia($colindancia);
            }

            $m->colindancias()->saveMany($Colindancias);

            $Servicios = [];
            foreach (Input::get('manifestacion_servicios', []) as $servicio_id) {
                $Servicios[] = new ManifestacionServicio(['servicio_id'=>$servicio_id, 'manifestacion_id'=>$m->id]);
            }
            $m->colindancias()->saveMany($Servicios);

            $Construcciones = [];
            foreach($dConstrucciones as $construccion){
                $aConstruccion = (array) $construccion;
                $aConstruccion['manifestacion_id'] = $m->id;
                $Construcciones[] = new ManifestacionConstruccion($aConstruccion);
            }
            $m->construcciones()->saveMany($Construcciones);

            Session::forget('_token');

        });

        return Redirect::to('/ofvirtual/notario')->with('success','Se ha creado la manifestación');
    }


    public function edit($id){

        $this->manifestacion = Manifestacion::find($id);
        $manifestacion = $this->manifestacion;
        $manifestacion->manifestacion = $manifestacion;

        $vars = $this->catalogos();

        $enajenante = $manifestacion->enajenante;
        if($enajenante) $manifestacion->enajenante->fill($enajenante->toArray());

        $domicilioEnajenante = $manifestacion->domicilioEnajenante;
        if($domicilioEnajenante) $manifestacion->domicilioEnajenante->fill($domicilioEnajenante->toArray());

        $adquiriente = $manifestacion->adquiriente;
        if($adquiriente) $manifestacion->adquiriente->fill($adquiriente->toArray());

        $domiciliAdquiriente = $manifestacion->domicilioAdquiriente;
        if($domiciliAdquiriente) $manifestacion->domicilioAdquiriente->fill($domiciliAdquiriente->toArray());

        $predioUrbano = $manifestacion->direccionUrbano;
        if($predioUrbano) $manifestacion->direccionUrbano->fill($predioUrbano->toArray());

        $servicios = $manifestacion->servicios;
        if($servicios && count($servicios->toArray())){

            $manifestacion->manifestacion_servicios = [1,2,8];
        }

        $JsonColindancias = null;
        $colindancias = $manifestacion->colindancias;
        if($colindancias) $JsonColindancias = $colindancias->toJson();

        $vars['manifestacion'] = $manifestacion;
        $vars['JsonColindancias'] = $JsonColindancias;

        return View::make('ofvirtual.notario.manifestacion.edit',$vars);
    }


    private function catalogos(){

        $title = 'Manifestación Catastral';

        //Título de sección:
        $title_section = "Manifestación Catastral.";

        //Listado de municipios de tabasco
        $listaMunicipios =  Municipio::with('entidad')->where('entidad', '27')->orderBy('nombre_municipio')->lists('nombre_municipio','municipio');

        //En lo que se sabe que hacer con los catalogos...
        $listaTiposPropietario =  [
          '1'=>'Particular',
          '2'=>'Municipal',
          '3'=>'Estatal',
          '4'=>'Federal',
        ];

        $vialidades= TipoVialidad::orderBy('descripcion')->remember(120)->lists('descripcion', 'id');
        $asentamientos= TipoAsentamiento::orderBy('descripcion')->remember(120)->lists('descripcion', 'id');
        $entidades= Entidad::orderBy('nom_ent')->remember(120)->lists('nom_ent', 'gid');
        $municipios = $listaMunicipios;

        $viasComunicacion = [
          '1'=>'Pavimentada',
          '2'=>'Terracería',
          '3'=>'Camino vecinal',
        ];
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
          'Antigua' => ['A1' => 'Económica', 'A2'=>'Medio', 'A3'=>'Superior'],
          'Moderna' => ['M1' => 'Interés Social', 'M2'=>'Popular', 'M3'=>'Medio', 'M4'=>'Bueno', 'M5'=>'Superior'],
          'Edificio Habitacional' => ['H1'=>'Interés social', 'H2'=>'Medio', 'H3'=>'Superior'],
          'Construcciones Especiales' => ['C1'=>'Corriente', 'C2'=>'Medio', 'C3'=>'Bueno'],
          'Edif. Construcciones Especiales' => ['E1'=>'Medio', 'E2'=>'Bueno'],
        ];
        $t=[];
        foreach($tiposConstruccion as $k => $v){
            $s = [];
            foreach($v as $a => $b){
                $s[] = ['value'=>$a, 'text'=>$b];
            }
            $t[] = ['text'=>$k, 'children'=>$s];
        }
        $tiposConstruccion = $t;

        $techos = [
          'CC'=>'Concreto',
          'TB'=>'Teja de barro',
          'LZ'=>'Lámina de zinc',
          'LA'=>'Lámina de asbesto',
          'OT'=>'Otros',
        ];

        $t = array();
        foreach($techos as $k => $v){
            $t[] = ['value'=>$k, 'text'=>$v];
        }
        $techos = $t;

        $muros = [
          'BT' => 'Block tabique',
          'AM' => 'Adobe madera',
        ];
        $t = array();
        foreach($muros as $k => $v){
            $t[] = ['value'=>$k, 'text'=>$v];
        }
        $muros = $t;

        $pisos = [
          'CM' => 'Cemento',
          'MS' => 'Mosaico',
          'MR' => 'Mármol',
        ];
        $t = array();
        foreach($pisos as $k => $v){
            $t[] = ['value'=>$k, 'text'=>$v];
        }
        $pisos = $t;

        $puertas = [
          'AL' => 'Aluminio',
          'HR' => 'Herrería',
          'MD' => 'Madera',
        ];
        $t = array();
        foreach($puertas as $k => $v){
            $t[] = ['value'=>$k, 'text'=>$v];
        }

        $ventanas = $puertas;
        $t = array();
        foreach($ventanas as $k => $v){
            $t[] = ['value'=>$k, 'text'=>$v];
        }

        $hidraulicas = [
          'OC' => 'Oculta',
          'VS' => 'Visible',
        ];
        $t = array();
        foreach($hidraulicas as $k => $v){
            $t[] = ['value'=>$k, 'text'=>$v];
        }
        $hidraulicas = $t;

        $electricas = $hidraulicas;
        $sanitarias = $hidraulicas;

        $instEspeciales = [
          'E' => 'Elevador',
          'CC' => 'Circuito cerrado',
          'ECI' => 'Equipo contra incendios',
          'SH' => 'Sistema hidroneumático',
          'EE' => 'Escaleras electromecánicas',
          'O' => 'Otros',
        ];
        $t = array();
        foreach($instEspeciales as $k => $v){
            $t[] = ['value'=>$k, 'text'=>$v];
        }
        $instEspeciales = $t;

        $edosConstruccion = [
          'B'=>'Bueno',
          'R'=>'Regular',
          'M'=>'Malo',
        ];
        $t = array();
        foreach($edosConstruccion as $k => $v){
            $t[] = ['value'=>$k, 'text'=>$v];
        }
        $edosConstruccion = $t;

        $usosConstruccion = [
          'CH'=>'Habitacional',
          'IN'=>'Industrial',
          'CM'=>'Comercial',
          'M'=>'Mixto',
          'GO'=>'Ofic. Serv. Gob. Fral. Mpal.',
        ];
        $t = array();
        foreach($usosConstruccion as $k => $v){
            $t[] = ['value'=>$k, 'text'=>$v];
        }
        $usosConstruccion = $t;

        $listaTiposEscritura = [
          '1'=>'Pública',
          '2'=>'Título Agrario',
          '3'=>'Privada',
          '4'=>'Derecho de posesión',
          '5'=>'Título propiedad Municipal',
          '6'=>'Título propiedad Estatal',
          '7'=>'Título propiedad Federal',
        ];

        $oNotarias = Notaria::with('notario')->with('mpio')->with('estado')->orderBy('nombre')->remember(120)->get();
        $listaNotarias = [];
        foreach($oNotarias as $notaria){
            $listaNotarias[$notaria->id_notaria] = $notaria->nombre." ".
              $notaria->mpio['nombre_municipio'].", ".$notaria->estado['nom_ent']." ".
              $notaria->notario->nombres." ".$notaria->notario->apellido_paterno. " ".$notaria->notario->apellido_materno;
        }

        $listaEstatusFiscal = [
          'vigente' => 'Vigente',
          'exento' => 'Exento',
        ];

        $JsonColindancias = json_encode([]);

        $vars = [
          'title','title_section', 'subtitle_section',
          'manifestacion',
          'listaMunicipios', 'listaTiposPropietario',
          'vialidades', 'asentamientos', 'entidades','municipios',
          'JsonColindancias',
          'viasComunicacion', 'tenenciaTierra', 'usoPredio', 'serviciosPublicos',
          'techos', 'muros', 'pisos', 'puertas', 'ventanas', 'hidraulicas', 'electricas', 'sanitarias', 'instEspeciales',
          'edosConstruccion', 'usosConstruccion', 'tiposConstruccion',
          'listaTiposEscritura', 'listaNotarias',
          'listaEstatusFiscal',

        ];

        return compact($vars);
    }


}