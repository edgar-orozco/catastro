<?php

class tramites_ResultadoInspeccionController extends \BaseController {

protected $manifestacion;
protected $servicioPublico;
protected $manifestacionConstruccion;

    public function __construct(Manifestacion $manifestacion, mServiciosPublicos $servicioPublico, ManifestacionConstruccion $manifestacionConstruccion) {

        $this->manifestacion = $manifestacion;
        $this->servicioPublico = $servicioPublico;
        $this->manifestacionConstruccion = $manifestacionConstruccion;

        $this->beforeFilter('csrf',array('on' => 'post'));
        $this->afterFilter("no-cache");

    }
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{

    $clave = Input::get('clave');
    
    $cuenta = Input::get('cuenta');

    $tramite_id = Input::get('tramite_id');

	$vars = $this->catalogos();

    $vars['clave'] = $clave;

    $vars['cuenta'] = $cuenta;

	$JsonColindancias = json_encode([]);

    $manifestacion = $this->manifestacion;

    $consultaMani = $manifestacion->where('tramite_id', $tramite_id)->get();

    if($consultaMani->count()>0)
    {
        $consultaMani = $consultaMani[0];
    }

    //dd($modelos['manifestaciones']);

    if(!$consultaMani)
    {
      return 'No se encontro la solicitud inspeccion para la clave ' . $clave . ' y cuenta '. $cuenta;
    }

    $manifestacion_id = $consultaMani->id;

    $vars['manifestacion_id'] = $manifestacion_id;

    $servicioPublico = $this->servicioPublico;

    $maniConstruccion = $this->manifestacionConstruccion;

    $vars['serv_publico'] = $servicioPublico->where('manifestacion_predio_id', $manifestacion_id)->lists('mtipo_servicio_id');

    $vars['JsonColindancias'] = $JsonColindancias;

    $vars['manifestacion'] = $manifestacion;

    $vars['consultaMani'] = $consultaMani;

    $vars['manifestacionConstruccion'] = $maniConstruccion->where('manifestacion_id', $manifestacion_id)->orderBy('num_bloque')->get();

		return View::make('tramites.inspeccion.complementa', $vars);

	}

  public function store()
  {
    $cuenta = Input::get('cuenta');
    $clave = Input::get('clave');
    $array_clave = explode('-', $clave);
    $mani_id = Input::get('manifestacion_id');
    $file = Input::file('imagen');
    $datosMani = array_merge(Input::get('manifestaciones'), ['observacion'=>Input::get('observacion')]);
    $datosConstruccion = json_decode(Input::get('datos_construccion'), true);
    $serviciosMani = Input::get('manifestaciones_servicios');
    $servPublicos = $this->servicioPublico->where('manifestacion_predio_id', $mani_id);
    $arrayData = $servPublicos->lists('mtipo_servicio_id');
    $a=[];
    $row=[];

    //Guarda los servicios de la manifestacion
    if($serviciosMani)
    {
        foreach ($serviciosMani as $serv)
        {
            if (!in_array($serv, $arrayData))
            {
                $row[] = 
                [
                    'manifestacion_predio_id' => $mani_id,
                    'mtipo_servicio_id' => $serv, 
                    'created_at' => new Datetime, 
                    'updated_at'=> new DateTime
                ];
            }
            $a[]=$serv;
        }
        $servPublicos
            ->whereNotIn('mtipo_servicio_id', $a)
            ->delete();

        if($row)
        {
            $this->servicioPublico->insert($row);        
        }
    }

    //GUARDAR EN MANIFESTACION

    $manifestacion = $this->manifestacion->find($mani_id);
    if ($file) 
    {
        // Se valida el directorio para subir shapes
        $dir = '/complementarios/anexos/'. $array_clave[0] . '/' . $array_clave[1] . '/' . $cuenta . '/m/';
        $nombre_archivo = $cuenta . '-' . date("d-m-y") . '-' . $file->getClientOriginalName();
        if (!file_exists(public_path() . $dir) && !is_dir(public_path() . $dir)) 
        {
            File::makeDirectory(public_path() . $dir, $mode = 0777, true, true);
        }
        if (!file_exists($dir . $nombre_archivo) && in_array(strtolower($file->getClientMimeType()), array('image/png', 'image/jpeg', 'image/jpeg', 'image/jpeg', 'image/gif', 'image/bmp', 'image/vnd.microsoft.icon', 'text/plain', 'application/vnd.ms-excel', 'application/msword', 'application/pdf')))
        {
            $file->move(public_path() . $dir, $nombre_archivo);
            $datosMani = array_merge($datosMani,['fachada'=>$dir.$nombre_archivo]);  
        }
    }

    if(isset($datosConstruccion['sup_albercas']))
    {
       $datosMani = array_merge($datosMani,['superficie_alberca' => $datosConstruccion['sup_albercas']]); 
    }
    
    $manifestacion->update($datosMani);



    $construcciones = $datosConstruccion['construcciones'];

    if($datosConstruccion['eliminar'])
    {
        foreach ($datosConstruccion['eliminar'] as $key)
        {
            $consulta = $this->manifestacionConstruccion->find($key);
            if($consulta)
            {
                $consulta->delete();
            }
        }
    }
    $constru = [];
    if($construcciones)
    {
        foreach ($construcciones as $key => $value) 
        {
            $consulta = $this->manifestacionConstruccion->find($key);
            if($consulta)
            {
                $consulta->update($value);
            }
            else
            {
                $modelMani = $this->manifestacionConstruccion;
                $constru = array_merge($value, ['manifestacion_id'=>$mani_id, 'created_at' => new Datetime, 
                    'updated_at'=> new DateTime ]);
                $modelMani->insert($constru);
                echo "guardo bloque"; 
            }
            

        }
    }

    return Redirect::back();

    
  }


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
    
	}

    private function catalogos(){

        $title = 'Manifestación Catastral';

        //Título de sección:
        $title_section = "Manifestación Catastral.";

        //Listado de municipios de tabasco
        $listaMunicipios =  Municipio::with('entidad')->where('entidad', '27')->orderBy('nombre_municipio')->lists('nombre_municipio','municipio');

        //En lo que se sabe que hacer con los catalogos...
        
        //tipos_propietarios?
        //Vacio...
        //se creo migrate mtipos_propietarios
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


        /*tipousosuelo?
        //DATOS: HABITACIONAL, NO HABITACIONAL, MIXTO, SIN USO.
        //MIGRATE: muso_predio
         $usoPredio = [
            '1'=>'Habitacional',
            '2'=>'Industrial',
            '3'=>'Agrícola',
        ];*/

        $usoPredio = mUsoPredio::orderBy('descripcion', 'DESC')->lists('descripcion', 'id'); 
       

        /*
        SE CREO MIGRATE: mtenencia_tierra
        $tenenciaTierra = [
            '1'=>'Propiedad',
            '2'=>'Ejidal',
            '3'=>'Común',
            '4'=>'Posesión',
        ];
        */

        $tenenciaTierra = mTenenciaTierra::orderBy('descripcion', 'DESC')->lists('descripcion', 'id');

        //tiposervicios
        //diferentes: PAVIMENTO DE CONCRETO HIDRÁULICO, PAVIMENTO DE ASFALTO
        //RECOLECCIÓN DE BASURA, GUARNICIÓN, TV SATELITAL, TV POR CABLE
        $serviciosPublicos = mTiposServicios::orderBy('descripcion')->lists('descripcion', 'id');

        /*ftipos_construccion
        */$tiposConstruccion = [
            'Antigua' => ['A1' => 'Económica', 'A2'=>'Medio', 'A3'=>'Superior'],
            'Moderna' => ['M1' => 'Interés Social', 'M2'=>'Popular', 'M3'=>'Medio', 'M4'=>'Bueno', 'M5'=>'Superior'],
            'Edificio Habitacional' => ['H1'=>'Interés social', 'H2'=>'Medio', 'H3'=>'Superior'],
            'Construcciones Especiales' => ['C1'=>'Corriente', 'C2'=>'Medio', 'C3'=>'Bueno'],
            'Edif. Construcciones Especiales' => ['E1'=>'Medio', 'E2'=>'Bueno'],
        ];
        
        $tiposConstruccion1 = mTiposConstruccion::distinct()->select('grupo_tipoconstruccion')->orderBy('grupo_tipoconstruccion')->get();
        $t=[];
        foreach($tiposConstruccion1 as $k){
            $s = [];
            $tiposConstruccion2 = mTiposConstruccion::where('grupo_tipoconstruccion', $k->grupo_tipoconstruccion )->orderBy('grupo_tipoconstruccion')->lists('descripcion', 'id');
            foreach($tiposConstruccion2 as $a => $b){
                $s[] = ['value'=>$a, 'text'=>$b];
            }
            $t[] = ['text'=>$k->grupo_tipoconstruccion, 'children'=>$s];
        }
        $tiposConstruccion = $t;




        $techos = mTiposTechos::orderBy('descripcion')->lists('descripcion', 'id');

        $t = array();
        foreach($techos as $k => $v){
            $t[] = ['value'=>$k, 'text'=>$v];
        }
        $techos = $t;



        $muros = mTiposMuros::orderBy('descripcion')->lists('descripcion', 'id');
        $t = array();
        foreach($muros as $k => $v){
            $t[] = ['value'=>$k, 'text'=>$v];
        }
        $muros = $t;



        $pisos = mTiposPisos::orderBy('descripcion')->lists('descripcion', 'id');
        $t = array();
        foreach($pisos as $k => $v){
            $t[] = ['value'=>$k, 'text'=>$v];
        }
        $pisos = $t;


        $puertas = mTiposPuertas::orderBy('descripcion')->lists('descripcion', 'id');
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


        $instEspeciales = mTiposInstalacionesEspeciales::orderBy('descripcion')->lists('descripcion', 'id');
        $t = array();
        foreach($instEspeciales as $k => $v){
            $t[] = ['value'=>$k, 'text'=>$v];
        }
        $instEspeciales = $t;

        $edosConstruccion = mTiposEstadosConservacion::orderBy('descripcion')->lists('descripcion', 'id');
        $t = array();
        foreach($edosConstruccion as $k => $v){
            $t[] = ['value'=>$k, 'text'=>$v];
        }
        $edosConstruccion = $t;

        $usosConstruccion = mTiposUsosConstruccion::orderBy('descripcion')->lists('descripcion', 'id');
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
