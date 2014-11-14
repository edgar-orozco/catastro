<?php
/*
|--------------------------------------------------------------------------
| AdminRolesController
|--------------------------------------------------------------------------
|
*/

class AdminRolesController extends AdminController
{
    /**
     * User Model
     * @var User
     */
    protected $user;

    /**
     * Role Model
     * @var Role
     */
    protected $role;

    /**
     * Permission Model
     * @var Permission
     */
    protected $permission;

    /**
     * Inject the models.
     * @param User       $user
     * @param Role       $role
     * @param Permission $permission
     */
    public function __construct(User $user, Role $role, Permission $permission)
    {
        $this->user = $user;
        $this->role = $role;
        $this->permission = $permission;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        // Title
        $title = "Administrador de roles del sistema";

        //Título de sección:
        $title_section = "Administrador de roles. ";

        //Subtítulo de sección:
        $subtitle_section = "Crear, modificar, asignar permisos.";

        //La instancia
        $role = $this->role;

        //Los roles disponibles
        $roles = Role::all();

        return View::make('admin/role/index', compact('role','roles', 'title', 'title_section', 'subtitle_section'));
    }

    /**
     * Show a single role details page.
     *
     * @return View
     */
    public function show($role)
    {
        if ($role->id) {
            $permissions = $this->permission->preparePermissionsForDisplay($role->perms()->get());
        } else {
            // Redirect to the role management page
            return Redirect::to('admin/roles')->with('error', Lang::get('admin/role/messages.does_not_exist'));
        }

        // Title
        $title = Lang::get('admin/role/title.role_show');

        // Show the page
        return View::make('admin/role/show', compact('role', 'permissions', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        // Get all the available permissions
        $permissions = $this->permission->all();

        // Title
        $title = "Administrador de roles del sistema";

        //Título de sección:
        $title_section = "Administrador de roles. ";

        //Subtítulo de sección:
        $subtitle_section = "Crear, modificar, asignar permisos.";

        //Todos los roles
        $roles = Role::all();

        $role = $this->role;
        // Show the page
        return View::make('admin/role/create', compact('roles', 'role', 'permissions', 'selectedPermissions', 'title', 'title_section', 'subtitle_section'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        //Llenamos los parametros que vienen de la forma
        $this->role->fill(Input::all());

        //Si no puede guardarse entonces mostramos errores en pantalla
        if ( ! $this->role->save()) {
            return Redirect::back()->withErrors($this->role->errors());
        }

        //Si pasa la validación entonces guardamos los permisos relacionados con el rol
        $this->role->savePermissions(Input::get( 'permissions' ));

        //Dado que fue exitosa la actualización mostramos la salida al usaurio.
        return Redirect::to('admin/role/create')->with('success','¡Se ha creado correctamente el rol: '. $this->role->name. " !");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $role
     * @return Response
     */
    public function edit($id)
    {
        $role = Role::find($id);
        $roles = $this->role->all();
        $permissions = Permission::all();

        // Title
        $title = Lang::get('admin/role/title.role_update');

        //Título de sección:
        $title_section = "Modificar rol: ";

        //Subtítulo de sección:
        $subtitle_section = $role->name;

        // Show the page
        return View::make('admin/role/edit', compact('role', 'roles', 'permissions', 'title', 'title_section', 'subtitle_section'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $id
     * @return Response
     */
    public function update($id)
    {
        //Buscamos el rol original relacionado con el id
        $this->role = Role::find($id);
        //Llenamos los parametros que vienen de la forma
        $this->role->fill(Input::all());

        //Si no puede guardarse entonces mostramos errores en pantalla
        if ( ! $this->role->save()) {
            return Redirect::back()->withErrors($this->role->errors());
        }

        //Si pasa la validación entonces guardamos los permisos relacionados con el rol
        $this->role->savePermissions(Input::get( 'permissions' ));

        //Dado que fue exitosa la actualización mostramos la salida al usaurio.
        return Redirect::to('admin/role/'.$this->role->id.'/edit')->with('success','¡Se ha actualizado correctamente el rol: '. $this->role->name. " !");
    }

    /**
     * Remove role page.
     *
     * @param $role
     * @return Response
     */
    public function delete($role)
    {
        // Title
        $title = Lang::get('admin/role/title.role_delete');

        if ($role->id) {
            $permissions = $this->permission->preparePermissionsForDisplay($role->perms()->get());
        } else {
            // Redirect to the role management page
            return Redirect::to('admin/roles')->with('error', Lang::get('admin/role/messages.does_not_exist'));
        }

        // Show the record
        return View::make('admin/role/delete', compact('role', 'permissions', 'title'));
    }

    /**
     * Remove the specified user from storage.
     * @internal param $id
     * @return Response
     */
    public function destroy($role)
    {
        // Was the role deleted?
        if ($role->delete()) {
            // Redirect to the role management page
            return Redirect::to('admin/roles')->with('success', Lang::get('admin/role/messages.delete.success'));
        }

        // There was a problem deleting the role
        return Redirect::to('admin/roles')->with('error', Lang::get('admin/role/messages.delete.error'));
    }


}
