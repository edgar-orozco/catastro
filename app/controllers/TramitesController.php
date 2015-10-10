<?php
define('_PERSONA_FISICA_', 1);
define('_PERSONA_MORAL_', 2);

use \Catastro\Repos\Padron\PadronRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\URL;
use Laravelrus\LocalizedCarbon\LocalizedCarbon;
use Webpatser\Uuid\Uuid;

class TramitesController extends BaseController {

    protected $padron;
    protected $tipotramite;
    protected $tramite;
    protected $numPags = 10;
    /**
     * @param PadronRepositoryInterface $padron
     * @param Tipotramite $tipotramite
     * @param Tramite $tramite
     */
    public function __construct(PadronRepositoryInterface $padron, Tipotramite $tipotramite, Tramite $tramite, Fiscal $fiscal)
    {
        $this->padron = $padron;
        $this->tipotramite = $tipotramite;
        $this->tramite = $tramite;
        $this->fiscal = $fiscal;
    }

    /**
     * Pantalla para subir los documentos escaneados
     */
    public function indexDocumentos(){
        $clave = Input::get('clave');
        $cuenta = Input::get('cuenta');

        $tipotramite_id = Input::get('tipotramite_id');

        $tipotramite = $this->tipotramite->findOrFail($tipotramite_id);

        $predio = $this->padron->getByClaveOCuenta($cuenta);

        $title = $tipotramite->nombre;

        $title_section = $tipotramite->nombre;

        $folio = "";

        //TODO: cálculo de tiempo consumido de trámite
        $tiempo_consumido = 0;

        //TODO: Tiempo restante de trámite
        $tiempo_restante = 0;

        //TODO: crear catalogo de estados de trámite: Iniciado, En proceso, Finalizado, Finalizado con observaciones, ¿Atrasado?
        $estado = 'Iniciado';

        $notarias = Notaria::all();
        $lista_notarias = array();
        $lista_notarias[] = '--Seleccione';
        foreach($notarias as $notaria) {
            $municipio = $notaria->mpio;
            if(!$municipio) {
                $lista_notarias[$notaria->id_notaria] = $notaria->nombre;
            }
            else{
                $lista_notarias[$notaria->id_notaria] = $notaria->nombre . " de ".$municipio->nombre_municipio;
            }
        }

        $requisitos = $tipotramite->requisitos;



        $uuid = Uuid::generate(4);

        return View::make('ventanilla.control', compact(
            'title',
            'title_section',
            'subtitle_section',
            'clave',
            'cuenta',
            'requisitos',
            'predio',
            'tipotramite',
            'tipotramite_id',
            'folio',
            'estado',
            'tiempo_consumido',
            'tiempo_restante',
            'lista_notarias',
            'uuid'
        ));

    }


    public function storeTramite() {

        //Validamos que no se esté tratando de reenviar la forma:
        $uuid = Input::get('uuid');
        $existe = Tramite::existeUuid($uuid);
        if($existe){
            return Redirect::to('tramites/proceso/'.$existe->id);
        }

        $clave = Input::get('clave');
        $cuenta = Input::get('cuenta');
        $tipotramite_id = Input::get('tipotramite_id');
        $tipo_persona = Input::get('tipo_persona');

        //Por el momento en lo que se implementa la dependencia foliable, se asocia al municipio

        $municipio = "0".substr($cuenta, 0, 2);

        $folio = FolioTramite::actual($municipio);

        $nombre = Input::get('nombres');
        $solicitante_id = intval(Input::get('solicitante_id'));
        $apepat = Input::get('apellido_paterno');
        $apemat = Input::get('apellido_materno');
        $rfc = strtoupper(Input::get('rfc'));
        $curp = strtoupper(Input::get('curp'));
        $notaria_id = Input::get('notaria_id');
        $anio = date("Y");

        //echo $nombre,$apepat,$apemat;

        $this->tramite->clave= $clave;
        $this->tramite->tipotramite_id = $tipotramite_id;
        $this->tramite->usuario_id = Auth::id();
        if($notaria_id) {
            $this->tramite->notaria_id = $notaria_id;
        }
        $this->tramite->folio = $folio;
        $this->tramite->anio = $anio;
        $this->tramite->municipio = $municipio;
        $this->tramite->uuid = $uuid;

        //Asociamos el estado iniciado
        $estatus = EstatusTramite::where('nombre','Iniciar')->first();
        $this->tramite->estatus_id = $estatus->id;

        //Si es persona física seteamos el nombre completo y los apellidos
        if($tipo_persona == 'F') {
            $this->tramite->tipo_solicitante = 'FISICA';

            $aNombrec = array();
            if($nombre) $aNombrec[] = mb_strtoupper($nombre);
            if($apepat) $aNombrec[] = mb_strtoupper($apepat);
            if($apemat) $aNombrec[] = mb_strtoupper($apemat);
            $nombrec = "";
            if(count($aNombrec)>0) {
                $nombrec = implode(" ", $aNombrec);
            }

            $solicitante = Solicitante::findPorCurpRFC($curp);
            if(!$solicitante){

                $solicitante = Solicitante::create([
                    'nombres'=>mb_strtoupper($nombre),
                    'apellido_paterno'=>mb_strtoupper($apepat),
                    'apellido_materno'=>mb_strtoupper($apemat),
                    'nombrec' => $nombrec,
                    'rfc' => mb_strtoupper($rfc),
                    'curp' => mb_strtoupper($curp),
                    'id_tipo' => _PERSONA_FISICA_,
                ]);
            }

            $this->tramite->solicitante_id = $solicitante->id;
        }
        else if($tipo_persona == 'M'){
            $solicitante = Solicitante::findPorCurpRFC($rfc);
            if(!$solicitante) {

                $solicitante = Solicitante::create([
                  'nombres' => mb_strtoupper($nombre),
                  'rfc' => mb_strtoupper($rfc),
                  'id_tipo' => _PERSONA_MORAL_,
                ]);

            }

            $this->tramite->solicitante_id = $solicitante->id;
            $this->tramite->tipo_solicitante = 'MORAL';
        }

        //La primera vez que se guarda el trámite, es el funcionario de la ventanilla quien lo guarda,
        //por lo que es el depto de recepcion y admon de trámite el rol encargado del trámite inicial
        $depto = DepartamentoTramite::where('alias','recepción')->first();
        $role_id = $depto->role_id;
        $this->tramite->role_id = $role_id;
        $this->tramite->departamento_id = $depto->id;

        $res = $this->tramite->save();
        if($res) {
            FolioTramite::incrementar($municipio);

            //Se crea la primera actividad del tramite, es decir, la acción de iniciar tramite:
            $actividad = TipoActividadTramite::where('nombre', 'Iniciar trámite')->first();
            ActividadTramite::create([
                'tramite_id' => $this->tramite->id,
                'tipo_id' => $actividad->id,
                'user_id' => Auth::id(),
            ]);
        }

        return Redirect::to('tramites/proceso/'.$this->tramite->id)->with('success', "Se ha iniciado el trámite con folio: $anio/$municipio/".sprintf("%06d",$folio));
    }


    public function documentos() {

        $tramite_id = Input::get('tramite_id');
        $tramite = Tramite::findOrFail($tramite_id);
        $clave = $tramite->clave;
        $tipotramite_id = $tramite->tipotramite_id;

        //echo $clave." ".$cuenta." ".$num_requisitos."<br>";

        $docs = Input::file('documento');

        $path_archivo = "/documentos/".$clave."/".$tramite_id;
        error_log("PAT ARCHIVO: $path_archivo");

        $path = public_path().$path_archivo;
        error_log($path);

        $archivo_original = "";
        foreach($docs as $requisito_id => $doc){

            if (!file_exists($path) && !is_dir($path)) {
                mkdir($path, 755, true);
            }

            $file = time() . "-".$doc->getClientOriginalName();
            $archivo_original = $doc->getClientOriginalName();
            $adoc = [
                'descripcion' => $doc->getClientOriginalName(),
                'path' => $path_archivo,
                'archivo'=> $file,
                'size'=>$doc->getSize(),
                'mimetype' => $doc->getMimeType(),
            ];

            try {

                error_log("FILE: $file");

                $doc->move($path , $file);
            }
            catch(Exception $e)
            {
                return "ERROR EN MOVE: ".$e->getMessage();
            }

            $documento = $tramite->documentos()->create($adoc);

            DocumentoTramite::create([
                'tramite_id' => $tramite_id,
                'tipotramite_id' => $tipotramite_id,
                'requisito_id' => $requisito_id,
                'documento_id' => $documento->id,
            ]);

            return JsonResponse::create([
                'url' => URL::to($path_archivo."/".$file),
                'archivo' => $file,
                'archivo_original' => $archivo_original,
                'requisito_id' => $requisito_id
            ]);
        }

    }


    /**
     * Va levando y actualizando el flujo del proceso
     * @param $tramite_id
     * @return \Illuminate\View\View
     */
    public function proceso($tramite_id) {

        $tramite = Tramite::findOrFail($tramite_id);

        $fiscal = $this->padron->getByClaveOCuenta($tramite->clave);
        $clave = $fiscal->clave;
        $cuenta = $fiscal->cuenta;

        $predio = $fiscal;

        //La librería default implementa localizacón para español de es, nuestro local es es_MX, por lo tanto declaramos una alias
        //Nota, la librería localizedcarbon tiene un detalle, debe pasarlse el alias del locale en minúsculas, si no no toma en cuenta el alias
        DiffFormatter::alias('es_mx', 'es');

        $tipotramite = $tramite->tipotramite;
        $tramite_id = $tramite->id;
        $solicitante = $tramite->solicitante;
        $notaria = $tramite->notaria;
        $tiempo_tramite = $tipotramite->tiempo;

        //Fecha de inicio del tramite
        $fecha_iniciado = Carbon::createFromTimeStamp($tramite->created_at->timestamp);


        $estatus = $tramite->estatus->pasado;

        //Si el estado es final, entonces ya no contamos más el tiempo
        if($estatus == 'Finalizado' || $estatus == 'Finalizado observado') {
            $fecha_finalizado = Carbon::createFromTimeStamp($tramite->updated_at->timestamp);

            $tiempo_transcurrido_dias = $fecha_iniciado->diffInDays($fecha_finalizado);
            $tiempo_transcurrido_hrs = $fecha_iniciado->diffInHours($fecha_finalizado);
            $tiempo_transcurrido = 0;
            if($tiempo_transcurrido_dias == 0 && $tiempo_transcurrido_hrs > 0)
            {
                $tiempo_transcurrido = $tiempo_transcurrido_hrs. " horas ";
            }

        }
        else {
            $tiempo_transcurrido = $fecha_iniciado->diffInDays();
        }

        $folio = $tramite->folio;
        $anio = $tramite->anio;
        $municipio = $tramite->municipio;

        $title = $tipotramite->nombre;

        $title_section = $tipotramite->nombre;

        //Departamentos donde se atiende el trámite.
        $deptos = DepartamentoTramite::all()->sortBy('orden');
        $lista_deptos = array();
        foreach($deptos as $depto) {
            $lista_deptos[$depto->id] =$depto->nombre;
        }

        //Selector de tipo de trámites para que se pueda disparar un subtramite
        $oTipotramites = Tipotramite::where('id','!=',$tramite->tipotramite_id)->orderBy('nombre')->get();
        $lista_tipotramites = array();
        foreach($oTipotramites as $tipotramite_cat){
            $lista_tipotramites[$tipotramite_cat->id] = $tipotramite_cat->nombre;
        }

        //Selector de Tipo de actividades
        $tipoactividades = TipoActividadTramite::where('manual',true)->orderBy('orden')->get();
        $lista_tipoactividades = array();
        foreach($tipoactividades as $tipoactividad) {
            $lista_tipoactividades[$tipoactividad->id] =$tipoactividad->nombre;
        }

        //Los roles que tiene el usuario actual
        $oRroles = Auth::user()->roles()->get();
        $roles = array();
        foreach($oRroles as $rol){
            $roles[] = $rol->id;
        }

        //Los municipios que está autorizado atender.
        $oMunicipios = Auth::user()->municipios()->get();
        $municipios = array();
        foreach($oMunicipios as $mpio){
            $municipios[] = $mpio->municipio;
        }

        //Indica si es responsable o no del trámite actual
        $esResponsable = Tramite::where('id', $tramite->id)->responsabilidad($roles, $municipios)->first();

        //Bandera que se usa en el timeline del tramite simplemente para la vista.
        $ff=true;

        return View::make('ventanilla.flujo', compact(
            'title',
            'title_section',
            'subtitle_section',
            'clave',
            'cuenta',
            'predio',
            'tramite',
            'tipotramite',
            'tipotramite_id',
            'folio',
            'anio',
            'municipio',
            'tiempo_transcurrido',
            'tiempo_tramite',
            'lista_notarias',
            'lista_deptos',
            'lista_tipoactividades',
            'lista_tipotramites',
            'uuid',
            'ff',
            'esResponsable'
        ));
    }
  
     /**
     * Guardamos la actividad
     * @param $tramite_id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeActividad($tramite_id){

        $tramite = Tramite::findOrFail($tramite_id);

        $folio = $tramite->folio;
        $anio = $tramite->anio;
        $municipio = $tramite->municipio;

        $tipo_id = Input::get('tipo_id');
        $departamento_id = Input::get('departamento_id');

        //Se usa cuando existe un nuevo subtrámite que realizar
        $tipotramite_id = Input::get('tipotramite_id');
        $observaciones = Input::get('observaciones');

        $uid = Auth::id();

        $actividad = [];
        if($tipo_id) $actividad['tipo_id'] = $tipo_id;
        if($departamento_id) $actividad['departamento_id'] = $departamento_id;
        if(trim($observaciones)) $actividad['observaciones'] = $observaciones;

        //Si no hay ni actividad ni departamento es que nomás le dieron submit a lo buey
        if(!$departamento_id && !$tipo_id){
            Session::flash('error', "Seleccione una actividad y/o un departamento a turnar");
            return Redirect::back();
            //return Redirect::to('/')->with('success',"Se ha guardado trámite con folio: $anio/$municipio/".sprintf("%06d",$folio));
        }

        $actividad['tramite_id'] = $tramite_id;

        //vemos si el tipo de tramite corresponde a algun finalizado, si es el caso entonces ponemos el estatus de tramite en finalizado.
        //De lo contrario ponemos el estatus del tramite a En Proceso
        $esSubtramite = false; //Bandera que nos indica si se trata de un subtramite o no.
        if($tipo_id){
            $tipo = TipoActividadTramite::find($tipo_id);
            $tramite->estatus_id = $tipo->estatus_id;

            //Si se inicia subtramite generamos un nuevo trámite pero con el mismo número de folio.
            //TODO: Hacer refactoring, esto con eventos
            if(mb_strtolower($tipo->nombre) == 'iniciar subtrámite'){

                $esSubtramite = true;

                //Sólo si existe un nuevo tipo de trámite creamos uno, si no lo hay no se crea nada
                if($tipotramite_id){


                    //Si existe el departamento vemos el rol de usuario que corresponde a dicho depto
                    //$role_id = null;
                    //$departamento_id = null;
                    if($departamento_id){
                        $depto = DepartamentoTramite::findOrFail($departamento_id);
                        $role_id = $depto->role_id;
                        //$departamento_id = $depto->id;
                    }

                    //Asociamos el estado iniciado
                    $estatus = EstatusTramite::where('nombre','Iniciar')->first();

                    $subtramite = Tramite::create([
                        'padre_id' => $tramite->id,
                        'tipotramite_id' => $tipotramite_id,
                        'clave' => $tramite->clave,
                        'usuario_id' => $uid,
                        'folio' => $tramite->folio,
                        'notaria_id' => $tramite->notaria_id,
                        'solicitante_id' => $tramite->solicitante_id,
                        'tipo_solicitante' => $tramite->tipo_solicitante,
                        'uuid' => Uuid::generate(4),
                        'role_id' => $role_id,
                        'departamento_id' => $departamento_id,
                        'estatus_id' => $estatus->id
                    ]);

                    //Se inicializa esta actividad con su actividad inicial
                    $actividadsub = TipoActividadTramite::where('nombre', 'Iniciar trámite')->first();
                    ActividadTramite::create([
                        'tramite_id' => $subtramite->id,
                        'tipo_id' => $actividadsub->id,
                        'user_id' => $uid,
                    ]);

                }
            }
        }


        //Si existe el departamento y no se ha generado un subtramite vemos el rol de usuario que corresponde a dicho depto
        if($departamento_id && !$esSubtramite){
            $depto = DepartamentoTramite::findOrFail($departamento_id);
            $tramite->role_id = $depto->role_id;
            $tramite->departamento_id = $depto->id;
        }

        //Si se trata de un subtramite dejamos el rol y el depto como estaban antes de crear el subtrámite.

        $tramite->save();

        $actividad['user_id'] = $uid;

        ActividadTramite::create($actividad);

        return Redirect::to('/')->with('success',"Se ha guardado trámite con folio: $anio/$municipio/".sprintf("%06d",$folio));
    }

    /**
     * Implementa la búsqueda y regresa la vista parcial de la tabla de tramites.
     * @return \Illuminate\View\View|null
     */
    public function buscar(){

        $q = Input::get('q');
        $tipo = Input::get('tipo');
        $tramites = null;

        $municipios = array();
        $roles = array();
        $uid = Auth::id();

        $user = Auth::user();
        if($user) {
            $municipios = $user->municipioIdArray();
            $roles = $user->roleIdArray();
        }


        if(trim($q) == '')
        {
            $tramites = [];

        }
        if($tipo == 'folio')
        {
            $q = intval($q);
            $tramites = Tramite::where('folio', $q)->involucrado($uid, $roles, $municipios)->paginate($this->numPags);
        }
        if($tipo == 'solicitante')
        {
            $tramites = Tramite::involucrado($uid, $roles, $municipios)->solicitanteNombreCompleto($q)->paginate($this->numPags);
        }
        if($tipo == 'notaría')
        {
            $tramites = Tramite::involucrado($uid, $roles, $municipios)->notariaNombre($q)->paginate($this->numPags);
        }
        if($tipo == 'tipo de trámite')
        {
            $tramites = Tramite::involucrado($uid, $roles, $municipios)->tipoTramiteNombre($q)->paginate($this->numPags);
        }
        if($tipo == 'fecha')
        {
            $tramites = Tramite::involucrado($uid, $roles, $municipios)->fecha($q)->paginate($this->numPags);
        }
        if($tipo == 'departamento')
        {
            $tramites = Tramite::involucrado($uid, $roles, $municipios)->departamento($q)->paginate($this->numPags);
        }
        if($tipo == 'estatus')
        {
            $tramites = Tramite::involucrado($uid, $roles, $municipios)->estatus($q)->paginate($this->numPags);
        }


        if (Request::ajax())
        {
            return View::make('ventanilla._lista_tramites',compact(['tramites']));
        }

        return $tramites;
    }


    /**
     * Regresa la vista de la lista de tramites por atender
     */
    public function listaPorAtender(){


        $tramites = Tramite::porAtender(Auth::user()->roleIdArray())->orderBy('created_at')->paginate($this->numPags);

        if (Request::ajax())
        {
            return View::make('ventanilla._lista_tramites',compact(['tramites']));
        }

        return $tramites;
    }


    /**
     * Deveuelve la tabla html con los documentos de requisitos que haya para un tramite y requisito dado
     * @param $tramite_id
     * @param $requisito_id
     * @return \Illuminate\View\View
     */
    public function listaDocumentosTramite($tramite_id, $requisito_id) {

        $documentos = Tramite::find($tramite_id)->documentosTramite()->where('requisito_id', $requisito_id)->whereNull('deleted_at')->get();
        $requisito = Requisito::find($requisito_id);
        if (Request::ajax())
        {
            return View::make('ventanilla._documentos_tramite',compact(['documentos','requisito']));
        }

        return $documentos;
    }


    public function documentosEliminar() {

        $documento_id = Input::get('documento_id');
        $doc = DocumentoTramite::find($documento_id);
        $requisito_id = $doc->requisito_id;
        $doc->delete();

        return JsonResponse::create([
            'requisito_id' => $requisito_id
        ]);


    }
    
    public function get_pdf($id, $format = 'html'){
      
        //trae todos los datos del tramite para el recibo
        $tramites = $this-> tramite ->join('solicitante as p', 'solicitante_id','=','p.id')
                                    ->join('propietarios as pro','tramites.clave','=','pro.clave')
                                    ->join('personas as p1','pro.id_propietario','=','p1.id_p')
                                    ->join('fiscal as f','tramites.clave','=','f.clave')
                                    ->join('tipotramites as ti','tipotramite_id','=','ti.id')
                                    ->where('tramites.id', '=', $id)
                                    ->select('tramites.created_at','tramites.anio','tramites.municipio','folio','solicitante_id','p.nombres','p.apellido_paterno','p.apellido_materno','pro.clave','p1.nombres as nombre','p1.apellido_paterno as paterno','p1.apellido_materno as materno','f.cuenta','ti.nombre as tramite','ti.tiempo')
                                    ->get();
        //trae el nombre de la notaria
        $notaria = $this-> tramite ->join('notarias as n','notaria_id','=','n.id_notaria')->where('tramites.id', '=', $id)->select('n.nombre as notaria')->get();
        //traigo la clave del tramite
        $clave = $this-> tramite -> where('id','=',$id)->select('clave')->get();
        //Hacemos el explode para obtener el municipio
        $municipio = explode('-', $clave);
        //traemos el municipio con el explode en un array
        $municipio=$municipio[1];
        //traigo el id del municipio
        $gid = Municipio::where('municipio','=',$municipio)->pluck('gid');
        //trtaigo el nombre de la imgaen del municipio
        $logo = configuracionMunicipal::where('municipio','=', $gid)->pluck('file');
        //debuelvo los datos en PDF
        $vista = View::make('ventanilla.recibo', compact('tramites','logo','notaria'));
        $pdf = PDF::load($vista)->show("ReciboVentanilla");
        $response = Response::make($pdf, 200);
        $response->header('Content-Type', 'application/pdf');
//        return $vista;
    }
    
    public function valorCatastral() {
        //estraigo la clave de la tabla tramites
        $clave = $this-> tramite -> where('id', '=', '2') -> pluck('clave');
        //Hacemos el explode para obtener el municipio
        $claveC = explode('-', $clave);
        //traemos la clave catastral por partes
        $municipio=$claveC [1];
        $zona=$claveC[2];
        $manzana=$claveC[3];
        $predio=$claveC[4];
        //traigo el id del municipio
        $gid = Municipio::where('municipio','=',$municipio)->pluck('gid');
        $nmunicipio = Municipio::where('municipio','=',$municipio)->pluck('nombre_municipio');
        //trtaigo el nombre de la imgaen del municipio
        $logo = configuracionMunicipal::where('municipio','=', $gid)->pluck('file');
        $autorizo = configuracionMunicipal::where('municipio','=', $gid)->pluck('nombre');
        //traigo el nombre del solicitante solicitante
        $solicitante = $this->tramite -> join('solicitante as p', 'solicitante_id','=','p.id') -> where('id', '=', '2') -> select('p.nombres as nombre','p.apellido_paterno as paterno','p.apellido_materno as materno') -> get();
        //traigo los datos del predio con la clave de la tabla fiscal
        $datos = $this-> fiscal -> join ('personas as p', 'id_propietarios','=','p.id_p') -> join ('ubicacion_fiscal as u', 'id_ubicacion_fiscal','=','id_ubicacion') -> where ('clave', '=', $clave) -> select ('clave', 'cuenta', 'tipo_predio', 'superficie_terreno', 'superficie_construccion', 'valor_catastral','p.nombres','p.apellido_paterno','p.apellido_materno','u.ubicacion') -> get();
        //Mandamos las bariables para imprimir y conbertimos en pdf el archivo
        $vista = View::make('ventanilla.valorCatastral', compact('datos','solicitante','logo','nmunicipio','zona','manzana','predio','autorizo'));
        $pdf = PDF::load($vista)->show('Valor Catastral'.' '.$clave);
        $response = Response::make($pdf, 200);
        $response->header('Content-Type', 'application/pdf');
//        return $vista;
    }


    public function solicitante(){
        $q = Input::get('term');
        if (Request::ajax())
        {
            return Solicitante::getPorCurpRFC($q);
        }

    }
}



