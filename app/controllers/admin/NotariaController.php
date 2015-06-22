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
        
        $Notarias = $this->Notaria -> join('personas as p','notarias.id_notario','=','p.id_p')
                                   -> join('personas as p1','notarias.id_responsable','=','p1.id_p')
                                   -> join('municipios as m','notarias.municipio','=','m.municipio')
                                   -> select('id_notaria','notarias.entidad','m.nombre_municipio','nombre as notaria','p.nombres','p.apellido_paterno','p.apellido_materno','p1.nombres as nombre','p1.apellido_paterno as paterno','p1.apellido_materno as materno','domicilio','telefono')
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
        
        $Notarias = $this->Notaria -> join('personas as p','notarias.id_notario','=','p.id_p')
                                   -> join('personas as p1','notarias.id_responsable','=','p1.id_p')
                                   -> join('municipios as m','notarias.municipio','=','m.municipio')
                                   -> select('id_notaria','notarias.entidad','m.nombre_municipio','nombre as notaria','p.nombres','p.apellido_paterno','p.apellido_materno','p1.nombres as nombre','p1.apellido_paterno as paterno','p1.apellido_materno as materno','domicilio','telefono')
                                   -> paginate($this->por_pagina);
        
        return View::make('admin.notaria.create', compact('title','title_section','subtitle_section','Municipio','Notarias','entidades'));
    }
    
    public function store($format = 'html') 
    {
        //obtenemos todos los datos del formulario
        $inputs = Input::All();
//        echo '<pre>';
//        $x=print_r($inputs);
//       echo "</pre>";
//        dd($x);
        //reglas
        $reglas = array(
            'entidad'=>'required',
            //'municipio'=>'required',
            'notaria'=>'required',
            'nombres'=>'required',
            'apellido_paterno'=>'required',
            'apellido_materno'=>'required',
            //'curp'=>'required',
            //'rfc'=>'required',
            'nombre'=>'required',
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
            $notario -> save();
            $nombre1 = $notario -> id_p;
            
            //guardamos el nombre del responsable
            $responsable = new personas();
            $responsable -> apellido_paterno = strtoupper($inputs["paterno"]);
            $responsable -> apellido_materno = strtoupper($inputs["materno"]);
            $responsable -> nombres          = strtoupper($inputs["nombre"]);
            $responsable -> rfc              = strtoupper($inputs["rfc1"]);
            $responsable -> curp             = strtoupper($inputs["curp1"]);
            $responsable -> save();
            $nombre2 = $responsable -> id_p;
            //guardamos los datos de la notaria
            $n = new Notaria();
            $n -> entidad           = $inputs["entidad"];
            $n -> municipio         = $inputs["municipio"];
            $n -> nombre           = strtoupper($inputs["notaria"]);
            $n -> id_notario        = $nombre1;
            $n -> id_responsable    = $nombre2;
            $n -> domicilio         = strtoupper($inputs["domicilio"]);
            $n -> telefono          = $inputs["telefono"];
            $n -> save();
            return Redirect::to('ventanilla/notaria/create')->with('success',
            'Los datos se han creado correctamente' . "!");
        }
    }
    
    public function edit($id) 
    {
        $Notaria = Notaria::find($id);

        $this->Notaria = $Notaria;

        $title = 'Administración de catálogo de notaria';

        //Título de sección:
        $title_section = "Editar notaria: ";
        
        //Subtítulo de sección:
        $subtitle_section = "";
        
        $entidad = array(1 => 'Distrito Federal','Aguascalientes','Baja California','Baja California Sur','Campeche','Chiapas','Chihuahua','Coahuila de Zaragoza','Colima','Durango','Guanajuato','Guerrero','Hidalgo','Jalisco','México','Michoacán de Ocampo','Morelos','Nayarit','Nuevo León','Oaxaca','Puebla','Querétaro de Arteaga','Quintana Roo','San Luis Potosí','Sinaloa','Sonora','Tabasco','Tamaulipas','Tlaxcala','Veracruz de Ignacio de la Llave','Yucatán','Zacatecas');
        
        $entidades =[''=>'--seleccione una opcion--']+$entidad;
        
        $Municipio = ['' => '--seleccione una opción--'] + Municipio::all()->lists('nombre_municipio','municipio');
        
        // Todos los permisos creados actualmente
        $Notarias = $this->Notaria -> join('personas as p','notarias.id_notario','=','p.id_p')
                                   -> join('personas as p1','notarias.id_responsable','=','p1.id_p')
                                   -> join('municipios as m','notarias.municipio','=','m.municipio')
                                   -> select('id_notaria','notarias.entidad','m.nombre_municipio','nombre as notaria','p.nombres','p.apellido_paterno','p.apellido_materno','p1.nombres as nombre','p1.apellido_paterno as paterno','p1.apellido_materno as materno','domicilio','telefono')
                                   -> paginate($this->por_pagina);
        
        $id = $Notaria->id;
        return View::make('admin.notaria.edit',
            compact('title','title_section','subtitle_section','Notaria','entidades','Municipio','Notarias','id'));
    }
    
    public function destroy($id = null)
    {
        $n= Notaria::find($id);
        $n->delete();
        return Redirect::to('ventanilla/notaria')->with('success',
            'Se han eliminado los datos correctamente ');
    }
    
}