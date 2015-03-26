<?php

class catalogos_ejecutoresController extends \BaseController {

    /**
     * Instancia del status
     * @var ejecutores
     * @var personas
     */
    protected $ejecutores;
    protected $personas;

    public function __construct(ejecutores $ejecutores, personas $personas) {
        $this->ejecutores = $ejecutores;
        $this->personas = $personas;
    }

    /*
     * INDEX DE EJECUTORES
     */

    public function index($format = 'html', $id = null) {
        $ejecutores = $this->ejecutores;

        $title = 'Administracion de catalogo del personal de ejecuci&oacute;n fiscal';

        //Titulo de seccion:
        $title_section = "Administracion del personal de ejecuci&oacute;n fiscal";

        //Subtitulo de seccion:
        $subtitle_section = "Crear, modificar y eliminar de ejeci&oacute;n fiscal";

        //Todos los ejecutores creados actulmente


        $ejecutoress = $this->ejecutores->join('personas', 'personas.id_p', '=', 'ejecutores.id_p')
                ->join('personas as p', 'p.id_p', '=', 'ejecutores.id_p_otorga_nombramiento')
                ->select('id_ejecutor', 'personas.nombres', 'personas.apellido_paterno', 'personas.apellido_materno', 'cargo', 'titulo', 'f_nombramiento', 'p.nombres as nombre', 'p.apellido_paterno as p_paterno', 'p.apellido_materno as p_materno')
                ->get();

        return ($format == 'json') ? $ejecutoress : View::make('catalogos.ejecutores.index', compact('title', 'title_section', 'subtitle_section', 'ejecutores', 'ejecutoress'));
    }

    /*
     * CONTROLADOR DONDE CREA UN NUEVO EJECUTOR
     */

    public function create() {

        $ejecutores = $this->ejecutores;

        $title = 'Adminstraci�n de catalago del personal de ejecuci&oacute;n fiscal';

        //Titulo de seccion:
        $title_section = "Crear nuevo personal de ejecuci&oacute;n fiscal.";

        //subtitulo de seccion:
        $subtitle_section = "";

        //Todos los ejecutores creados actualmente
        $ejecutoress = $this->ejecutores->join('personas', 'personas.id_p', '=', 'ejecutores.id_p')
                ->join('personas as p', 'p.id_p', '=', 'ejecutores.id_p_otorga_nombramiento')
                ->select('id_ejecutor', 'personas.nombres', 'personas.apellido_paterno', 'personas.apellido_materno', 'cargo', 'titulo', 'f_nombramiento', 'p.nombres as nombre', 'p.apellido_paterno as p_paterno', 'p.apellido_materno as p_materno')
                ->get();

        return View::make('catalogos.ejecutores.create', compact('title', 'title_section', 'subtitle_section', 'ejecutores', 'ejecutoress', 'personas', 'propietario'));
    }

    /*
     * CONTROLADRO DONDE GURADA A LOS EJECUTORES
     */

    public function store($format = 'html') {
        $inputs = Input::All();
        //Reglas
        $reglas = array(
            'id_p' => 'required',
            'cargo' => 'required',
            'titulo' => 'required',
            'f_nombramiento' => 'required',
            'id_p_otorga_nombramiento' => 'required',
        );
        //Mensaje
        $mensajes = array(
            "required" => "*",
        );
        //valida
        $validar = Validator::make($inputs, $reglas, $mensajes);
        //en caso no pase la validacion
        if ($validar->fails()) {
            return Redirect::back()->withErrors($validar);
        } else {
            $n = new ejecutores();
            $n->id_p = $inputs["id_p"];
            $n->cargo = $inputs["cargo"];
            $n->titulo = $inputs["titulo"];
            $n->f_nombramiento = $inputs["f_nombramiento"];
            $n->id_p_otorga_nombramiento = $inputs["id_p_otorga_nombramiento"];
            $n->save();
            Session::flash('mensaje', 'El registro ha sido ingresado exitosamente');
            //Se han guardado los valores
            return Redirect::to('catalogos/ejecutores/create')->with('success', '¡Se ha creado correctamente el ejecutor' . " !");
//            return Redirect::back();
        }
    }

    /*
     * CONTROLADOR PARA EDITAR LOS EJECUTORES
     */

    public function edit($id) {
        //Buscamos el requisito en cuestión y lo asignamos a la instancia
        $ejecutores = ejecutores::find($id);

//        print_r($id);
//        $nombrec = ejecutores::join('personas','ejecutores.id_p' , '=', 'personas.id_p')
//                ->select( 'personas.nombrec')
//                ->where('ejecutores.id_ejecutor','=',$id)
//                ->get();
        $idpe = ejecutores::where('id_ejecutor', $id)->pluck('id_p');
        $nombrec = personas::where('id_p', $idpe)->pluck('nombrec');

        $idpo = ejecutores::where('id_ejecutor', $id)->pluck('id_p_otorga_nombramiento');

        $nombre = personas::where('id_p', $idpo)->pluck('nombrec');
        //('id_p','=','43468')->select('nombres')->get();
        //var_dump($nombre);
        //var_dump($ejecutores);
        //$this->ejecutores = $ejecutores;

        $title = 'Administración de catálogo de ejecutores';

        //Título de sección:
        $title_section = "Editar ejecutor: ";

        //Subtítulo de sección:
        $subtitle_section = $this->ejecutores->titulo;

        // Todos los permisos creados actualmente
        $ejecutoress = $this->ejecutores->join('personas', 'personas.id_p', '=', 'ejecutores.id_p')
                ->join('personas as p', 'p.id_p', '=', 'ejecutores.id_p_otorga_nombramiento')
                ->select('id_ejecutor', 'personas.nombrec', 'cargo', 'titulo', 'f_nombramiento', 'p.nombrec as nombre')
                ->get();
        //ID del permiso
        $id = $ejecutores;
        //echo $id;

        return View::make('catalogos.ejecutores.edit', compact('title', 'title_section', 'subtitle_section', 'ejecutores', 'ejecutoress', 'id', 'nombrec', 'nombre'));
    }

    /*
     * CONTROLADOR DONDE SE ACTUALIZA LOS EJECUTORES
     */

    public function update($id, $format = 'html') {
        $inputs = Input::All();
        $n = ejecutores::find($id);
        $n->id_p = $inputs["id_p"];
        $n->cargo = $inputs["cargo"];
        $n->titulo = $inputs["titulo"];
        $n->f_nombramiento = $inputs["f_nombramiento"];
        $n->id_p_otorga_nombramiento = $inputs["id_p_otorga_nombramiento"];
        $mostrar = $inputs["id_p"];
        $n->save();
        //Se han actualizado los valores expresamos la felicidad que se logro Wiiiii....
        return Redirect::to('catalogos/ejecutores/' . $id . '/edit')->with('success', '¡Se ha actualizado correctamente el ejecutor!');
    }

    /*
     * DONDE ELIMINA LOS EJECUTORES
     */

    public function destroy($id = null) {
        $ejecutores = ejecutores::find($id);
        $ejecutores->delete();
        return Redirect::to('catalogos/ejecutores')->with('success', '¡Se ha eliminado correctamente el ejecutor' . " !");
    }

    /*
     * AUTOCOMPLETAR DE LA TABLA PERSONAS 
     */

    public function autocomplete() {
//        $term = Input::get('term');
        $term = Str::upper(Input::get('term'));
        //ARRAY DONDE CARGA LOS DATOS
        $results = array();

        $id_p = array();
        //CONSULTA A LA TABLA PERSONAS
//        $queries = DB::table('personas')
//                ->where('nombres', 'LIKE', '%' . $term . '%')
//                ->orWhere('apellido_paterno', 'LIKE', '%' . $term . '%')
//                ->orWhere('apellido_materno', 'LIKE', '%' . $term . '%')
//                ->take(5)
//                ->get();
        $queries = DB::select(DB::raw("SELECT * FROM personas WHERE nombres || ' '||apellido_paterno || ' ' ||  apellido_materno LIKE '%" . $term . "%' limit 5"));
        //DONDE LLAMA LOS DATOS Y LOS PASA A LAS VARIABLES CORRESPONDIENTES
        foreach ($queries as $query) {
            //ARRAY DONDE CARGA LOS DATOS
            $id_p[] = ['id_p' => $query->id_p];
            $results[] = ['value' => $query->nombres . ' ' . $query->apellido_paterno . ' ' . $query->apellido_materno, 'id' => $query->id_p];
        }
        if ($results) {
            //SI EXITE LA PERSONA            
            return Response::json($results);
        } else {
//            //SI NO EXITE LA PAERSONA
//            $mensaje[] = ['id' => 0];
            $mensaje[] = "NO EXISTE LA PERSONAS";
            return Response::json($mensaje);
        }
    }

    /*
     * INDEX PERSONA 
     */

    public function getIndex($format = 'html', $id = null) {
        $title = 'Crar nueva perosana';
        //Titulo de seccion:
        $title_section = "";
        //Subtitulo de seccion:
        $subtitle_section = "Crear nueva persona";
        return View::make('catalogos.ejecutores.personas', compact('title', 'title_section', 'subtitle_section'));
    }

    /*
     * STORE DE PERSONAS
     */

    public function storep($format = 'html') {
        $inputs = Input::All();
        //Reglas 
        $reglas = array(
            'apellido_paterno' => 'required',
            'apellido_materno' => 'required',
            'nombres' => 'required',
            'rfc' => 'required',
            'curp' => 'required',
        );

        $apellido_paterno = Input::get('apellido_paterno');
        $apellido_materno = Input::get('apellido_materno');
        $nombres = Input::get('nombres');
        $term = $nombres . ' ' . $apellido_paterno . ' ' . $apellido_materno;
        //echo $nombrec=$apellido_materno." ".$apellido_paterno." ".$nombres ; 
        //Mensaje
        $mensajes = array(
            "required" => "*",
        );
        //valida
        $validar = Validator::make($inputs, $reglas, $mensajes);
        //en caso no pase la validacion
        if ($validar->fails()) {
            return Redirect::back()->withErrors($validar);
        } else {
            $n = new personas();
            $n->apellido_paterno = $inputs["apellido_paterno"];
            $n->apellido_materno = $inputs["apellido_materno"];
            $n->nombres = $inputs["nombres"];
            $n->nombrec = $apellido_paterno . " " . $apellido_materno . " " . $nombres;
            $n->rfc = $inputs["rfc"];
            $n->curp = $inputs["curp"];
            $n->save();
            $queries = DB::select(DB::raw("SELECT id_p FROM personas WHERE nombres || ' ' || apellido_paterno || ' ' ||  apellido_materno LIKE '%" . $term . "%' limit 1"));
            //Se han guardado los valores
            foreach ($queries as $key) {
                $id = $key->id_p;
            }
            Session::flash('mensaje', 'El registro ha sido ingresado exitosamente');
            return Response::json(array('id_p' => $id));
            // return Redirect::back();
        }
    }

    public function getagregarpersona($format = 'html', $id = null) {
        $title = 'Crar nueva perosana';
        //Titulo de seccion:
        $title_section = "";
        //Subtitulo de seccion:
        $subtitle_section = "Crear nueva persona";
        return View::make('catalogos.ejecutores.nombrador', compact('title', 'title_section', 'subtitle_section'));
    }

    /*
     * STORE DE PERSONAS
     */

    public function post_agregarpersona($format = 'html') {
        $inputs = Input::All();
        //Reglas 
        $reglas = array(
            'apellido_paterno' => 'required',
            'apellido_materno' => 'required',
            'nombres' => 'required',
            'rfc' => 'required',
            'curp' => 'required',
        );

        $apellido_paterno = Input::get('apellido_paterno');
        $apellido_materno = Input::get('apellido_materno');
        $nombres = Input::get('nombres');
        $term = $nombres . ' ' . $apellido_paterno . ' ' . $apellido_materno;
        //echo $nombrec=$apellido_materno." ".$apellido_paterno." ".$nombres ; 
        //Mensaje
        $mensajes = array(
            "required" => "*",
        );
        //valida
        $validar = Validator::make($inputs, $reglas, $mensajes);
        //en caso no pase la validacion
        if ($validar->fails()) {
            return Redirect::back()->withErrors($validar);
        } else {
            $n = new personas();
            $n->apellido_paterno = $inputs["apellido_paterno"];
            $n->apellido_materno = $inputs["apellido_materno"];
            $n->nombres = $inputs["nombres"];
            $n->nombrec = $apellido_paterno . " " . $apellido_materno . " " . $nombres;
            $n->rfc = $inputs["rfc"];
            $n->curp = $inputs["curp"];
            $n->save();
            $queries = DB::select(DB::raw("SELECT id_p FROM personas WHERE nombres || ' ' || apellido_paterno || ' ' ||  apellido_materno LIKE '%" . $term . "%' limit 1"));
            //Se han guardado los valores
            foreach ($queries as $key) {
                $id = $key->id_p;
            }
            Session::flash('mensaje', 'El registro ha sido ingresado exitosamente');
            return Response::json(array('id_p' => $id));
            // return Redirect::back();
        }
    }

}
