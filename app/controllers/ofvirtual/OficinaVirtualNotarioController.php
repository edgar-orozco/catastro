<?php
use \Catastro\Repos\Padron\PadronRepositoryInterface;

class OficinaVirtualNotarioController extends \BaseController {

    protected $padron;
    protected $traslado;

    protected $numPags = 10;

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

        $vendedor = new personas();
        $datosVendedor = array_map('mb_strtoupper',(Input::get('vendedor')));
        $datosVendedor['nombrec'] = $datosVendedor['nombres'] .' '.$datosVendedor['apellido_paterno'].' ' .$datosVendedor['apellido_materno'];
        $vendedor->fill($datosVendedor);

        if (!$vendedor->save()) {
            return Redirect::back()->with('error', 'Error en datos del vendedor.');
        }


        $comprador = new personas();
        $datosComprador = array_map('mb_strtoupper',(Input::get('comprador')));
        $datosComprador['nombrec'] = $datosComprador['nombres'].' '. $datosComprador['apellido_paterno'].' ' .$datosComprador['apellido_materno'];
        $comprador->fill($datosComprador);

        if (!$comprador->save()) {
            return Redirect::back()->with('error', 'Error en datos del comprador.');
        }

        $traslado = new Traslado();
        $traslado->fill(array_filter(Input::get('traslado')));
        $traslado->usuario_id = $usuarioId;
        $traslado->notaria_id = $notariaId;
        $traslado->vendedor_id = $vendedor->id_p;
        $traslado->comprador_id = $comprador->id_p;

        //Como usuario notario, requiero que se validen los montos de terreno a vender no sean mayores que el declarado en el registro de predio.
        $predio = $this->padron->getByClaveOCuenta($traslado->clave);

        if($traslado->superficie_vendida > $predio->superficie_terreno){
            return Redirect::back()->withInput()->with('error', 'La superficie vendida no puede ser mayor que la superficie del terreno.');
        }

        if($traslado->superficie_construccion_vendida > $predio->superficie_construccion){
            return Redirect::back()->withInput()->with('error', 'La superficie de construcción vendida no puede ser mayor que la superficie de construcción del terreno');
        }

        if (!$traslado->save()) {
            return Redirect::back()->withInput()->withErrors($traslado->errors());
        }

        //Dado que fue exitosa la actualización mostramos la salida al usuario.
        return Redirect::to('ofvirtual/notario/traslado')->with('success','¡Se ha creado correctamente el traslado de dominio para la cuenta ' . $traslado->cuenta .'!');
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

        //vendedor
        $vendedor= personas::find($traslado->vendedor_id);
        $traslado->vendedor->fill($vendedor->toArray());

        //comprador
        $comprador= personas::find($traslado->comprador_id);
        $traslado->comprador->fill($comprador->toArray());

        $traslado->traslado = $traslado;
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
		//ToDo: revisar primero que no tenga asignado un folio, si tiene asigando un folio no se puede editar

        //Buscamos el traslado original relacionado con el id
        $traslado = Traslado::find($id);
        //

        //ToDo: checar si se puede hacer update de notaria y usuario
        //$usuarioId = Auth::id();
        //$notariaId =  1;

        $vendedor = personas::find($traslado->vendedor_id);
        $datosVendedor = array_map('mb_strtoupper',(Input::get('vendedor')));
        $datosVendedor['nombrec'] = $datosVendedor['nombres'] .' '.$datosVendedor['apellido_paterno'].' ' .$datosVendedor['apellido_materno'];
        $vendedor->fill($datosVendedor);

        if (!$vendedor->save()) {
            return Redirect::back()->with('error', 'Error en datos del vendedor.');
        }

        $comprador = personas::find($traslado->comprador_id);
        $datosComprador = array_map('mb_strtoupper',(Input::get('comprador')));
        $datosComprador['nombrec'] = $datosComprador['nombres'].' '. $datosComprador['apellido_paterno'].' ' .$datosComprador['apellido_materno'];
        $comprador->fill($datosComprador);


        if (!$comprador->save()) {
            return Redirect::back()->with('error', 'Error en datos del comprador.');
        }

        $traslado->fill(array_filter(Input::get('traslado')));

        //Como usuario notario, requiero que se validen los montos de terreno a vender no sean mayores que el declarado en el registro de predio.
        $predio = $this->padron->getByClaveOCuenta($traslado->clave);

        if($traslado->superficie_vendida > $predio->superficie_terreno){
            return Redirect::back()->withInput()->with('error', 'La superficie vendida no puede ser mayor que la superficie del terreno.');
        }

        if($traslado->superficie_construccion_vendida > $predio->superficie_construccion){
            return Redirect::back()->withInput()->with('error', 'La superficie de construcción vendida no puede ser mayor que la superficie de construcción del terreno');
        }

        if (!$traslado->save()) {
            return Redirect::back()->withInput()->withErrors($traslado->errors());
        }

        //Dado que fue exitosa la actualización mostramos la salida al usuario.
        return Redirect::to('ofvirtual/notario/traslado/edit/'.$traslado->id)->with('success','¡Se ha actualizado correctamente el traslado!');
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
        //ToDo: revisar primero que no tenga asignado un folio, si tiene asigando un folio no se puede borrar

        $traslado = Traslado::find($id);

        $traslado->delete();

        $vendedor = personas::find($traslado->vendedor_id);
        $vendedor->delete();

        $comprador = personas::find($traslado->comprador_id);
        $comprador->delete();

        return Redirect::to('ofvirtual/notario/traslado')->with('success','¡Se ha eliminado correctamente el traslado!');



	}


    public function buscar(){

        $q = Input::get('q');
        $tipo = Input::get('tipo');

        $traslados = new Traslado();

        if($tipo == 'Folio')
        {
            $traslados = Traslado::whereFolio($q)->paginate($this->numPags);
        }
        if($tipo == 'Vendedor')
        {
            $traslados = Traslado::vendedorNombreCompleto(strtoupper($q))->paginate($this->numPags);
        }
        if($tipo == 'Comprador')
        {
            $traslados = Traslado::compradorNombreCompleto(strtoupper($q))->paginate($this->numPags);
        }
        if($tipo == 'Ubicación de la propiedad') {

                $ubicaciones = Traslado::ubicacion(strtoupper(trim($q)))->paginate($this->numPags);

                $trasladosArr = array();
                foreach ($ubicaciones as $ubicacion) {
                    try {
                         $trasladosArr[] = Traslado::find($ubicacion->id);
                    }catch(Exception $e){ }

                }
                $traslados = $trasladosArr;

           //
        }
        if($tipo == 'Clave')
        {
            $traslados = Traslado::whereClave($q)->paginate($this->numPags);
        }
        if($tipo == 'Cuenta')
        {
            $traslados = Traslado::whereCuenta($q)->paginate($this->numPags);
        }
        if (Request::ajax())
        {
            return View:: make( 'ofvirtual.notario.traslado._list',compact(['traslados']));
        }

        return $traslados;

    }


}
