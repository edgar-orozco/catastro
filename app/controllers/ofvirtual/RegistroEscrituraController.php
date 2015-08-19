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
        $title_section = "Listado de Registros de Escritura. ";

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

        return View:: make('ofvirtual.notario.registro.index', compact('title', 'title_section', 'subtitle_section', 'municipios','registros','municipio','notaria'));

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
        //dd($identificador);

        $predio = $this->padron->getByClaveOCuenta($identificador);
      //  dd(Auth::user()->notaria);

        $notarioEscritura = Auth::user()->notaria->notario->nombres.' ' .Auth::user()->notaria->notario->apellido_paterno. ' '.Auth::user()->notaria->notario->apellido_materno;

        $notariaEscritura = Auth::user()->notaria->nombre.Auth::user()->notaria->mpio->nombre_municipio.Auth::user()->notaria->estado->nom_ent;

        //Si la clave no se encuentra
        if (!$predio) {
            return Redirect::to('ofvirtual/notario/registro-escrituras')->with('error', 'La clave o cuenta es incorrecta.');
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


$enajenanteR=Input::get('enajenante');
if($enajenanteR['id_p'])
{
   $enajenante_id=$enajenanteR['id_p'];
}else
{
    $enajenante = new personas();
    $enajenante->fill(Input::get('enajenante'))->save();
    $enajenante_id=$enajenante->id_p;

}


//
$domicilioE=Input::get('enajenanteDomicilio');
if($domicilioE['id'])
{
    $denajenante=$domicilioE['id'];
}else{
$denajenante = new Domicilio();
$denajenante->fill(Input::get('enajenanteDomicilio'))->save();
$denajenante=$denajenante->id;
}

$enajenanteA=Input::get('adquiriente');
if($enajenanteA['id_p'])
{
    $adquiriente_id=$enajenanteA['id_p'];
}else
{
    $adquiriente = new personas();
    $adquiriente->fill(Input::get('adquiriente'))->save();
    $adquiriente_id=$adquiriente->id_p;

}

//
$domicilioA=Input::get('adquirienteDomicilio');
if($domicilioA['id'])
{
    $dadquiriente=$domicilioA['id'];
}else{
$dadquiriente = new Domicilio();
$dadquiriente->fill(Input::get('adquirienteDomicilio'))->save();
$dadquiriente=$dadquiriente->id;
}

/*$colindancias = new Colindancias();
$colindancias->fill(Input::get('colindancia'))->save();
*/

//$antecedentes=Input::get('propiedad');

//clave unica de seguimineto con cosigo de barras
 //traemos el codigo del seguimiento
  $seguimiento=SolicitudGestion::cadenaSeguimientoUnica();
$antecendentes=Input::get('valor_catastral');

//print_r($antecendentes);
//dd($antecendentes);
  //generamos el codigo de barra
  $path_imagen = DNS1D::getBarcodePNGPath($seguimiento, "C128");

$registro = new RegistroEscritura();


$registro->tipo_escritura=Input::get('tipo_escritura');
$registro->cuenta=Input::get('cuenta');
$registro->clave=Input::get('clave');
$registro->tipo_predio=Input::get('tipo_predio');
$registro->notaria_id=Input::get('notaria_id');
$registro->volumen=Input::get('volumen');
$registro->importe_operacion=Input::get('importe_operacion');
$registro->antecedente_num=Input::get('antecedente_num');
$registro->valor_registro=Input::get('valor_registro');
$registro->folio_avaluo=Input::get('folio_avaluo');
$registro->valor_comercial=Input::get('valor_comercial');
$registro->seguimiento=$seguimiento;
$registro->usuario_id=Auth::user()->id;
$registro->enajenante_id=$enajenante_id;
$registro->dir_enajenante_id=$denajenante;
$registro->adquiriente_id=$adquiriente_id;
$registro->dir_adquiriente_id=$dadquiriente;
$registro->fecha_instrumento=Input::get('fecha_instrumento');
$registro->fecha_firma=Input::get('fecha_firma');
$registro->naturaleza_contrato=Input::get('naturaleza_contrato');
$registro->niveles=Input::get('niveles');
$registro->estado_conserv=Input::get('estado_conserv');


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

        //Dado que fue exitosa la creacion del traslado,  mostramos la salida al usuario.
        return Redirect::to('ofvirtual/notario/registro/show/' . $registro->id)->with('success', '¡Se ha creado correctamente el registro de escritura para la cuenta ' . $registro->cuenta . '!');

	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function buscar()
	{
		echo 'q'.$q = Input::get('q');
        echo 'tipo'.$tipo = Input::get('tipo');

        $registros = new RegistroEscritura();

        if ($tipo == 'Folio') {
            $registros = RegistroEscritura::whereFolio($q)->paginate($this->numPags);
        }
        if ($tipo == 'Enajenante') {
            $registros = RegistroEscritura::enajenanteNombreCompleto(strtoupper($q))->paginate($this->numPags);
        }
        if ($tipo == 'Adquiriente') {
            $registros = RegistroEscritura::adquirienteNombreCompleto(strtoupper($q))->paginate($this->numPags);
        }
        if ($tipo == 'Ubicación de la propiedad') {

            $ubicaciones = RegistroEscritura::ubicacion(strtoupper(trim($q)))->paginate($this->numPags);

            $registrosArr = array();
            foreach ($ubicaciones as $ubicacion) {
                try {
                    $registrosArr[] = RegistroEscritura::find($ubicacion->id);
                } catch (Exception $e) {
                }

            }
            $registros = $registrosArr;

            //
        }
        if ($tipo == 'Clave') {
            $registros = RegistroEscritura::whereClave($q)->paginate($this->numPags);
        }
        if ($tipo == 'Cuenta') {
            $registros = RegistroEscritura::whereCuenta($q)->paginate($this->numPags);
        }
        if ($tipo == 'Seguimiento') {
            $registros = RegistroEscritura::whereSeguimiento($q)->paginate($this->numPags);
    }
        if (Request::ajax()) {
            return View:: make('ofvirtual.notario.registro._list', compact(['registros']));
        }

        return $registros;
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
        $registro = RegistroEscritura::find($id);

        $propiedad =(object) $arrayName = array('antecedente_num' =>  $registro['antecedente_num'],'valor_registro' =>$registro['valor_registro'] ,'folio_avaluo' => $registro['folio_avaluo'],'valor_comercial' =>$registro['valor_comercial'] );

        //$registro->antecendentes->$propiedad;
       //print_r($propiedad);
       //dd($propiedad);
        $identificador = strtoupper($registro['cuenta']);
      // dd($identificador);
       $predio = $this->padron->getByClaveOCuenta($identificador);
       // $predio = $this->padron->getByClaveOCuenta($identificador);


        //$predio->ubicacionFiscal->ubicacion = $registro->ubicacion;
        //$predio->superficie_terreno = $registro->superficie_terreno;
        //$predio->superficie_construccion = $registro->superficie_construccion;
        //dd($predio);
        //enajenante
        $enajenante = personas::find($registro->enajenante_id);
        $registro->enajenante->fill($enajenante->toArray());

        //enajenante
        $dirEnajenante = Domicilio::find($registro->dir_enajenante_id);
        $registro->enajenanteDomicilio->fill($dirEnajenante->toArray());

        //adquiriente
        $adquiriente = personas::find($registro->adquiriente_id);
        $registro->adquiriente->fill($adquiriente->toArray());

        //enajenante
        $dirAdquiriente = Domicilio::find($registro->dir_adquiriente_id);
        $registro->adquirienteDomicilio->fill($dirAdquiriente->toArray());

        $registro->registro = $registro;

        $notaria = Notaria::find($registro->notaria_id);
        $notariaEscritura = $notaria->nombre.$notaria->mpio->nombre_municipio.$notaria->estado->nom_ent;

        $notario = Notaria::where('id_notario', $notaria->id_notario)->first();

        $notarioEscritura = $notario->notario->nombres.' ' .$notario->notario->apellido_paterno. ' '.$notario->notario->apellido_materno;
        //$JsonColindancias = $traslado->colindancia->toJson();
        // Title
        $title = 'Editar registro de dominio';
         $notaria = Auth::user()->notaria->id_notaria;

        $municipio = Municipio::orderBy('nombre_municipio', 'ASC')->lists('nombre_municipio', 'municipio');

        $vialidad= TipoVialidad::orderBy('descripcion', 'ASC')->lists('descripcion', 'id');

        $asentamiento= TipoAsentamiento::orderBy('descripcion', 'ASC')->lists('descripcion', 'id');

        $entidad= Entidad::orderBy('nom_ent', 'ASC')->lists('nom_ent', 'gid');

        //Se pasan las colindancias para el macro de colindancias como objeto JSON
        $JsonColindancias = $registro->colindancia->toJson();


        // Show the page
        //return View:: make('ofvirtual.notario.traslado.edit', compact('title', 'traslado', 'predio', 'JsonColindancias'));
        return View:: make('ofvirtual.notario.registro.edit', compact('propiedad','title', 'registro', 'predio', 'notarioEscritura','notariaEscritura','notaria','municipio','notaria','vialidad','asentamiento','entidad','JsonColindancias'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{

        //Buscamos el traslado original relacionado con el id
        $registro = RegistroEscritura::find($id);
        //
        //
        $registro['dir_enajenante_id'];

        $denajenante = Domicilio::find($registro['dir_enajenante_id']);

        $denajenante->fill(Input::get('enajenanteDomicilio'))->save();

        $dadquiriente = Domicilio::find($registro['dir_adquiriente_id']);

        $dadquiriente->fill(Input::get('adquirienteDomicilio'))->save();

      //  dd($dadquiriente);

        //Busca Enajenante
        $datosEnajenante = Input::get('enajenante');

        //print_r($datosEnajenante);
       // dd($datosEnajenante);
        $enajenanteRFC = $datosEnajenante['rfc'];
        $enajenanteCurp = $datosEnajenante['curp'];
        $enajenanteTipo = $datosEnajenante['id_tipo'];
        //
        if ($enajenanteTipo == 2) {
            $enajenanteExistente = personas::findPorCurpRFC($enajenanteRFC);
        }
        else{
            $enajenanteExistente = personas::findPorCurpRFC($enajenanteCurp);
        }
        //dd($enajenanteExistente);

        //si existe, update
        if (!empty($enajenanteExistente)) {
            $enajenante = personas::find($enajenanteExistente['id_p']);
            $datosEnajenante = Input::get('enajenante');
            $enajenante->fill($datosEnajenante);


            if (!$enajenante->save()) {
                return Redirect::back()->with('error', 'Error en datos del enajenante.');
            }
        } //si no existe, insert
        else {
            $enajenante = new personas();

            $enajenante->fill($datosEnajenante);

            if (!$enajenante->save()) {
                return Redirect::back()->with('error', 'Error en datos del enajenante.');
            }
        }
        //


        //Busca Adquiriente
        $datosAdquiriente = Input::get('adquiriente');

        $adquirienteRFC = $datosAdquiriente['rfc'];
        $adquirienteCurp = $datosAdquiriente['curp'];
        $adquirienteTipo = $datosAdquiriente['id_tipo'];
        if ($adquirienteTipo == 2) {
            $adquirienteExistente = personas::findPorCurpRFC($adquirienteRFC);
        }
        else{
            $adquirienteExistente = personas::findPorCurpRFC($adquirienteCurp);
        }

        //si existe, update
        if (!empty($adquirienteExistente)) {
            $adquiriente = personas::find($adquirienteExistente['id_p']);
            $datosAdquiriente = Input::get('adquiriente');
            $adquiriente->fill($datosAdquiriente);


            if (!$adquiriente->save()) {
                return Redirect::back()->with('error', 'Error en datos del adquiriente.');
            }
        } //si no existe, insert
        else {
            $adquiriente = new personas();

            $adquiriente->fill($datosAdquiriente);

            if (!$adquiriente->save()) {
                return Redirect::back()->with('error', 'Error en datos del adquiriente.');
            }
        }
        //
$antecendentes=Input::get('antecendentes');

$registro->tipo_escritura=Input::get('tipo_escritura');
$registro->cuenta=Input::get('cuenta');
$registro->clave=Input::get('clave');
$registro->tipo_predio=Input::get('tipo_predio');
$registro->notaria_id=Input::get('notaria_id');
$registro->volumen=Input::get('volumen');
$registro->valor_catastral=Input::get('valor_catastral');
$registro->importe_operacion=Input::get('importe_operacion');
$registro->antecedente_num=Input::get('antecedente_num');
$registro->valor_registro=Input::get('valor_registro');
$registro->folio_avaluo=Input::get('folio_avaluo');
$registro->valor_comercial=Input::get('valor_comercial');
$registro->usuario_id=Auth::user()->id;
$registro->enajenante_id=$enajenante->id_p;
$registro->adquiriente_id= $adquiriente->id_p;

$registro->fecha_instrumento=Input::get('fecha_instrumento');
$registro->fecha_firma=Input::get('fecha_firma');
$registro->naturaleza_contrato=Input::get('naturaleza_contrato');
$registro->niveles=Input::get('niveles');
$registro->estado_conserv=Input::get('estado_conserv');


        if (!$registro->save()) {
            return Redirect::back()->withInput()->withErrors($registro->errors());
        }

        //Dado que fue exitosa la actualización mostramos la salida al usuario.
        return Redirect::to('ofvirtual/notario/registro/show/' . $registro->id)->with('success', '¡Se ha editado correctamente el registro de dominio para la cuenta ' . $registro->cuenta . '!');
    
	}


    public function autocomplete()
    {
          $term = Str::upper(Input::get('term'));
        //ARRAY DONDE CARGA LOS DATOS
        $results = array();

        $id_p = array();
        //CONSULTA A LA TABLA PERSONAS
        $queries = DB::select(DB::raw("SELECT * FROM personas WHERE curp LIKE '%" . $term . "%' limit 5"));

        //DONDE LLAMA LOS DATOS Y LOS PASA A LAS VARIABLES CORRESPONDIENTES
        foreach ($queries as $query) {
            //ARRAY DONDE CARGA LOS DATOS
            //$id_p[] = ['id_p' => $query->id_p];

            $results[] = ['value' => $query->curp , 'id' => $query->id_p, 'nombres' => $query->nombres, 'apellido_paterno' => $query->apellido_paterno, 'apellido_materno'=>$query->apellido_materno,'rfc'=>$query->rfc];
        }
        if ($results) {
            //$results=$results->id;
            //SI EXITE LA PERSONA
            return Response::json($results);
        } else {
            //SI NO EXITE LA PAERSONA
            $mensaje[] = "NO EXISTE LA PERSONAS";
            return Response::json($mensaje);
        }

    }
    public function show($id)
    {

        // confirmar datos y confirmar folio
        $registro = RegistroEscritura::find($id);

        $predio = $this->padron->getByClaveOCuenta($registro->clave);
        
        //enajenante
        $enajenante = personas::find($registro->enajenante_id);
        $registro->enajenante->fill($enajenante->toArray());

        //adquiriente
        $adquiriente = personas::find($registro->adquiriente_id);
        $registro->adquiriente->fill($adquiriente->toArray());

        $registro->registro = $registro;

        $notaria = Notaria::find($registro->notaria_id);
        $registro->notariaEscritura = $notaria->id_notario.$notaria->nombre.$notaria->mpio->nombre_municipio.$notaria->estado->nom_ent;

         $notario = Notaria::where('id_notario', $notaria->id_notario)->first();
        $registro->notarioEscritura = $notario->notario->nombres.' ' .$notario->notario->apellido_paterno. ' '.$notario->notario->apellido_materno;

         $domicilioE = Domicilio::domicilioCompleto($registro->dir_enajenante_id);
        $domicilioA = Domicilio::domicilioCompleto($registro->dir_adquiriente_id);

        // Title
        $title = 'Editar registro de escritura';

        //municipio
        $municipio=Municipio::where('municipio',$registro->municipio_id)->pluck('nombre_municipio');

         $JsonColindancias = $registro->colindancia->toJson();
         
        // print_r($domicilioC);
        //dd($domicilioC);
        // Show the page
        return View:: make('ofvirtual.notario.registro.show', compact('title', 'registro', 'predio','notaria','municipio','JsonColindancias','domicilioE','domicilioA'));

        //print_r($registro);
    }
       public function asignarFolio($id)
    {

        $registro = RegistroEscritura::find($id);

        //ToDo: generar folios correctos
        $registro->folio = rand(1, 1000000);

        if (!$registro->save()) {
            return Redirect::back()->withInput()->withErrors($registro->errors());
        }

        // Show the page
        return Redirect::to('/ofvirtual/notario/registro-escrituras')->with('success', '¡Se ha finalizado correctamente el traslado!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
        //ToDo: revisar primero que no tenga asignado un folio, si tiene asigando un folio no se puede borrar
        $colindancias = Colindancias::where('registro_id',$id);
        $colindancias->delete();

        $registro = RegistroEscritura::find($id);
        $registro->delete();

        $domicilioE = Domicilio::find($registro->dir_enajenante_id);
        $domicilioE->delete();

        $domicilioA = Domicilio::find($registro->dir_adquiriente_id);
        $domicilioA->delete();

        $enajenante = personas::find($registro->enajenante_id);
        $enajenante->delete();

        $adquiriente = personas::find($registro->adquiriente_id);
        $adquiriente->delete();

        
        
        

        return Redirect::to('/ofvirtual/notario/registro-escrituras')->with('success', '¡Se ha eliminado correctamente el registro!');


    }

    public function imprimir($id)
    {
            // confirmar datos y confirmar folio
        $registro = RegistroEscritura::find($id);

        $predio = $this->padron->getByClaveOCuenta($registro->clave);

        //enajenante
        $enajenante = personas::find($registro->enajenante_id);
        $registro->enajenante->fill($enajenante->toArray());

        //adquiriente
        $adquiriente = personas::find($registro->adquiriente_id);
        $registro->adquiriente->fill($adquiriente->toArray());

        $registro->registro = $registro;

        $notaria = Notaria::find($registro->notaria_id);
        $registro->notariaEscritura = $notaria->nombre.$notaria->mpio->nombre_municipio.$notaria->estado->nom_ent;

        $notario = Notaria::where('id_notario', $notaria->id_notario)->first();
        $registro->notarioEscritura = $notario->notario->nombres.' ' .$notario->notario->apellido_paterno. ' '.$notario->notario->apellido_materno;

        // Title
        $title = 'Imprimir registro de escritura';

        //barcodes
        $seguimiento = DNS1D::getBarcodePNGPath($registro->seguimiento, "C128");

        $colindancias = Colindancias::where('registro_id',$id);

        $notaria = Notaria::find($registro->notaria_id);
        $registro->notariaEscritura = $notaria->id_notario.$notaria->nombre.$notaria->mpio->nombre_municipio.$notaria->estado->nom_ent;

         $notario = Notaria::where('id_notario', $notaria->id_notario)->first();
        $registro->notarioEscritura = $notario->notario->nombres.' ' .$notario->notario->apellido_paterno. ' '.$notario->notario->apellido_materno;

         $JsonColindancias = $registro->colindancia->toJson();

          //barcodes
        $seguimiento = DNS1D::getBarcodePNGPath($registro->seguimiento, "C128");
        $domicilioE = Domicilio::domicilioCompleto($registro->dir_enajenante_id);
        $domicilioA = Domicilio::domicilioCompleto($registro->dir_adquiriente_id);

       

        // Show the page
        $vista =  View:: make('ofvirtual.notario.registro.pdf', compact('domicilioE', 'domicilioA', 'title', 'registro', 'predio','seguimiento','colindancias','notaria','notario','JsonColindancias'));
        
        //devuelvo los datos en PDF
        $pdf      = PDF::load($vista)->show("Registro-Escritura");
        $response = Response::make($pdf, 200);
        $response->header('Content-Type', 'application/pdf');
        return $response;
    }

  public
    function getEnajenante()
    {
        $q = Input::get('term');
        if (Request::ajax()) {
            $persona=personas::getPorCurpRFC($q);
          //  

            foreach($persona as $key)
            {

           $idp=$key['id_p'];
            $dir= RegistroEscritura::where('enajenante_id', $idp)->orWhere('adquiriente_id',$idp)->pluck('dir_enajenante_id');
            $domicilio = Domicilio::where('id',$dir)->get();
            $domicilio=json_decode($domicilio,true);
//
            //$persona->domicilio->$domicilio; dd($persona);
if($domicilio)
{
//dd($domicilio);
        $persona=json_decode($persona,true);
        //$domicilio=json_decode($domicilio,true);
foreach ($domicilio as $clave=>$valor)
        {
         $persona[0][$clave]=$valor;
         $persona[0]['control']='lleno';
        }
}else{
    $i=0;
    foreach ($persona as $key ) {
    $persona[$i]['control']='vacio';
    $i++;
}
}
}
//dd(json_encode($persona));
  return json_encode($persona);

        }
    }


    public
    function getAdquiriente()
    {
        $q = Input::get('term');
        if (Request::ajax()) {
            $persona = personas::getPorCurpRFC($q);

             $idp=$persona[0]['id_p'];
            $dir= RegistroEscritura::where('enajenante_id', $idp)->orWhere('adquiriente_id',$idp)->pluck('dir_enajenante_id');
            $domicilio = Domicilio::where('id',$dir)->get();

            //$persona->domicilio->$domicilio; dd($persona);

        $persona=json_decode($persona,true);
        $domicilio=json_decode($domicilio,true);

foreach ($domicilio as $clave=>$valor)
        {
         $persona[0][$clave]=$valor;
        }

//dd($persona);
  return json_encode($persona);
    }
}

}
