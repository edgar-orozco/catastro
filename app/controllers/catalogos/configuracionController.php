<?php

class catalogos_configuracionController extends \BaseController
{

    /**
     * Instancia del permiso
     * @var ejecucion
     */
    protected $configuracionMunicipal;
    protected $Municipio;
    public function __construct(configuracionMunicipal $configuracionMunicipal, Municipio $Municipo) {
        $this->configuracionMunicipal = $configuracionMunicipal;
        $this->Municipio = $Municipo;
    }

    /**
     * Display a listing of the resource.
     * GET /admin.ejecuciones
     *
     * @param string $format
     * @return Response
     */
    public function index($format = 'html')
    {
        $configuracionMunicipal = $this-> configuracionMunicipal;
        $Municipio = $this-> Municipio;

        $title = 'Administración de catálogo de configuracion de municipal';

        //Título de sección:
        $title_section = "Administración del catálogo de configuracion de municipal.";

        //Subtítulo de sección:
        $subtitle_section = "Crear, modificar y eliminar.";

        //Todos las configuraciones municipales creadas
        $configuracionMunicipales = $this->configuracionMunicipal->join('municipios', 'configuracion_municipal.municipio','=','municipios.gid' )
                                    ->select('id_configuracion','municipios.nombre_municipio','nombre','cargo','gastos_ejecucion_porcentaje','descuento_multa','descuento_gasto_ejecucion','descuento_recargo','descuento_actualizacion')
                                    ->get();

        // Todos los permisos creados actualmente

        return ($format == 'json') ? $configuracionMunicipales  : View::make('catalogos.configuracion.index',
            compact('title', 'title_section', 'subtitle_section', 'configuracionMunicipal', 'configuracionMunicipales'));
    }

    /**
     * Show the form for creating a new resource.
     * GET /admin.ejecuciones/create
     *
     * @return Response
     */
    public function create()
    {
        $configuracionMunicipal = $this-> configuracionMunicipal;
        $Municipio = $this-> Municipio->all();

        $title = 'Administración de catálogo de configuracion de municipal';

        //Título de sección:
        $title_section = "Administración del catálogo de configuracion de municipal.";

        //Subtítulo de sección:
        $subtitle_section = "";

        // Todos los permisos creados actualmente
        $configuracionMunicipales = $this->configuracionMunicipal->join('municipios', 'configuracion_municipal.municipio','=','municipios.gid' )
                                    ->select('id_configuracion','municipios.nombre_municipio','nombre','cargo','gastos_ejecucion_porcentaje','descuento_multa','descuento_gasto_ejecucion','descuento_recargo','descuento_actualizacion')
                                    ->get();

        return View::make('catalogos.configuracion.create',
            compact('title', 'title_section', 'subtitle_section', 'configuracionMunicipal', 'configuracionMunicipales','Municipio'));
    }

    /**
     * Store a newly created resource in storage.
     * POST /admin.ejecuciones
     *
     * @param string $format
     * @return Response
     */
    public function store($format = 'html')
   {
        //hablamos el archivo 
        $file = Input::file('file');
        //nombre del archivo
        $url_imagen=$file->getClientOriginalName();
        //validamos el tipo de extencion
        $extension = explode('.', $url_imagen);
        $num = count($extension)-1;
        if($extension[$num] == 'jpg'||$extension[$num] == 'png'||$extension[$num] == 'bmp'||$extension[$num] == 'jpeg' ||$extension[$num] == 'JPG'||$extension[$num] == 'PNG' ||$extension[$num] == 'BMP'){
        //valida el peso de la imagen
        if(filesize($file) < 500000){
        //Se carga la imagen 
        $destionPath = public_path().'/logos/';
        $subir = $file->move($destionPath,$file->getClientOriginalName());
        if($subir){
        //Obtengo todos los datos del formulario
        $inputs = Input::All();
        //reglas
        $reglas = array(
            'municipio' => 'required',
            'nombre' => 'required',
            'cargo' => 'required',
            'gastos_ejecucion_porcentaje' => 'required',
            'descuento_multa' => 'required',
            'descuento_gasto_ejecucion' => 'required',
            'descuento_recargo' => 'required',
            'descuento_actualizacion' => 'required',
            'file' => 'required',
        );
        //Mensaje
        $mensajes = array(
            "required" => "*",
        );
        //valida
        $validar = Validator::make($inputs, $reglas, $mensajes);
        //en caso que no pesa la validacion se regresa a la pagina cargando los mensajes de validacion
        if ($validar->fails()) {
            return Redirect::back()->withErrors($validar);
        }  else {
            $n = new configuracionMunicipal;
            
            $n->municipio = $inputs["municipio"];
            $n->nombre = $inputs["nombre"];
            $n->cargo = $inputs["cargo"];
            $n->gastos_ejecucion_porcentaje = $inputs["gastos_ejecucion_porcentaje"];
            $n->descuento_multa = $inputs["descuento_multa"];
            $n->descuento_gasto_ejecucion = $inputs["descuento_gasto_ejecucion"];
            $n->descuento_recargo = $inputs["descuento_recargo"];
            $n->descuento_actualizacion = $inputs["descuento_actualizacion"];
            $n->file = $url_imagen;
            $n->save();
            //Se a guardado los datos y ya tengo hambreeeeeee...... jejeje lol 
            return Redirect::to('catalogos/configuracion/create')->with('success',
            '¡Se ha creado correctamente!');
        }
        
       }
       return Redirect::to('catalogos/configuracion/create')->with('error',
            'El archivo no se cargo correctamente');
   }
   return Redirect::to('catalogos/configuracion/create')->with('error',
            'Exedel tamoño de los 500kb "'.Input::file('file')->getClientOriginalName());
        }
   return Redirect::to('catalogos/configuracion/create')->with('error',
            'Extensión de archivo invalida en "'.Input::file('file')->getClientOriginalName().'", los formatos validos son .jpg, .png, .bnp');
        
        
        }



    /**
     * Show the form for editing the specified resource.
     * GET /admin.ejecuciones/{id}/edit
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        
        
        $configuracionMunicipal = configuracionMunicipal::find($id);
        
        $this-> configuracionMunicipal = $configuracionMunicipal;
        
        $Municipio = $this-> Municipio->all();
        
        $title = 'Administración de catálogo de configuracion de municipal';

        //Título de sección:
        $title_section = "Editar configuracion municipal:";
        
        //subtitulo de seccion.
        $subtitle_section = $this->configuracionMunicipal->configuracionMunicipal;
        
        // Todos los permisos creados actualmente
        $configuracionMunicipales = $this->configuracionMunicipal->join('municipios', 'configuracion_municipal.municipio','=','municipios.gid' )
                                    ->select('id_configuracion','municipios.nombre_municipio','nombre','cargo','gastos_ejecucion_porcentaje','descuento_multa','descuento_gasto_ejecucion','descuento_recargo','descuento_actualizacion')
                                    ->get();
        
        //id de la configuracion
        $id = $configuracionMunicipal ->id;
        return View::make('catalogos.configuracion.edit', 
                compact('title', 'title_section', 'subtitle_section', 'configuracionMunicipal', 'configuracionMunicipales', 'id', 'Municipio'));         
    }

    /**
     * Update the specified resource in storage.
     * PUT /admin.ejecuciones/{id}
     *
     * @param  int $id
     * @param string $format
     * @return Response
     */
    public function update($id, $format = 'html')
    {
       //hablamos el archivo 
        $file = Input::file('file');
        //nombre del archivo
        $url_imagen=$file->getClientOriginalName();
        //validamos el tipo de extencion
        $extension = explode('.', $url_imagen);
        $num = count($extension)-1;
        if($extension[$num] == 'jpg'||$extension[$num] == 'png'||$extension[$num] == 'bmp'||$extension[$num] == 'jpeg' ||$extension[$num] == 'JPG'||$extension[$num] == 'PNG' ||$extension[$num] == 'BMP'){
        //valida el peso de la imagen
        if(filesize($file) < 500000){
        //Se carga la imagen 
        $destionPath = public_path().'/logos/';
        $subir = $file->move($destionPath,$file->getClientOriginalName());
        
        if($subir){
            $inputs = Input::All();
            $n = configuracionMunicipal::find($id);
            $n->municipio = $inputs["municipio"];
            $n->nombre = $inputs["nombre"];
            $n->cargo = $inputs["cargo"];
            $n->gastos_ejecucion_porcentaje = $inputs["gastos_ejecucion_porcentaje"];
            $n->descuento_multa = $inputs["descuento_multa"];
            $n->descuento_gasto_ejecucion = $inputs["descuento_gasto_ejecucion"];
            $n->descuento_recargo = $inputs["descuento_recargo"];
            $n->descuento_actualizacion = $inputs["descuento_actualizacion"];
            $n->file = $url_imagen;
            $n->save();
            //Se han actualizado los valores expresamos la felicidad que se logro Wiiiii....
            return Redirect::to('catalogos/configuracion/' . $id . '/edit')->with('success',
            '¡Se ha actualizado correctamente la configuracion municipal!');
        } 
        return Redirect::to('catalogos/configuracion/' . $id . '/edit')->with('error',
            '¡El archivo no se cargo correctamente!');
        }
   return Redirect::to('catalogos/configuracion/' . $id . '/edit')->with('error',
            'Exedel tamoño de los 500kb "'.Input::file('file')->getClientOriginalName());
        }
   return Redirect::to('catalogos/configuracion/' . $id . '/edit')->with('error',
            'Extensión de archivo invalida en "'.Input::file('file')->getClientOriginalName().'", los formatos validos son .jpg, .png, .bnp');
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /adminejecuciones/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id = null)
    {
        $configuracionMunicipal = configuracionMunicipal::find($id);
        $configuracionMunicipal -> delete();
        return Redirect::to('catalogos/configuracion')->with('success',
            '¡Se ha eliminado correctamente la configuracion municipal'." !");
    }
    


}