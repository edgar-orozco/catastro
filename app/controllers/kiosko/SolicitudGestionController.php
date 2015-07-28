<?php
use \Catastro\Repos\Padron\PadronRepositoryInterface;
class kiosko_SolicitudGestionController extends \BaseController
{
    protected $padron;
    protected $RequisitoTipotramite;
    protected $tipotramite;
    protected $solicitudGestion;
    protected $solicitante;
    
    public function __construct(PadronRepositoryInterface $padron, Tipotramite $tipotramite, SolicitudGestion $solicitudGestion, Solicitante $solicitante)
    {
        $this->padron = $padron; 
        $this->tipotramite = $tipotramite;
        $this->SolicitudGestion = $solicitudGestion;
        $this->Solicitante = $solicitante;
    }
    
    public function index($format = 'html') 
    {
        $solicitudGestion = $this->SolicitudGestion;
        
        $title = 'Kiosko de primera atención';
        
        $title_section = 'Crear solicitud';
        
        $Tipotramite = ['' => '--seleccione una opción--'] + Tipotramite::all()->lists('nombre','id');
        
        $Municipio = ['' => '--seleccione una opción--'] + Municipio::all()->lists('nombre_municipio','gid');
        
        $telefono = array(0=>'Movil','Fijo');
        
        $tipo_telefono = [''=>'--Seleccione una opcion--']+$telefono;
        
        return View::make('kiosko.solicitud.index',compact('solicitudGestion','title','title_section','Tipotramite','Municipio','municipios','tipo_telefono'));
    }
    
    public function store($format = 'html') {
        //traemos todos los inputs
        $inputs = Input::All();
        //traemos la clave o cuenta de los inputs
        $clave = Input::get('clave');
        //traemos el id del solicitante_id de los inputs
        $solicitante_id = Input::get('solicitante_id');
        //Corrobaramos si existe la clave o cuenta
        $res = $this->padron->getByClaveOCuenta($clave);
        //si res no trae datsos
        if (!$res) {
            return Redirect::with('error', 'La Clave o Cuenta Ctastral No Exite');
        }
        //Si res trae datos    
        else {
            //Si solicitante_id no trae datos guardara la persona nueva
            if (!$solicitante_id) {
                //traemos el codigo del seguimiento
                $seguimiento = SolicitudGestion::cadenaSeguimientoUnica();
                //generamos el codigo de barra
                $path_imagen = DNS1D::getBarcodePNGPath($seguimiento, "C128");
                //guardamos el nombre del solicitante
                $solicitante = new Solicitante();
                $solicitante->apellido_paterno = mb_strtoupper($inputs["solicitante"]["apellido_paterno"]);
                $solicitante->apellido_materno = mb_strtoupper($inputs["solicitante"]["apellido_materno"]);
                $solicitante->nombres = mb_strtoupper($inputs["solicitante"]["nombres"]);
                $solicitante->nombrec = mb_strtoupper($inputs["solicitante"]["nombres"] . " " . $inputs["solicitante"]["apellido_paterno"] . " " . $inputs["solicitante"]["apellido_materno"]);
                $solicitante->rfc = mb_strtoupper($inputs["solicitante"]["rfc"]);
                $solicitante->curp = mb_strtoupper($inputs["solicitante"]["curp"]);
                $solicitante->direccion = $inputs["solicitante"]["direccion"];
                $solicitante->telefono = $inputs["solicitante"]["telefono"];
                $solicitante->tipo_telefono = $inputs["solicitante"]["tipo_telefono"];
                $solicitante->correo = $inputs["solicitante"]["correo"];
                $solicitante->fecha_ingr = date('Y-m-d');
                $solicitante->id_tipo = 1;
                $solicitante->save();
                $nombre = $solicitante->id;
                //guardamos la solicitud
                $solicitud = new SolicitudGestion();
                $solicitud->solicitante_id = $nombre;
                $solicitud->tramite_id = $inputs["tramite_id"];
                $solicitud->municipio = $inputs["municipio"];
                $solicitud->clave = $inputs["clave"];
                $solicitud->seguimiento = $seguimiento;
                $solicitud->create_at = date('Y-m-d');
                $solicitud->save();
                $id = $solicitud->id;
                return $id;
            } 
            //Si solicitante_id trae datos guarda el solicitante_id
            else {
                //traemos el codigo del seguimiento
                $seguimiento = SolicitudGestion::cadenaSeguimientoUnica();
                //generamos el codigo de barra
                $path_imagen = DNS1D::getBarcodePNGPath($seguimiento, "C128");
                //guardamos la solicitud
                $solicitud = new SolicitudGestion();
                $solicitud->solicitante_id = $solicitante_id;
                $solicitud->tramite_id = $inputs["tramite_id"];
                $solicitud->municipio = $inputs["municipio"];
                $solicitud->clave = $inputs["clave"];
                $solicitud->seguimiento = $seguimiento;
                $solicitud->create_at = date('Y-m-d');
                $solicitud->save();
                $id = $solicitud->id;
                return $id;
            }
        }
    }

    public function edit($id) 
    {
        $solicitudGestion = SolicitudGestion::where('seguimiento','=',$id)->first();
        
        $solicitante = $solicitudGestion->solicitante;
        
        $title = 'Administración de solicitud';
        
        $title_section = "Editar solicitud: ";
        
        $subtitle_section = $this->SolicitudGestion->clave;
        
        $Tipotramite = ['' => '--seleccione una opción--'] + Tipotramite::all()->lists('nombre','id');
        
        $Municipio = ['' => '--seleccione una opción--'] + Municipio::all()->lists('nombre_municipio','gid');
        
        $telefono = array(0=>'Movil','Fijo');
        
        $tipo_telefono = [''=>'--Seleccione una opcion--']+$telefono;
        
        return View::make('kiosko.solicitud.edit',
                compact('solicitudGestion','solicitante','title','title_section','subtitle_section','Tipotramite','Municipio','tipo_telefono'));
    }
    
    public function update($id, $format = 'html')        
    {
        //traemos todos los inputs
        $inputs = Input::All();
        //traemos el input clave.
        $clave = Input::get('clave');
        //checamos si existe la clave o cuenta
        $res = $this->padron->getByClaveOCuenta($clave); 
        //si existe la clabe o cuenta hacemos los cambios
        if($res)
        {
            //Editamos los datos de la solictud_gestion
            $n = SolicitudGestion::find($id);
            $n -> tramite_id  = $inputs["tramite_id"];
            $n -> municipio = $inputs["municipio"];
            $n -> clave = $inputs["clave"];
            $n -> updated_at = date('Y-m-d'); 
            $n -> save();
            //traemos el id del solicitante
            $nombre = $n -> solicitante_id;
            //Editamos los datos del solicitante
            $solicitante = Solicitante::find($nombre);
            $solicitante -> apellido_paterno = mb_strtoupper($inputs["solicitante"]["apellido_paterno"]);
            $solicitante -> apellido_materno = mb_strtoupper($inputs["solicitante"]["apellido_materno"]);
            $solicitante -> nombres = mb_strtoupper($inputs["solicitante"]["nombres"]);
            $solicitante -> nombrec = mb_strtoupper($inputs["solicitante"]["nombres"]." ".$inputs["solicitante"]["apellido_paterno"]." ".$inputs["solicitante"]["apellido_materno"]);
            $solicitante -> rfc = mb_strtoupper($inputs["solicitante"]["rfc"]);
            $solicitante -> curp = mb_strtoupper($inputs["solicitante"]["curp"]);
            $solicitante -> direccion = $inputs["solicitante"]["direccion"];
            $solicitante -> telefono = $inputs["solicitante"]["telefono"];
            $solicitante -> tipo_telefono = $inputs["solicitante"]["tipo_telefono"];
            $solicitante -> correo = $inputs["solicitante"]["correo"];
            $solicitante -> save();
            //redireccionamos al pdf de solicitud
            return $id;
        }
        //encaso que no exista la clave o cuenta
        return Redirect::with('error','La Clave o Cuenta Ctastral No Exite' . "!");
    }
    public function solicitudIndex($id) 
    {
        //Traigo la clave o cuenta de la tabla
        $tipo = $this-> SolicitudGestion -> find($id)->clave;
        //Comparo si es clavo o cuenta y traigo la clave 
        $res = $this->padron->getByClaveOCuenta($tipo)->clave;
        //traigo los datos de la solicitud
        $solicitud = $this-> SolicitudGestion -> find($id);
        //trigo los datps de fiscal
        $fiscal = PadronFiscal::where ('clave', $res)->first();
        //explode para traer la zona y la manzana de la clave catastral
        $clave = explode('-', $res);
        $zona = $clave[2];
        $manzana = $clave[3];
                                          
        $vista = View::make('kiosko.solicitud.solicitud',compact('solicitud','fiscal','zona','manzana'));
        $pdf = PDF::load($vista)->show('Solicitud '.$tipo);
        $response = Response::make($pdf, 200);
        $response->header('Content-Type', 'application/pdf');
        return $response;
    }
    
    public function autocomplete() {

        $term = Str::upper(Input::get('term'));
        //ARRAY DONDE CARGA LOS DATOS
        $results = array();

        $id_p = array();
        //CONSULTA A LA TABLA PERSONAS
        $queries = DB::select(DB::raw("SELECT * FROM solicitante WHERE curp LIKE '%" . $term . "%' limit 5"));
        //DONDE LLAMA LOS DATOS Y LOS PASA A LAS VARIABLES CORRESPONDIENTES
        foreach ($queries as $query) {
            //ARRAY DONDE CARGA LOS DATOS
            $id_p[] = ['id' => $query->id];
            $results[] = ['value' => $query->curp , 'id' => $query->id, 'nombres' => $query->nombres, 'apellido_paterno' => $query->apellido_paterno, 'apellido_materno'=>$query->apellido_materno,'rfc'=>$query->rfc,'tipo_telefono'=>$query->tipo_telefono,'telefono'=>$query->telefono,'correo'=>$query->correo,'direccion'=>$query->direccion];
        }
        if ($results) {
            //SI EXITE LA PERSONA            
            return Response::json($results);
        } else {
            //SI NO EXITE LA PAERSONA
            $mensaje[] = "NO EXISTE LA PERSONAS";
            return Response::json($mensaje);
        }
    }
    
}