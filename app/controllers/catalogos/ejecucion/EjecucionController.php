<?php

class catalogos_ejecucion_EjecucionController extends \BaseController
{

    /**
     * Instancia del permiso
     * @var ejecucion
     */
    protected $ejecucion;
    protected $municipio;

    public function __construct(Ejecucion $ejecucion, Municipio $municipio )
    {
        $this->ejecucion = $ejecucion;
        $this->municipio = $municipio;
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
        
        $ejecucion = $this->ejecucion;

       

        $title = 'Administración de catálogo de Gastos de Ejecución';

        //Título de sección:
        $title_section = "Administración del catálogo de gastos.";

        //Subtítulo de sección:
        $subtitle_section = "Crear, modificar y eliminar.";

        $ejecuciones = $this->ejecucion->all();


        $ejecuciones= $this->ejecucion -> join ( 'municipio', 'municipio.id_municipio',  '=',  'gastos_ejecucion_municipio.id_municipio' ) 
            						   -> select ('municipio', 'id_gasto_ejecucion as id', 'gasto_ejecucion_porcentaje', 'gastos_ejecucion_municipio.id_municipio', 'usuario')
            						   ->get();


        

        // Todos los permisos creados actualmente
        

        return ($format == 'json') ? $ejecuciones  : View::make('catalogos.ejecucion.gastos-ejecucion',
            compact('title', 'title_section', 'subtitle_section', 'ejecucion', 'ejecuciones'));
    }

    /**
     * Show the form for creating a new resource.
     * GET /admin.ejecuciones/create
     *
     * @return Response
     */
    public function create()
    {
        $ejecucion = $this->ejecucion;

        $title = 'Administración de catálogo de permisos del sistema';

        //Título de sección:
        $title_section = "Crear nuevo permiso.";

        //Subtítulo de sección:
        $subtitle_section = "";

        // Todos los permisos creados actualmente
        $ejecuciones = $this->ejecucion->all();

        return View::make('catalogos.ejecucion.create',
            compact('title', 'title_section', 'subtitle_section', 'ejecucion', 'ejecuciones'));
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
        //sleep(10);
        //Asignamos los valores del post a la instancia.
        //$this->ejecucion = new ejecucion;

        $this->ejecucion->id_municipio = Input::get( 'municipio' );
        $this->ejecucion->gasto_ejecucion_porcentaje = Input::get( 'gasto_ejecucion_porcentaje' );


        //Si no es posible guardar la instancia mandamos errores
        if (!$this->ejecucion->save()) {
            if ($format == 'json') {
                return array(
                    'status' => 'error',
                    'msg' => 'Datos incorrectos',
                    'data' => array('idx' => Input::get('idx'), 'errors' => $this->ejecucion->errors())
                );
            }
            return Redirect::back()->withErrors($this->ejecucion->errors());
        }

        if ($format == 'json') {
            return array(
                'status' => 'success',
                'msg' => 'Permiso guardado',
                'data' => array('id' => $this->ejecucion->id_gasto_ejecucion, 'idx' => Input::get('idx'))
            );
        }
        //Se han guardado los valores, expresamos al usuario nuestra felicidad al respecto.
       



    }

    /**
     * Display the specified resource.
     * GET /admin.ejecuciones/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        //
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
        //Buscamos el permiso en cuestión y lo asignamos a la instancia
        $ejecucion = ejecucion::find($id);

        $this->ejecucion = $ejecucion;

        $title = 'Administración de catálogo de permisos del sistema';

        //Título de sección:
        $title_section = "Editar permiso: ";

        //Subtítulo de sección:
        $subtitle_section = $this->ejecucion->municipio;

        // Todos los permisos creados actualmente
        $ejecuciones = $this->ejecucion->all();

        //ID del permiso
        $id = $ejecucion->id;
        return View::make('catalogos.ejecucion.edit',
            compact('title', 'title_section', 'subtitle_section', 'ejecucion', 'ejecuciones', 'id'));
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
        //Buscamos el permiso original, lo poblamos y lo asignamos a la instancia



         
    	$this->ejecucion = ejecucion::find($id);
        $this->ejecucion->id_municipio = Input::get( 'municipio' );
        $this->ejecucion->gasto_ejecucion_porcentaje = Input::get( 'gasto_ejecucion_porcentaje' );
        



        //Si no es posible guardar la instancia mandamos errores
        if (!$this->ejecucion->save()) {
            if ($format == 'json') {
                return array(
                    'status' => 'error',
                    'msg' => 'Datos incorrectos',
                    'data' => array('idx' => Input::get('idx'), 'errors' => $this->ejecucion->errors())
                );
            }
            return Redirect::back()->withErrors($this->ejecucion->errors());
        }

        if ($format == 'json') {
            return array(
                'status' => 'success',
                'msg' => 'Registro actualizado',
                'data' => array('id' => $this->ejecucion->id_gasto_ejecucion, 'idx' => Input::get('idx'))
            );
        }
        //Se han actualizado los valores, expresamos al usuario nuestro gran regocijo al respecto.
        return Redirect::to('catalogos/ejecucion/' . $this->ejecucion->id_gasto_ejecucion . '/edit')->with('success',
            '¡Se ha actualizado correctamente el permiso: ' . $this->ejecucion->municipio . " !");
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /adminejecuciones/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        $ejecucion = ejecucion::find($id);
        $ejecucion->delete();

        return array('status' => 'success', 'msg' => 'Registro eliminado');
    }

}