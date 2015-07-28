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
        $notaria = Auth::user()->notaria->id_notaria;

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

        return View:: make('ofvirtual.notario.registro.index', compact('title', 'title_section', 'subtitle_section', 'traslados', 'municipios','registros','municipio','notaria'));

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

        $notaria = Auth::user()->notaria->id_notaria;

        $vialidad= TipoVialidad::orderBy('descripcion', 'ASC')->lists('descripcion', 'id');

        $asentamiento= TipoAsentamiento::orderBy('descripcion', 'ASC')->lists('descripcion', 'id');

        $entidad= Entidad::orderBy('nom_ent', 'ASC')->lists('nom_ent', 'gid');

          $JsonColindancias = NULL;

        return View:: make('ofvirtual.notario.registro.create', compact('title', 'registro', 'predio','notarioEscritura','notariaEscritura','municipio','notaria','vialidad','asentamiento','entidad','JsonColindancias'));
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



$enajenante = new personas();
$enajenante->fill(Input::get('enajenante'))->save();

//
$denajenante = new Domicilio();
$denajenante->fill(Input::get('Denajenante'))->save();



$adquiriente = new personas();
$adquiriente->fill(Input::get('adquiriente'))->save();

//
$dadquiriente = new Domicilio();
$dadquiriente->fill(Input::get('Dadquiriente'))->save();


/*$colindancias = new Colindancias();
$colindancias->fill(Input::get('colindancia'))->save();
*/

$antecedentes=Input::get('propiedad');

$registro = new RegistroEscritura();

$registro->tesoreria=Input::get('tesoreria');
$registro->municipio_id=Input::get('municipio_id');
$registro->cuenta=Input::get('cuenta');
$registro->clave=Input::get('clave');
$registro->tipo_predio=Input::get('tipo_predio');
$registro->notaria_id=Input::get('notaria_id');
$registro->escritura_num=Input::get('escritura_num');
$registro->volumen=Input::get('volumen');
$registro->naturaleza_acto=Input::get('naturaleza_acto');
$registro->fecha_instrumento=Input::get('fecha_instrumento');
$registro->fecha_firma=Input::get('fecha_firma');
$registro->valor_catastral=Input::get('valor_catastral');
$registro->importe_operacion=Input::get('importe_operacion');
$registro->avaluo_por=Input::get('avaluo_por');
$registro->antecedente_num=$antecedentes['antecedente_num'];
$registro->antecedente_folio=$antecedentes['antecedente_folio'];
$registro->clave_antecedente=$antecedentes['clave_antecedente'];
$registro->predio_antecedente=$antecedentes['predio_antecedente'];
$registro->lvm_antecedente=$antecedentes['lvm_antecedente'];
$registro->usuario_id=Auth::user()->id;
$registro->enajenante_id=$enajenante->id_p;
$registro->dir_enajenante_id=$denajenante->id;
$registro->adquiriente_id=$adquiriente->id_p;
$registro->dir_adquiriente_id=$dadquiriente->id;
$registro->save();
//print_r(Input::get('colindancia'));

 foreach(Input::get('colindancia') as $colindancia) {
          //hasta aqui funiona correctamente
           $colindancia['registro_id'] = $registro->id;
           //aqui ya no funciona no se si tenga que ver con el modelo
            $Colindancias[] = new RegistroColindancias($colindancia);
          //
        }
       // print_r($oColindancias);
        //aqui la varianble $Colindancias llega vacia
        $registro->colindancia()->saveMany($Colindancias);
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
