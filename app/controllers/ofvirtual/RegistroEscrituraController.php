<?php
use \Catastro\Repos\Padron\PadronRepositoryInterface;
class ofvirtual_RegistroEscrituraController extends \BaseController {

protected $padron;
    protected $registro;

    protected $numPags = 10;

    /**
     * @param PadronRepositoryInterface $padron
     */
    public function __construct(PadronRepositoryInterface $padron, RegistroEscritura $registro)
    {
        $this->padron = $padron;
        $this->registro = $registro;
    }
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		  //
        $title = 'Listas de Registro de Escritura';

        //Título de sección:
        $title_section = "Listado de de Registros de Escritura. ";

        //Subtítulo de sección:
        $subtitle_section = "Crear, modificar, buscar, imprimir.";


        $registros = RegistroEscritura::all();

        $misMunicipios = Auth::user()->municipios()->get(['gid']);

        $aMisMunicipios = array();
        foreach ($misMunicipios as $mun) {
            $aMisMunicipios[] = $mun->gid;
        }

        if (empty($aMisMunicipios)) {
            $municipios = Municipio::orderBy('nombre_municipio')->get();
        } else {
            $municipios = Municipio::whereIn('gid', $aMisMunicipios)->orderBy('nombre_municipio')->get();
        }

		$municipio = Municipio::orderBy('nombre_municipio', 'ASC')->lists('nombre_municipio', 'municipio');

        return View:: make('ofvirtual.notario.registro.index', compact('title', 'title_section', 'subtitle_section', 'traslados', 'municipios','registros','municipio'));

	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{

     //ToDo: no muestra el titulo ?
        $title = 'Crear registro de escritura';

        $registro = new RegistroEscritura();

        $identificador = Request::get('clave');

        $identificador = strtoupper($identificador);

        $predio = $this->padron->getByClaveOCuenta($identificador);

        $notarioEscritura = Auth::user()->notaria->notario->nombres.' ' .Auth::user()->notaria->notario->apellido_paterno. ' '.Auth::user()->notaria->notario->apellido_materno;

        $notariaEscritura = Auth::user()->notaria->nombre.Auth::user()->notaria->mpio->nombre_municipio.Auth::user()->notaria->estado->nom_ent;

        //Si la clave no se encuentra
        if (!$predio) {
            return Redirect::to('ofvirtual/notario/registro')->with('error', 'La clave o cuenta es incorrecta.');
        }

        //$JsonColindancias = NULL;
$municipio = Municipio::orderBy('nombre_municipio', 'ASC')->lists('nombre_municipio', 'municipio');
        return View:: make('ofvirtual.notario.registro.create', compact('title', 'registro', 'predio','notarioEscritura','notariaEscritura','municipio'));
        //return View:: make('ofvirtual.notario.traslado.create', compact('title', 'traslado', 'predio','notarioEscritura','notariaEscritura',  'JsonColindancias'));




    ///////////////////////////////////////////////////////////////
		/*$title = "Captura de datos";
		 //Título de sección:
        $title_section = "Captura de datos. ";



	 $municipios = Municipio::orderBy('nombre_municipio', 'ASC')->lists('nombre_municipio', 'municipio');
		 return View::make('ofvirtual.notario.registro._form',compact('municipios','title',  'title_section', 'subtitle_section'));
            compact('title', 'title_section','subtitle_section', 'inpc', 'inpcs', 'mes', 'anio'));
		  $persona = new personas();
			$persona->fill(Input::get('persona'))->save();
			Session::flash('mensaje', 'El registro ha sido ingresado exitosamente');
      return Response::json(array
        (
          'valor' => 'exito'
        ));*/

}
	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function buscar($id)
	{
		//
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


}
