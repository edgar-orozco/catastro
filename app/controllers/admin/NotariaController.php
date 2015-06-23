<?php

class admin_notariaController extends \BaseController
{
    protected $Notaria;
    protected $personas;
    protected $por_pagina = 10;
    public function __construct(Notaria $Notaria, personas $personas){
        $this->Notaria = $Notaria;
        $this->personas = $personas;
    }
    
    public function index($format = 'html')
    {
        $Notaria = $this-> Notaria;
        $personas = $this-> personas;
        
        $title = "Administración de catálogo de notaria";
        
        $title_section = "Catalogo de notaria";
        
        $subtitle_section = "";
        
        // Todos los permisos creados actualmente
        $Notarias = $this->Notaria -> join('personas as p','notarias.id_notario','=','p.id_p')
                                   -> join('personas as p1','notarias.id_responsable','=','p1.id_p')
                                   -> join('municipios as m','notarias.municipio','=','m.municipio')
                                   -> select('id_notaria','notarias.entidad','m.nombre_municipio','nombre as notaria','p.nombres','p.apellido_paterno','p.apellido_materno','p1.nombres as nombre','p1.apellido_paterno as paterno','p1.apellido_materno as materno','domicilio','telefono')
                                   -> orderby('id_notaria','desc')
                                   -> paginate($this->por_pagina);
        
        return($format == 'json') ? $Notarias : View::make('admin.notaria.index',
            compact('title','title_section','subtitle_section','Notarias'));
    }
    
    public function create()
    {
        $Notaria = $this-> Notaria;
        $personas = $this-> personas;
        
        $title = "Administración de catálogo de notaria";
        
        $title_section = "Catalogo de notaria";
        
        $subtitle_section = "";
        
        $entidad = array(1 => 'Distrito Federal','Aguascalientes','Baja California','Baja California Sur','Campeche','Chiapas','Chihuahua','Coahuila de Zaragoza','Colima','Durango','Guanajuato','Guerrero','Hidalgo','Jalisco','México','Michoacán de Ocampo','Morelos','Nayarit','Nuevo León','Oaxaca','Puebla','Querétaro de Arteaga','Quintana Roo','San Luis Potosí','Sinaloa','Sonora','Tabasco','Tamaulipas','Tlaxcala','Veracruz de Ignacio de la Llave','Yucatán','Zacatecas');
        
        $entidades =[''=>'--seleccione una opcion--']+$entidad;
        
        $Municipio = ['' => '--seleccione una opción--'] + Municipio::all()->lists('nombre_municipio','municipio');
        
        return View::make('admin.notaria.create', compact('title','title_section','subtitle_section','Municipio','entidades'));
    }
    
    public function store($format = 'html') 
    {
        //obtenemos todos los datos del formulario
        $inputs = Input::All();
        //reglas
        $reglas = array(
            'entidad'=>'required',
            //'municipio'=>'required',
            'nombre'=>'required',
            'nombres'=>'required',
            'apellido_paterno'=>'required',
            'apellido_materno'=>'required',
            //'curp'=>'required',
            //'rfc'=>'required',
            'nombrer'=>'required',
            'paterno'=>'required',
            'materno'=>'required',
            //'curp1'=>'required',
            //'rfc1'=>'required',
            'domicilio'=>'required',
            'telefono'=>'required',
        );
        //Mensajes
        $mensajes = array(
            "required" => "*",
        );
        //validaciones
        $validar = Validator::make($inputs, $reglas, $mensajes);
        //en caso que no pesa la validacion se regresa a la pagina cargando los mensajes de validacion
        if ($validar->fails()) {
            return Redirect::back()->withErrors($validar);
        }else{
            //guardamos el nombre del notario
            $notario = new personas();
            $notario -> apellido_paterno = strtoupper($inputs ["apellido_paterno"]);
            $notario -> apellido_materno = strtoupper($inputs ["apellido_materno"]);
            $notario -> nombres          = strtoupper($inputs ["nombres"]);
            $notario -> rfc              = strtoupper($inputs ["rfc"]);
            $notario -> curp             = strtoupper($inputs ["curp"]);
            $notario -> id_tipo          = 1;
            $notario -> save();
            $nombre1 = $notario -> id_p;
            
            //guardamos el nombre del responsable
            $responsable = new personas();
            $responsable -> apellido_paterno = strtoupper($inputs["paterno"]);
            $responsable -> apellido_materno = strtoupper($inputs["materno"]);
            $responsable -> nombres          = strtoupper($inputs["nombrer"]);
            $responsable -> rfc              = strtoupper($inputs["rfc1"]);
            $responsable -> curp             = strtoupper($inputs["curp1"]);
            $responsable -> id_tipo          = 1;
            $responsable -> save();
            $nombre2 = $responsable -> id_p;
            //guardamos los datos de la notaria
            $n = new Notaria();
            $n -> entidad           = $inputs["entidad"];
            $n -> municipio         = $inputs["municipio"];
            $n -> nombre           = strtoupper($inputs["nombre"]);
            $n -> id_notario        = $nombre1;
            $n -> id_responsable    = $nombre2;
            $n -> domicilio         = strtoupper($inputs["domicilio"]);
            $n -> telefono          = $inputs["telefono"];
            $n -> save();
            return Redirect::to('/admin/notaria')->with('success',
            'Los datos se han creado correctamente' . "!");
        }
    }
    
    public function edit($id) 
    {
        $Notaria = Notaria::find($id);
        
        $idp = Notaria::where('id_notaria',$id)->pluck('id_notario');
        $nombre = personas::where('id_p',$idp)->pluck('nombres');
        $paterno = personas::where('id_p',$idp)->pluck('apellido_paterno');
        $materno = personas::where('id_p',$idp)->pluck('apellido_materno');
        $rfc = personas::where('id_p',$idp)->pluck('rfc');
        $curp = personas::where('id_p',$idp)->pluck('curp');
        
        $idp1 = Notaria::where('id_notaria',$id)->pluck('id_responsable');
        $nombre1 = personas::where('id_p',$idp1)->pluck('nombres');
        $paterno1 = personas::where('id_p',$idp1)->pluck('apellido_paterno');
        $materno1 = personas::where('id_p',$idp1)->pluck('apellido_materno');
        $rfc1 = personas::where('id_p',$idp1)->pluck('rfc');
        $curp1 = personas::where('id_p',$idp1)->pluck('curp');

        $this->Notaria = $Notaria;

        $title = 'Administración de catálogo de notaria';

        //Título de sección:
        $title_section = "Editar notaria: ";
        
        //Subtítulo de sección:
        $subtitle_section = "";
        //enti
        $entidad = array(1 => 'Distrito Federal','Aguascalientes','Baja California','Baja California Sur','Campeche','Chiapas','Chihuahua','Coahuila de Zaragoza','Colima','Durango','Guanajuato','Guerrero','Hidalgo','Jalisco','México','Michoacán de Ocampo','Morelos','Nayarit','Nuevo León','Oaxaca','Puebla','Querétaro de Arteaga','Quintana Roo','San Luis Potosí','Sinaloa','Sonora','Tabasco','Tamaulipas','Tlaxcala','Veracruz de Ignacio de la Llave','Yucatán','Zacatecas');
        $entidades =[''=>'--seleccione una opcion--']+$entidad;
        
        $Municipio = ['' => '--seleccione una opción--'] + Municipio::all()->lists('nombre_municipio','municipio');
        
        $id = $Notaria->id;
        return View::make('admin.notaria.edit',
            compact('title','title_section','subtitle_section','Notaria','entidades','Municipio','id','nombre','paterno','materno','rfc','curp','nombre1','paterno1','materno1','rfc1','curp1'));
    }
    
    public function update($id, $format = 'html') 
    {
        $inputs = Input::All();
        $n = Notaria::find($id);
        $n -> entidad           = $inputs["entidad"];
        $n -> municipio         = $inputs["municipio"];
        $n -> nombre            = strtoupper($inputs["nombre"]);
        $n -> domicilio         = strtoupper($inputs["domicilio"]);
        $n -> telefono          = $inputs["telefono"];
        $n -> save();
        $nombre1 = $n -> id_notario;
        $nombre2 = $n -> id_responsable;
        
        $notario = personas::find($nombre1);
        $notario -> apellido_paterno = strtoupper($inputs ["apellido_paterno"]);
        $notario -> apellido_materno = strtoupper($inputs ["apellido_materno"]);
        $notario -> nombres          = strtoupper($inputs ["nombres"]);
        $notario -> rfc              = strtoupper($inputs ["rfc"]);
        $notario -> curp             = strtoupper($inputs ["curp"]);
        $notario -> id_tipo          = 1;
        $notario -> save();
        
        $responsable = personas::find($nombre2);
        $responsable -> apellido_paterno = strtoupper($inputs["paterno"]);
        $responsable -> apellido_materno = strtoupper($inputs["materno"]);
        $responsable -> nombres          = strtoupper($inputs["nombrer"]);
        $responsable -> rfc              = strtoupper($inputs["rfc1"]);
        $responsable -> curp             = strtoupper($inputs["curp1"]);
        $responsable -> id_tipo          = 1;
        $responsable -> save();
        
        return Redirect::to('admin/notaria')->with('success',
            'Se han actualizado los datos correctamente' . "!");
    }
    
    public function destroy($id = null)
    {
        $n= Notaria::find($id);
        $n->delete();
        return Redirect::to('admin/notaria')->with('success',
            'Se han eliminado los datos correctamente ');
    }
    
}