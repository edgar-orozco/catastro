<?php
use \Catastro\Repos\Padron\PadronRepositoryInterface;

class OficinaVirtualNotarioController extends \BaseController {

    protected $padron;
    protected $traslado;

    /**
     * @param PadronRepositoryInterface $padron
     */
    public function __construct(PadronRepositoryInterface $padron, Traslado $traslado)
    {
        $this->padron = $padron;
        $this->traslado = $traslado;
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
        $title = 'Listas de traslados de dominio';

        $traslados = Traslado::all();

        $misMunicipios = Auth::user()->municipios()->get(['gid']);

        $aMisMunicipios = array();
        foreach($misMunicipios as $mun)
        {
            $aMisMunicipios[] = $mun->gid;
        }

        if(empty($aMisMunicipios)){
            $municipios = Municipio::orderBy('nombre_municipio')->get();
        }
        else{
            $municipios = Municipio::whereIn('gid', $aMisMunicipios)->orderBy('nombre_municipio')->get();
        }

        return View:: make( 'ofvirtual.notario.traslado.index', compact( 'title' , 'traslados', 'municipios'));

	}



	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//ToDo: no muestra el titulo ?
        $title = 'Crear traslado de dominio';

        $traslado = new Traslado();

        $identificador = Request::get('clave');
        $identificador = strtoupper($identificador);
        $predio = $this->padron->getByClaveOCuenta($identificador);

          //Si la clave no se encuentra
        if(!$predio) {
            return Redirect::to('ofvirtual/notario/traslado')->with('error', 'La clave o cuenta es incorrecta.');
        }

        return View:: make( 'ofvirtual.notario.traslado.create', compact( 'title', 'traslado', 'predio'));

    }


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
    {
        //
        $usuarioId = Auth::id();

        //ToDo: sacar notaria del usuario
        $notariaId =  1;

        $variables = Input::all();

        $vendedor = new personas();

        $vendedorApellidoPaterno  = mb_strtoupper($variables["vendedor_apellido_paterno"]);
        $vendedorApellidoMaterno  = mb_strtoupper($variables["vendedor_apellido_materno"]);
        $vendedorNombres  = mb_strtoupper($variables["vendedor_nombres"]);

        $vendedor->apellido_paterno = $vendedorApellidoPaterno;
        $vendedor->apellido_materno = $vendedorApellidoMaterno;
        $vendedor->nombres = $vendedorNombres;
        $vendedor->nombrec = $vendedorApellidoPaterno . " " . $vendedorApellidoMaterno . " " . $vendedorNombres;
        $vendedor->rfc = $variables["vendedor_rfc"];
        $vendedor->curp = $variables["vendedor_curp"];

        if (!$vendedor->save()) {
            return Redirect::back()->with('error', 'Error en vendedor.');
        }

        $compradorApellidoPaterno  = mb_strtoupper($variables["comprador_apellido_paterno"]);
        $compradorApellidoMaterno  = mb_strtoupper($variables["comprador_apellido_materno"]);
        $compradorNombres  = mb_strtoupper($variables["comprador_nombres"]);

        $comprador = new personas();
        $comprador->apellido_paterno = $compradorApellidoPaterno;
        $comprador->apellido_materno = $compradorApellidoMaterno;
        $comprador->nombres = $compradorNombres;
        $comprador->nombrec = $compradorApellidoPaterno . " " . $compradorApellidoMaterno . " " . $compradorNombres;
        $comprador->rfc = $variables["comprador_rfc"];
        $comprador->curp = $variables["comprador_curp"];

        if (!$comprador->save()) {
            return Redirect::back()->with('error', 'Error en comprador.');
        }

        $traslado = new Traslado();

        $traslado->usuario_id = $usuarioId;
        $traslado->notaria_id = $notariaId;
        $traslado->clave = $variables['clave'];
        $traslado->cuenta = $variables['cuenta'];
        $traslado->vendedor_id = $vendedor->id_p;
        $traslado->vendedor_tipo = $variables['vendedor_tipo_persona'];
        $traslado->comprador_id = $comprador->id_p;
        $traslado->comprador_tipo = $variables['comprador_tipo_persona'];
        $traslado->superficie_vendida = $variables['superficie_vendida'];
        $traslado->superficie_construccion_vendida = $variables['superficie_construccion_vendida'];
        $traslado->medidas_colindancias = $variables['medidas_colindancias'];
        $traslado->escritura_fecha = $variables['escritura_fecha'];
        $traslado->escritura_registro = $variables['escritura_registro'];
        $traslado->escritura_predio = $variables['escritura_predio'];
        $traslado->escritura_folio = $variables['escritura_folio'];
        $traslado->escritura_fecha = $variables['escritura_fecha'];
        $traslado->escritura_volumen = $variables['escritura_volumen'];
        $traslado->escritura_impuesto_desde = $variables['escritura_impuesto_desde'];
        $traslado->escritura_impuesto_hasta = $variables['escritura_impuesto_hasta'];

        //Como usuario notario, requiero que se validen los montos de terreno a vender no sean mayores que el declarado en el registro de predio.

        $predio = $this->padron->getByClaveOCuenta($traslado->clave);

        if($traslado->superficie_vendida > $predio->superficie_terreno){
            return Redirect::back()->with('error', 'La superficie vendida no puede ser mayor que la superficie del terreno.');
        }

        if($traslado->superficie_construccion_vendida > $predio->superficie_construccion){
            return Redirect::back()->with('error', 'La superficie de construcción vendida no puede ser mayor que la superficie de construcción del terreno');
        }

        if (!$traslado->save()) {
            return Redirect::back()->withErrors($traslado->errors());
        }

        //Dado que fue exitosa la actualización mostramos la salida al usuario.
        return Redirect::to('ofvirtual/notario/traslado/create')->with('success','¡Se ha creado correctamente el traslado de dominio para la cuenta ' . $traslado->cuenta .'!');
    }


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		// confirmar datos y confirmar folio

	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
        $traslado = Traslado::find($id);

        $predio = $this->padron->getByClaveOCuenta($traslado->clave);


        $comprador = personas::find($traslado->comprador_id);
        $vendedor = personas::find($traslado->vendedor_id);


        $traslado2 = (object) array_merge((array)$traslado, (array)$comprador, (array)$vendedor);

print_r($traslado2);
        // Title
        $title = 'Editar traslado de dominio';

         // Show the page
        return View:: make( 'ofvirtual.notario.traslado.edit', compact( 'title','traslado', 'predio'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
        //Buscamos el rol original relacionado con el id
        $traslado = Traslado::find($id);
        //Llenamos los parametros que vienen de la forma
       $traslado->fill(Input::all());

        //Si no puede guardarse entonces mostramos errores en pantalla
        if ( ! $traslado->save()) {
            return Redirect::back()->withErrors($this->traslado->errors());
        }

        //Dado que fue exitosa la actualización mostramos la salida al usaurio.
        return Redirect::to('ofvirtual.notario.traslado.edit'.$this->traslado->id.'/edit')->with('success','¡Se ha actualizado correctamente el rol: '. " !");
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


    public function buscar(){

        $q = Input::get('q');
        $tipo = Input::get('tipo');

        $traslados = new Traslado();
        $municipios = new Municipio();

        $uid = Auth::id();
        $user = Auth::user();

        if($user) {
            $municipios = $user->municipioIdArray();
            $roles = $user->roleIdArray();
        }
        if(trim($q) == '')
        {
            $traslados = [];
        }
        if($tipo == 'Folio')
        {
            $q = intval($q);
            $traslados = Traslado::where('folio', $q)->involucrado($uid, $roles, $municipios)->paginate($this->numPags);
        }
        if($tipo == 'Vendedor')
        {
            $traslados = Traslado::involucrado($uid, $roles, $municipios)->solicitanteNombreCompleto($q)->paginate($this->numPags);
        }
        if($tipo == 'Comprador')
        {
            $traslados = Traslado::involucrado($uid, $roles, $municipios)->notariaNombre($q)->paginate($this->numPags);
        }
        if($tipo == 'Ubicación de la propiedad')
        {
            $traslados = Traslado::involucrado($uid, $roles, $municipios)->tipoTramiteNombre($q)->paginate($this->numPags);
        }
        if($tipo == 'Clave')
        {
            $traslados = Traslado::involucrado($uid, $roles, $municipios)->fecha($q)->paginate($this->numPags);
        }
        if($tipo == 'Cuenta')
        {
            $traslados = Traslado::involucrado($uid, $roles, $municipios)->departamento($q)->paginate($this->numPags);
        }
        if (Request::ajax())
        {
            return View:: make( 'ofvirtual.notario.traslado.index',compact(['traslados']));
        }

        $title = 'Buscar traslados de dominio';

        return View:: make( 'ofvirtual.notario.traslado.index', compact( 'title' , 'traslados', 'municipios'));
    }

}
