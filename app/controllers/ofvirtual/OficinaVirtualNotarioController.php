<?php
use \Catastro\Repos\Padron\PadronRepositoryInterface;

class OficinaVirtualNotarioController extends \BaseController
{

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

        //Título de sección:
        $title_section = "Listado de Traslados de Dominio. ";

        //Subtítulo de sección:
        $subtitle_section = "Crear, modificar, buscar, imprimir.";


        $traslados = Traslado::all();

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

        return View:: make('ofvirtual.notario.traslado.index', compact('title', 'title_section', 'subtitle_section', 'traslados', 'municipios'));

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

        $notarioEscritura = Auth::user()->notaria->notario->nombres.' ' .Auth::user()->notaria->notario->apellido_paterno. ' '.Auth::user()->notaria->notario->apellido_materno;

        $notariaEscritura = Auth::user()->notaria->nombre.Auth::user()->notaria->mpio->nombre_municipio.Auth::user()->notaria->estado->nom_ent;

        //Si la clave no se encuentra
        if (!$predio) {
            return Redirect::to('ofvirtual/notario/traslado')->with('error', 'La clave o cuenta es incorrecta.');
        }

        return View:: make('ofvirtual.notario.traslado.create', compact('title', 'traslado', 'predio','notarioEscritura','notariaEscritura'));

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

        //

        $notarioEscrituraId = Auth::user()->notaria->id_notario;

        $notariaEscrituraId = Auth::user()->notaria->id_notaria;


        $enajenante = new personas();
        $datosEnajenante = Input::get('enajenante');
        $enajenante->fill($datosEnajenante);

        if (!$enajenante->save()) {
            return Redirect::back()->with('error', 'Error en datos del enajenante.');
        }

        $adquiriente = new personas();
        $datosAdquiriente = Input::get('adquiriente');
        $adquiriente->fill($datosAdquiriente);

        if (!$adquiriente->save()) {
            return Redirect::back()->with('error', 'Error en datos del adquiriente.');
        }

        $traslado = new Traslado();
        $traslado->fill(array_filter(Input::get('traslado')));

        $seguimiento = Traslado::cadenaSeguimientoUnica(SeguimientoHelper::generarClave());;
        $traslado->seguimiento = $seguimiento;

        $traslado->usuario_id = $usuarioId;
        $traslado->notario_escritura_id = $notarioEscrituraId;
        $traslado->notaria_escritura_id = $notariaEscrituraId;
        $traslado->enajenante_id = $enajenante->id_p;
        $traslado->adquiriente_id = $adquiriente->id_p;

        //Como usuario notario, requiero que se validen los montos de terreno a vender no sean mayores que el declarado en el registro de predio.
        $predio = $this->padron->getByClaveOCuenta($traslado->clave);

        if ($traslado->superficie_vendida > $predio->superficie_terreno) {
            return Redirect::back()->withInput()->with('error', 'La superficie vendida no puede ser mayor que la superficie del terreno.');
        }

        if ($traslado->superficie_construccion_vendida > $predio->superficie_construccion) {
            return Redirect::back()->withInput()->with('error', 'La superficie de construcción vendida no puede ser mayor que la superficie de construcción del terreno');
        }

        if (!$traslado->save()) {
            return Redirect::back()->withInput()->withErrors($traslado->errors());
        }


        //Dado que fue exitosa la creacion del traslado,  mostramos la salida al usuario.
        return Redirect::to('ofvirtual/notario/traslado/show/' . $traslado->id)->with('success', '¡Se ha creado correctamente el traslado de dominio para la cuenta ' . $traslado->cuenta . '!');
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {

        // confirmar datos y confirmar folio
        $traslado = Traslado::find($id);

        $predio = $this->padron->getByClaveOCuenta($traslado->clave);

        //enajenante
        $enajenante = personas::find($traslado->enajenante_id);
        $traslado->enajenante->fill($enajenante->toArray());

        //adquiriente
        $adquiriente = personas::find($traslado->adquiriente_id);
        $traslado->adquiriente->fill($adquiriente->toArray());

        $traslado->traslado = $traslado;

        $notario = Notaria::where('id_notario', $traslado->notario_escritura_id)->first();
        $traslado->notarioEscritura = $notario->notario->nombres.' ' .$notario->notario->apellido_paterno. ' '.$notario->notario->apellido_materno;

        $notaria = Notaria::find($traslado->notaria_escritura_id);
        $traslado->notariaEscritura = $notaria->nombre.$notaria->mpio->nombre_municipio.$notaria->estado->nom_ent;

        // Title
        $title = 'Editar traslado de dominio';

        // Show the page
        return View:: make('ofvirtual.notario.traslado.show', compact('title', 'traslado', 'predio'));

    }

    public function imprimir($id){

        // confirmar datos y confirmar folio
        $traslado = Traslado::find($id);

        $predio = $this->padron->getByClaveOCuenta($traslado->clave);

        //enajenante
        $enajenante = personas::find($traslado->enajenante_id);
        $traslado->enajenante->fill($enajenante->toArray());

        //adquiriente
        $adquiriente = personas::find($traslado->adquiriente_id);
        $traslado->adquiriente->fill($adquiriente->toArray());

        $traslado->traslado = $traslado;

        $notario = Notaria::where('id_notario', $traslado->notario_escritura_id)->first();
        $traslado->notarioEscritura = $notario->notario->nombres.' ' .$notario->notario->apellido_paterno. ' '.$notario->notario->apellido_materno;

        $notaria = Notaria::find($traslado->notaria_escritura_id);
        $traslado->notariaEscritura = $notaria->nombre.$notaria->mpio->nombre_municipio.$notaria->estado->nom_ent;

        // Title
        $title = 'Imprimir traslado de dominio';

        //barcodes
        $seguimiento = DNS1D::getBarcodePNGPath($traslado->seguimiento, "C128");

        // Show the page
        $vista =  View:: make('ofvirtual.notario.traslado.pdf', compact('title', 'traslado', 'predio','seguimiento'));
        //devuelvo los datos en PDF
        $pdf      = PDF::load($vista)->show();
        $response = Response::make($pdf, 200);
        $response->header('Content-Type', 'application/pdf');
        return $response;
    }

    public function asignarFolio($id)
    {

        $traslado = Traslado::find($id);

        //ToDo: generar folios correctos
        $traslado->folio = rand(1, 1000000);

        if (!$traslado->save()) {
            return Redirect::back()->withInput()->withErrors($traslado->errors());
        }

        // Show the page
        return Redirect::to('ofvirtual/notario/traslado/')->with('success', '¡Se ha finalizado correctamente el traslado!');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        //
        $traslado = Traslado::find($id);

        $predio = $this->padron->getByClaveOCuenta($traslado->clave);

        //enajenante
        $enajenante = personas::find($traslado->enajenante_id);
        $traslado->enajenante->fill($enajenante->toArray());

        //adquiriente
        $adquiriente = personas::find($traslado->adquiriente_id);
        $traslado->adquiriente->fill($adquiriente->toArray());

        $traslado->traslado = $traslado;

        $notario = Notaria::where('id_notario', $traslado->notario_escritura_id)->first();

        $notarioEscritura = $notario->notario->nombres.' ' .$notario->notario->apellido_paterno. ' '.$notario->notario->apellido_materno;

        $notaria = Notaria::find($traslado->notaria_escritura_id);
        $notariaEscritura = $notaria->nombre.$notaria->mpio->nombre_municipio.$notaria->estado->nom_ent;



        //$JsonColindancias = $traslado->colindancia->toJson();
        // Title
        $title = 'Editar traslado de dominio';

        // Show the page
        //return View:: make('ofvirtual.notario.traslado.edit', compact('title', 'traslado', 'predio', 'JsonColindancias'));
        return View:: make('ofvirtual.notario.traslado.edit', compact('title', 'traslado', 'predio', 'notarioEscritura','notariaEscritura'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
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

        $enajenante = personas::find($traslado->enajenante_id);
        $datosEnajenante = Input::get('enajenante');
        $enajenante->fill($datosEnajenante);

        if (!$enajenante->save()) {
            return Redirect::back()->with('error', 'Error en datos del enajenante.');
        }

        $adquiriente = personas::find($traslado->adquiriente_id);
        $datosAdquiriente = Input::get('adquiriente');
        $adquiriente->fill($datosAdquiriente);


        if (!$adquiriente->save()) {
            return Redirect::back()->with('error', 'Error en datos del adquiriente.');
        }

        $traslado->fill(array_filter(Input::get('traslado')));

        //Como usuario notario, requiero que se validen los montos de terreno a vender no sean mayores que el declarado en el registro de predio.
        $predio = $this->padron->getByClaveOCuenta($traslado->clave);

        if ($traslado->superficie_vendida > $predio->superficie_terreno) {
            return Redirect::back()->withInput()->with('error', 'La superficie vendida no puede ser mayor que la superficie del terreno.');
        }

        if ($traslado->superficie_construccion_vendida > $predio->superficie_construccion) {
            return Redirect::back()->withInput()->with('error', 'La superficie de construcción vendida no puede ser mayor que la superficie de construcción del terreno');
        }

        if (!$traslado->save()) {
            return Redirect::back()->withInput()->withErrors($traslado->errors());
        }

        //Dado que fue exitosa la actualización mostramos la salida al usuario.
          return Redirect::to('ofvirtual/notario/traslado/show/' . $traslado->id)->with('success', '¡Se ha editado correctamente el traslado de dominio para la cuenta ' . $traslado->cuenta . '!');
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

        $traslado = Traslado::find($id);

        $traslado->delete();

        $enajenante = personas::find($traslado->enajenante_id);
        $enajenante->delete();

        $adquiriente = personas::find($traslado->adquiriente_id);
        $adquiriente->delete();



        return Redirect::to('ofvirtual/notario/traslado')->with('success', '¡Se ha eliminado correctamente el traslado!');


    }


    public function buscar()
    {

        $q = Input::get('q');
        $tipo = Input::get('tipo');

        $traslados = new Traslado();

        if ($tipo == 'Folio') {
            $traslados = Traslado::whereFolio($q)->paginate($this->numPags);
        }
        if ($tipo == 'Enajenante') {
            $traslados = Traslado::enajenanteNombreCompleto(strtoupper($q))->paginate($this->numPags);
        }
        if ($tipo == 'Adquiriente') {
            $traslados = Traslado::adquirienteNombreCompleto(strtoupper($q))->paginate($this->numPags);
        }
        if ($tipo == 'Ubicación de la propiedad') {

            $ubicaciones = Traslado::ubicacion(strtoupper(trim($q)))->paginate($this->numPags);

            $trasladosArr = array();
            foreach ($ubicaciones as $ubicacion) {
                try {
                    $trasladosArr[] = Traslado::find($ubicacion->id);
                } catch (Exception $e) {
                }

            }
            $traslados = $trasladosArr;

            //
        }
        if ($tipo == 'Clave') {
            $traslados = Traslado::whereClave($q)->paginate($this->numPags);
        }
        if ($tipo == 'Cuenta') {
            $traslados = Traslado::whereCuenta($q)->paginate($this->numPags);
        }
        if ($tipo == 'Seguimiento') {
            $traslados = Traslado::whereSeguimiento($q)->paginate($this->numPags);
    }
        if (Request::ajax()) {
            return View:: make('ofvirtual.notario.traslado._list', compact(['traslados']));
        }

        return $traslados;

    }


}
