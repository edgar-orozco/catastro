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
        
        return View::make('kiosko.solicitud.index',compact('solicitudGestion','title','title_section','Tipotramite','Municipio','municipios'));
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
           'id_tramite'=>'required',
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
                //return Redirect::to('kiosko/solicitud')->with('error','la clave no exite');
//                $results='no existe';
//                return Response::json(array('mensaje'=>$results));
                //return Redirect::to('kiosko/solicitud_pdf',compact('id'));
            }else {
                //guardamos el nombre del solicitante
                $solicitante = new Solicitante();
                $solicitante -> apellido_paterno = strtoupper($inputs ["apellido_paterno"]);
                $solicitante -> apellido_materno = strtoupper($inputs ["apellido_materno"]);
                $solicitante -> nombres = strtoupper($inputs ["nombres"]);
                $solicitante -> nombrec = strtoupper($inputs["nombres"]." ".$inputs["apellido_paterno"]." ".$inputs ["apellido_materno"]);
                $solicitante -> rfc = strtoupper($inputs ["rfc"]);
                $solicitante -> curp = strtoupper($inputs ["curp"]);
                $solicitante -> fecha_ingr = date('Y-m-d');
                $solicitante -> id_tipo = 1;
                $solicitante -> save();
                $nombre = $solicitante -> id_solicitante;
                //guardamos la solicitud
                $solicitud = new SolicitudGestion();
                $solicitud -> id_solicitante = $nombre;
                $solicitud -> id_tramite = $inputs["id_tramite"];
                $solicitud -> municipio = $inputs["municipio"];
                $solicitud -> clave = $inputs["clave"];
                $solicitud -> create_at = date('Y-m-d');
                $solicitud -> save();
                $id=$solicitud -> id_solicitud; 
                return Redirect::to('kiosko/solicitud_pdf/'.$id);
            }
        }  
    }
    
    public function edit($id) 
    {
        $solicitudGestion = SolicitudGestion::find($id);
        
        $idp = SolicitudGestion::where('id_solicitud',$id)->pluck('id_solicitante');
        $nombres = Solicitante::where('id_solicitante',$idp)->pluck('nombres');
        $paterno = Solicitante::where('id_solicitante',$idp)->pluck('apellido_paterno');
        $materno = Solicitante::where('id_solicitante',$idp)->pluck('apellido_materno');
        $curp = Solicitante::where('id_solicitante',$idp)->pluck('curp');
        $rfc = Solicitante::where('id_solicitante',$idp)->pluck('rfc');
        
        $title = 'Administración de solicitud';
        
        $title_section = "Editar solicitud: ";
        
        $subtitle_section = $this->SolicitudGestion->clave;
        
        $Tipotramite = ['' => '--seleccione una opción--'] + Tipotramite::all()->lists('nombre','id');
        
        $Municipio = ['' => '--seleccione una opción--'] + Municipio::all()->lists('nombre_municipio','gid');
        
        
       
        return View::make('kiosko.solicitud.edit',
                compact('solicitudGestion','title','title_section','subtitle_section','Tipotramite','Municipio','nombres','paterno','materno','curp','rfc'));
    }
    
    public function update($id, $format = 'html')        
    {
        $seguimiento = SolicitudGestion::where('id_solicitud',$id)->pluck('seguimiento');
        if(!$seguimiento)
        {
            $inputs = Input::All();
            $n = SolicitudGestion::find($id);
            $n -> id_tramite  = $inputs["id_tramite"];
            $n -> municipio = $inputs["municipio"];
            $n -> clave = $inputs["clave"];
            $n -> updated_at = date('Y-m-d'); 
            $n -> save();
            $nombre = $n -> id_solicitante;
            
            $solicitante = Solicitante::find($nombre);
            $solicitante -> apellido_paterno = strtoupper($inputs ["apellido_paterno"]);
            $solicitante -> apellido_materno = strtoupper($inputs ["apellido_materno"]);
            $solicitante -> nombres = strtoupper($inputs ["nombres"]);
            $solicitante -> nombrec = strtoupper($inputs["nombres"]." ".$inputs["apellido_paterno"]." ".$inputs ["apellido_materno"]);
            $solicitante -> rfc = strtoupper($inputs ["rfc"]);
            $solicitante -> curp = strtoupper($inputs ["curp"]);
            $solicitante -> save();
            
            return Redirect::to('kiosko/solicitud_pdf/'.$id);
        }
            return Redirect::to('/kiosko/solicitud/edit/'.$id)->with('error',
            'La solicitud ya fue tomada' . "!");
    }


    public function solicitudIndex($id) 
    {
        $tipo = $this-> SolicitudGestion -> where('id_solicitud','=',$id)->pluck('clave');
        $res = $this->padron->getByClaveOCuenta($tipo)->pluck('clave');
        //dd($res, $tipo);
        
       if($tipo == $res){
            $tramite = $this->SolicitudGestion->join('solicitante as s', 'solicitud_gestion.id_solicitante', '=', 's.id_solicitante')
                    ->join('fiscal as f', 'solicitud_gestion.clave', '=', 'f.clave')
                    ->join('ubicacion_fiscal as u', 'f.id_ubicacion_fiscal', '=', 'u.id_ubicacion')
                    ->join('tipotramites as t', 'id_tramite', '=', 't.id')
                    ->join('municipios as m', 'solicitud_gestion.municipio', '=', 'm.gid')
                    ->where('id_solicitud', '=', $id)
                    ->select('id_solicitud','create_at', 's.nombrec', 's.curp', 's.rfc', 'f.clave', 'f.tipo_predio', 'u.ubicacion', 't.nombre as tramite', 'm.nombre_municipio')
                    ->get();

            $datos = $this->SolicitudGestion->join('fiscal as f', 'solicitud_gestion.clave', '=', 'f.clave')
                    ->where('id_solicitud', '=', $id)
                    ->select('f.clave')
                    ->get();
        }  else {
            
            $tramite = $this->SolicitudGestion->join('solicitante as s', 'solicitud_gestion.id_solicitante', '=', 's.id_solicitante')
                    ->join('fiscal as f', 'solicitud_gestion.clave', '=', 'f.cuenta')
                    ->join('ubicacion_fiscal as u', 'f.id_ubicacion_fiscal', '=', 'u.id_ubicacion')
                    ->join('tipotramites as t', 'id_tramite', '=', 't.id')
                    ->join('municipios as m', 'solicitud_gestion.municipio', '=', 'm.gid')                    
                    ->where('id_solicitud', '=', $id)
                    ->select('id_solicitud','create_at', 's.nombrec', 's.curp', 's.rfc', 'f.cuenta', 'f.tipo_predio', 'u.ubicacion', 't.nombre as tramite', 'm.nombre_municipio')
                    ->get();

            $datos = $this->SolicitudGestion->join('fiscal as f', 'solicitud_gestion.clave', '=', 'f.cuenta')
                    ->where('id_solicitud', '=', $id)
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