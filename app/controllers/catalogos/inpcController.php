<?php

class catalogos_inpcController extends \BaseController {

    /**
     * Instancia del status
     * @var inpc
     */
    protected $inpc;

    public function __construct(inpc $inpc) {
        $this->inpc = $inpc;
    }

    /**
     * Mostrar una lista de los recursos.
     * GET /catalagos.status
     *
     * @param string $format
     * @return Response
     */
    public function index($format = 'html') {
        $inpc = $this->inpc;

        $title = 'Administracion de catalogo de INPC de ejecucion predial';

        //Titulo de seccion:
        $title_section = "Administracion del catalogo de INPC";

        //Subtitulo de seccion:
        $subtitle_section = "Crear, modificar y eliminar INPC";

        //Todos los status creados actulmente
        $inpcs = $this->inpc->all();

        return ($format == 'json') ? $inpcs : View::make('catalogos.inpc.index', 
            compact('title', 'title_section', 'subtitle_section', 'inpc', 'inpcs'));
    }

    public function create()
    {
        $inpc = $this->inpc;
        
        $title = 'Adminstraci�n de catalagos de inpc';
        
        //Titulo de seccion:
        $title_section = "Crear nuevo INPC.";
        
        //subtitulo de seccion:
        $subtitle_section = "";
        
        //Meses list
        $mes = array(' --- Seleccione un Mes --- ','enero','febrero','marzo','abril','mayo','junio','julio', 'agosto','septiembre','octubre','noviembre','diciembre');
        
      
        
        //Todos los status creados actualmente
        $inpcs = $this->inpc->all();
        
        return View::make('catalogos.inpc.create', 
            compact('title', 'title_section','subtitle_section', 'inpc', 'inpcs', 'mes'));
    }
    
    
    public function store($format = 'html')
    {
        //Obtengo todos los datos del formulario
        $inputs = Input::All();
        //reglas
        $reglas = array(
            //'mes' => 'required',
            'mes'=>'required',
            'anio' => 'required',
            'inpc' => 'required',
            
        );
        //Mensaje
        $mensajes = array(
            "required" => "Campo requerido",
        );
        //valida
        $validar = Validator::make($inputs, $reglas, $mensajes);
        //en caso que no pesa la validacion se regresa a la pagina cargando los mensajes de validacion
        if ($validar->fails()) {
            return Redirect::back()->withErrors($validar);
        } else {
            $n = new inpc;
            //$n->mes = $inputs["mes"];
            
            $n->anio = $inputs["anio"];
            $n->inpc = $inputs["inpc"];
            $n->mes = $inputs["mes"];
            $n->save();
             
        //Se han guardado los valores, expresamos al usuario nuestra felicidad al respecto.
        return Redirect::to('catalogos/inpc/create')->with('success',
            '¡Se ha creado correctamente el INPC: ' . $this->inpc->inpc . " !");

    }
    
        }
 
    public function edit($id)
    {
        //Buscamos el requisito en cuestión y lo asignamos a la instancia
        $inpc = inpc::find($id);

        $this->inpc = $inpc;

        $title = 'Administración de catálogo de requisitos';

        //Título de sección:
        $title_section = "Editar requisito: ";

        //Subtítulo de sección:
        $subtitle_section = $this->inpc->inpc;

        // Todos los permisos creados actualmente
        $inpcs = $this->inpc->all();
        //Meses list
        $mes = array(' --- Seleccione un Mes --- ','enero','febrero','marzo','abril','mayo','junio','julio', 'agosto','septiembre','octubre','noviembre','diciembre');
        
        

        //ID del permiso
        $id = $inpc->id;
        return View::make('catalogos.inpc.edit',
            compact('title', 'title_section', 'subtitle_section', 'inpc', 'inpcs', 'id', 'mes'));

    }
    
    
    public function update($id, $format = 'html')
    {
        $inputs = Input::All();
        $datos = inpc::find($id);
        //$datos->mes = $inputs["mes"];
        $datos->anio = $inputs["anio"];
        $datos->inpc = $inputs["inpc"];
        $datos->mes = $inputs["mes"];
        $mostrar=$inputs["inpc"];
        $datos->save();
        //Se han actualizado los valores expresamos la felicidad que se logro Wiiiii....
        return Redirect::to('catalogos/inpc/' . $id . '/edit')->with('success',
            '¡Se ha actualizado correctamente el inpc: ' . $mostrar . " !");

    }
    
    
    public function destroy($id = null)
    {
        $inpc = inpc::find($id);
        $inpc->delete();
        return Redirect::to('catalogos/inpc')->with('success',
            '¡Se ha eliminado correctamente el tipo de trámite: ' . $inpc->inpc . " !");
    }
}
