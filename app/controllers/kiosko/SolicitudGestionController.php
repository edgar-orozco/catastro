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
    
    public function store($format='html') 
    {
       $inputs = Input::All();
       //reglas
       $reglas = array(
           'nombres'=>'required',
           'apellido_paterno'=>'required',
           'apellido_materno'=>'required',
           'curp'=>'required',
           'rfc'=>'required',
           'direccion'=>'required',
           'telefono'=>'required',
           'tipo_telefono'=>'required',
           'correo'=>'required',
           'tramite_id'=>'required',
           'municipio'=>'required',
           'clave'=>'required',
       );
       $clave = Input::get('clave');
       
       $res = $this->padron->getByClaveOCuenta($clave);
       //mensaje
       $mensajes = array("required"=>"*");
       //valida
       $validar = Validator::make($inputs, $reglas, $mensajes);
       //en caso que no pesa la validacion
       if ($validar->fails()) {
            return Redirect::back()->withErrors($validar);
        } else {
           
            if(!$res)
            {
                return Redirect::to('kiosko/solicitud')->with('error','La Clave o Cuenta Ctastral No Exite');
            }else {
                //guardamos el nombre del solicitante
                $solicitante = new Solicitante();
                $solicitante -> apellido_paterno = strtoupper($inputs ["apellido_paterno"]);
                $solicitante -> apellido_materno = strtoupper($inputs ["apellido_materno"]);
                $solicitante -> nombres = strtoupper($inputs ["nombres"]);
                $solicitante -> nombrec = strtoupper($inputs["nombres"]." ".$inputs["apellido_paterno"]." ".$inputs ["apellido_materno"]);
                $solicitante -> rfc = strtoupper($inputs ["rfc"]);
                $solicitante -> curp = strtoupper($inputs ["curp"]);
                $solicitante -> direccion = $inputs["direccion"];
                $solicitante -> telefono = $inputs["telefono"];
                $solicitante -> tipo_telefono = $inputs["tipo_telefono"];
                $solicitante -> correo = $inputs["correo"];
                $solicitante -> fecha_ingr = date('Y-m-d');
                $solicitante -> id_tipo = 1;
                $solicitante -> save();
                $nombre = $solicitante -> id;
                //guardamos la solicitud
                $solicitud = new SolicitudGestion();
                $solicitud -> solicitante_id = $nombre;
                $solicitud -> tramite_id = $inputs["tramite_id"];
                $solicitud -> municipio = $inputs["municipio"];
                $solicitud -> clave = $inputs["clave"];
                $solicitud -> create_at = date('Y-m-d');
                $solicitud -> save();
                $id=$solicitud -> id; 
                return Redirect::to('kiosko/solicitud_pdf/'.$id);
            }
        }  
    }
    
    public function edit($id) 
    {
        $solicitudGestion = SolicitudGestion::find($id);
        $idp = SolicitudGestion::where('id',$id)->pluck('solicitante_id');
        $solicitante = Solicitante::find($idp);
        
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
         $inputs = Input::All();
         
        $seguimiento = SolicitudGestion::where('id',$id)->pluck('seguimiento');
        
        $clave = Input::get('clave');
        
        $res = $this->padron->getByClaveOCuenta($clave); 
        
        if($res)
        {
            if(!$seguimiento)
            {
                $inputs = Input::All();
                $n = SolicitudGestion::find($id);
                $n -> tramite_id  = $inputs["tramite_id"];
                $n -> municipio = $inputs["municipio"];
                $n -> clave = $inputs["clave"];
                $n -> updated_at = date('Y-m-d'); 
                $n -> save();
                $nombre = $n -> id;

                $solicitante = Solicitante::find($nombre);
                $solicitante -> apellido_paterno = strtoupper($inputs ["apellido_paterno"]);
                $solicitante -> apellido_materno = strtoupper($inputs ["apellido_materno"]);
                $solicitante -> nombres = strtoupper($inputs ["nombres"]);
                $solicitante -> nombrec = strtoupper($inputs["nombres"]." ".$inputs["apellido_paterno"]." ".$inputs ["apellido_materno"]);
                $solicitante -> rfc = strtoupper($inputs ["rfc"]);
                $solicitante -> curp = strtoupper($inputs ["curp"]);
                $solicitante -> direccion = $inputs["direccion"];
                $solicitante -> telefono = $inputs["telefono"];
                $solicitante -> tipo_telefono = $inputs["tipo_telefono"];
                $solicitante -> correo = $inputs["correo"];
                $solicitante -> save();

                return Redirect::to('kiosko/solicitud_pdf/'.$id);
             }
             return Redirect::to('/kiosko/solicitud')->with('error',
            'La solicitud ya fue tomada' . "!");   
        }
        return Redirect::to('/kiosko/solicitud')->with('error',
        'La Clave o Cuenta Ctastral No Exite' . "!");
            
    }


    public function solicitudIndex($id) 
    {
        $tipo = $this-> SolicitudGestion -> where('id','=',$id)->pluck('clave');
        $res = $this->padron->getByClaveOCuenta($tipo)->pluck('clave');
        //dd($res, $tipo);
        
       if($tipo == $res){
            $tramite = $this->SolicitudGestion->join('solicitante as s', 'solicitud_gestion.id', '=', 's.id')
                    ->join('fiscal as f', 'solicitud_gestion.clave', '=', 'f.clave')
                    ->join('ubicacion_fiscal as u', 'f.id_ubicacion_fiscal', '=', 'u.id_ubicacion')
                    ->join('tipotramites as t', 'tramite_id', '=', 't.id')
                    ->join('municipios as m', 'solicitud_gestion.municipio', '=', 'm.gid')
                    ->where('solicitud_gestion.id', '=', $id)
                    ->select('solicitud_gestion.id','create_at', 's.nombrec', 's.curp', 's.rfc','s.telefono','s.correo','s.direccion','f.clave', 'f.tipo_predio', 'u.ubicacion', 't.nombre as tramite', 'm.nombre_municipio')
                    ->get();

            $datos = $this->SolicitudGestion->join('fiscal as f', 'solicitud_gestion.clave', '=', 'f.clave')
                    ->where('id', '=', $id)
                    ->select('f.clave')
                    ->get();
        }  else {
            
            $tramite = $this->SolicitudGestion->join('solicitante as s', 'solicitud_gestion.id', '=', 's.id')
                    ->join('fiscal as f', 'solicitud_gestion.clave', '=', 'f.cuenta')
                    ->join('ubicacion_fiscal as u', 'f.id_ubicacion_fiscal', '=', 'u.id_ubicacion')
                    ->join('tipotramites as t', 'tramite_id', '=', 't.id')
                    ->join('municipios as m', 'solicitud_gestion.municipio', '=', 'm.gid')                    
                    ->where('solicitud_gestion.id', '=', $id)
                    ->select('solicitud_gestion.id','create_at', 's.nombrec', 's.curp', 's.rfc','s.telefono','s.correo','s.direccion', 'f.cuenta', 'f.tipo_predio', 'u.ubicacion', 't.nombre as tramite', 'm.nombre_municipio')
                    ->get();

            $datos = $this->SolicitudGestion->join('fiscal as f', 'solicitud_gestion.clave', '=', 'f.cuenta')
                    ->where('id', '=', $id)
                    ->select('f.clave')
                    ->get();
        }
 
        $clave = explode('-', $datos);
        $zona = $clave[2];
        $manzana = $clave[3];
                                          
        $vista = View::make('kiosko.solicitud.solicitud',compact('tramite','zona','manzana'));
        $pdf = PDF::load($vista)->show('Solicitud '.$tipo);
        $response = Response::make($pdf, 200);
        $response->header('Content-Type', 'application/pdf');
        return $vista;
    }
    
    
}