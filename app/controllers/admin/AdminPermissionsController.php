<?php

class AdminPermissionsController extends \BaseController {

    /**
     * Instancia del permiso
     * @var Permission
     */
    protected $permission;

    public function __construct(Permission $permission)
    {
        $this->permission = $permission;
    }

	/**
	 * Display a listing of the resource.
	 * GET /admin.permissions
	 *
	 * @return Response
	 */
	public function index($format = 'html')
	{
        $permission = $this->permission;

        $title = 'Administración de catálogo de permisos del sistema';

        //Título de sección:
        $title_section = "Administración del catálogo de permisos.";

        //Subtítulo de sección:
        $subtitle_section = "Crear, modificar y eliminar permisos.";

        // Todos los permisos creados actualmente
        $permissions = $this->permission->all();

        return  ($format == 'json') ? $permissions : View::make('admin.permission.index', compact('title', 'title_section', 'subtitle_section', 'permission','permissions'));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /admin.permissions/create
	 *
	 * @return Response
	 */
	public function create()
	{
        $permission = $this->permission;

        $title = 'Administración de catálogo de permisos del sistema';

        //Título de sección:
        $title_section = "Crear nuevo permiso.";

        //Subtítulo de sección:
        $subtitle_section = "";

        // Todos los permisos creados actualmente
        $permissions = $this->permission->all();

        return View::make('admin.permission.create', compact('title', 'title_section', 'subtitle_section', 'permission','permissions'));
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /admin.permissions
	 *
	 * @return Response
	 */
	public function store($format = 'html')
	{
        //sleep(10);
        //Asignamos los valores del post a la instancia.
        $this->permission = new Permission;

        //Si no es posible guardar la instancia mandamos errores
        if( ! $this->permission->save() )
        {
            if($format == 'json'){
                return array('status' => 'error', 'msg' => 'Datos incorrectos', 'data' => array( 'idx' => Input::get('idx'), 'errors' => $this->permission->errors()));
            }
            return Redirect::back()->withErrors($this->permission->errors());
        }

        if($format == 'json'){
            return array('status' => 'success', 'msg' => 'Permiso guardado', 'data' => array('id' => $this->permission->id, 'idx' => Input::get('idx')));
        }
        //Se han guardado los valores, expresamos al usuario nuestra felicidad al respecto.
        return Redirect::to('admin/permission/create')->with('success','¡Se ha creado correctamente el permiso: '. $this->permission->name. " !");
	}

	/**
	 * Display the specified resource.
	 * GET /admin.permissions/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /admin.permissions/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        //Buscamos el permiso en cuestión y lo asignamos a la instancia
        $permission = Permission::find($id);

        $this->permission = $permission;

        $title = 'Administración de catálogo de permisos del sistema';

        //Título de sección:
        $title_section = "Editar permiso: ";

        //Subtítulo de sección:
        $subtitle_section = $this->permission->display_name;

        // Todos los permisos creados actualmente
        $permissions = $this->permission->all();

        //ID del permiso
        $id = $permission->id;
        return View::make('admin.permission.edit', compact('title', 'title_section', 'subtitle_section', 'permission','permissions','id'));
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /admin.permissions/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, $format = 'html')
	{
		//Buscamos el permiso original, lo poblamos y lo asignamos a la instancia
        $permission = Permission::find($id);
        $permission->fill(Input::all());
        $this->permission = $permission;

        //Si no es posible guardar la instancia mandamos errores
        if( ! $this->permission->updateUniques() )
        {
            if($format == 'json'){
                return array('status' => 'error', 'msg' => 'Datos incorrectos', 'data' => array( 'idx' => Input::get('idx'), 'errors' => $this->permission->errors()));
            }
            return Redirect::back()->withErrors($this->permission->errors());
        }

        if($format == 'json'){
            return array('status' => 'success', 'msg' => 'Permiso actualizado', 'data' => array('id' => $this->permission->id, 'idx' => Input::get('idx')));
        }
        //Se han actualizado los valores, expresamos al usuario nuestro gran regocijo al respecto.
        return Redirect::to('admin/permission/'.$this->permission->id.'/edit')->with('success','¡Se ha actualizado correctamente el permiso: '. $this->permission->display_name. " !");
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /adminpermissions/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        $permission = Permission::find($id);
        $permission->delete();

        return array('status' => 'success', 'msg' => 'Permiso eliminado');
	}

}