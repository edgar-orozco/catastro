<?php
/*
|--------------------------------------------------------------------------
| AdminUserController
|--------------------------------------------------------------------------
|
*/

class AdminUserController extends BaseController
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
     * Elementos por página que se mostrarán en pantalla. Se usa en el paginador.
     * @var int
     */
    protected $por_pagina = 10;

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
     * Users
     *
     * @return View
     */
    public function index()
    {
        //La lista de usuarios necesita una instancia de user
        $user = $this->user;

        // Title
        $title = "Administración de usuarios.";

        //Título de sección:
        $title_section = "Administración de usuarios del sistema";

        //Subtítulo de sección:
        $subtitle_section = "Buscar, crear y modificar usuarios.";

        // All roles
        $roles = $this->role->all();

        //Lista de usuarios

        return  View::make('admin.user.index', compact('roles', 'selectedRoles', 'title', 'title_section', 'subtitle_section', 'user'));
    }

    /**
     * Control para generar la lista de usuarios registrados
     *
     * @return array
     */
    public function all(){

        return $this->user->listAngular();
    }

    /**
     * Show a single user details page.
     *
     * @return View
     */
    public function show($user)
    {

        if ($user->id) {
            $roles = $this->role->all();
            $permissions = $this->permission->all();

             // Title
            $title = "Detalles del usuario";

            return View::make('admin/user/show', compact('user', 'roles', 'permissions', 'title'));
        } else {
            return Redirect::to('admin/user')->with('error', "El usuario no existe.");
        }
    }


    public function search($user){

    }

    /**
     * Displays the form for user creation
     *
     */
    public function create()
    {

        // Title
        $title = "Crear usuario.";

        //Título de sección:
        $title_section = "Crear usuario.";

        //Subtítulo de sección:
        $subtitle_section = "Dar de alta un nuevo usuario en el sistema.";

        // All roles
        $roles = $this->role->all();

        //Lista de usuarios
        $usuarios = User::paginate($this->por_pagina);

        //La lista de usuarios necesita una instancia de user
        $user = $this->user;

        // Selected roles
        $selectedRoles = Input::old('roles', array());

        // Show the page
        return View::make('admin.user.create', compact('roles', 'selectedRoles', 'title', 'title_section', 'subtitle_section', 'usuarios', 'user'));
    }

    /**
     * Stores new account
     *
     */
    public function store($format = 'html')
    {
        $this->user->username = Input::get( 'username' );
        $this->user->email = Input::get( 'email' );

        $this->user->nombre = Input::get( 'nombre' );
        $this->user->apepat = Input::get( 'apepat' );
        $this->user->apemat = Input::get( 'apemat' );

        $this->user->password = Input::get( 'password' );
        $this->user->password_confirmation = Input::get( 'password_confirmation' );
        $this->user->confirmed = true;

        if ($this->user->save()) {
            // Save if valid. Password field will be hashed before save
            // Save roles. Handles updating.
            if(Input::get( 'roles' )){
                $this->user->saveRoles(Input::get( 'roles' ));
            }
            if( is_array(Input::get( 'municipios' ) ) ){
                // Se guardan los municipios a los que pertenece un usuario
                $this->user->municipios()->sync(Input::get( 'municipios' ));
            }
            if ($format == 'json') {
                return array(
                    'status' => 'success',
                    'msg' => 'Usuario guardado',
                    'data' => array('id' => $this->user->id, 'idx' => Input::get('idx'), 'roles' => $this->user->roles, 'municipios' => $this->user->municipios)
                );
            }

            return Redirect::to('admin/user/create')->with('success', "Se ha crado correctamente el usuario ".$this->user->nombreCompleto());

        } else {
            // Get validation errors (see Ardent package)
            $error = $this->user->errors;
            if ($format == 'json') {
                return array(
                    'status' => 'error',
                    'msg' => 'Datos incorrectos',
                    'data' => array('idx' => Input::get('idx'), 'errors' => $error)
                );
            }
            return Redirect::to('admin/user/create')->withInput()->withErrors($error);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $user
     * @return Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        if ($user->id) {
            $roles = $user->currentRoleIds();
            $permissions = $this->permission->all();

             // Title
            $title = "Modificar datos de usuario ".$user->username;

            //Título de sección:
            $title_section = "Modificar datos de usuario:";

            //Subtítulo de sección:
            $subtitle_section = $user->username;

            //Lista de usuarios
            $usuarios = User::paginate($this->por_pagina);

            return View::make('admin/user/edit', compact('user', 'roles', 'permissions', 'title', 'title_section', 'subtitle_section', 'usuarios'));
        } else {
            return Redirect::to('admin/user')->with('error', "El usuario no existe");
        }
    }

    /**
     * Activa o desactiva un usuario
     * @param $id
     * @return array
     */
    public function active($id){

        $user = User::find($id);
        $user->vigente = Input::get( 'vigente' );
        if($user->save()){
            return array(
                'status' => 'success',
                'msg' => 'Datos guardados',
                'data' => array('id' => Input::get('id'))
            );
        }
        else{
            $error = $user->errors;
            return array(
                'status' => 'error',
                'msg' => 'Datos incorrectos',
                'data' => array('id' => Input::get('id'), 'errors' => $error)
            );
        }

    }
    /**
     * Update the specified resource in storage.
     *
     * @param $user
     * @return Response
     */
    public function update($id, $format = 'html')
    {
        $user = User::find($id);
        $user->username = Input::get( 'username' );
        $user->email = Input::get( 'email' );
        $user->nombre = Input::get( 'nombre' );
        $user->apepat = Input::get( 'apepat' );
        $user->apemat = Input::get( 'apemat' );

        $password = Input::get( 'password' );
        $passwordConfirmation = Input::get( 'password_confirmation' );
        if (!empty($password)) {
            $user->password = $password;
            $user->password_confirmation = $passwordConfirmation;
        }

        if ($user->save()) {
            if (Input::get( 'roles' )){
                $user->saveRoles(Input::get( 'roles' ));
            }

            if ( is_array(Input::get( 'municipios' ) ) ){
                error_log('Municipios');
                // Se guardan los municipios a los que pertenece un usuario
                $user->municipios()->sync(Input::get( 'municipios' ));
            }
            if ($format == 'json') {
                return array(
                    'status' => 'success',
                    'msg' => 'Usuario actuaizado',
                    'data' => array('id' => $user->id, 'idx' => Input::get('idx'), 'roles' => $user->roles, 'municipios' => $user->municipios)
                );
            }
            return Redirect::to('admin/user')->with('success', "Se han actualizado correctamente los datos del usuario ".$user->nombreCompleto());
        } else {
            // Get validation errors (see Ardent package)
            $error = $user->errors;
            if ($format == 'json') {
                return array(
                    'status' => 'error',
                    'msg' => 'Datos incorrectos',
                    'data' => array('idx' => Input::get('idx'), 'errors' => $error)
                );
            }
            return Redirect::to('admin/user/'.$user->id.'/edit')->withInput()->withErrors($error);
        }
    }

    /**
     * Remove user.
     *
     * @param $user
     * @return Response
     */
    public function delete($user)
    {
        if ($user->id) {
            $roles = $this->role->all();
            $permissions = $this->permission->all();

             // Title
            $title = Lang::get('admin/user/title.user_delete');

            return View::make('admin/user/delete', compact('user', 'roles', 'permissions', 'title'));
        } else {
            return Redirect::to('admin/user')->with('error', Lang::get('admin/user/messages.does_not_exist'));
        }
    }

    /**
     * Remove the specified user from storage.
     *
     * @return Response
     */
    public function destroy($user)
    {
        // Check if we are not trying to delete ourselves
        if ($user->id === Confide::user()->id) {
            // Redirect to the user management page
            return Redirect::to('admin/user')->with('error', Lang::get('admin/user/messages.delete.impossible'));
        }

        AssignedRoles::where('user_id', $user->id)->delete();

        $id = $user->id;
        $user->delete();

        // Was the comment post deleted?
        $user = User::find($id);
        if (empty($user) ) {
            // TODO needs to delete all of that user's content
            return Redirect::to('admin/user')->with('success', Lang::get('admin/user/messages.delete.success'));
        } else {
            // There was a problem deleting the user
            return Redirect::to('admin/user')->with('error', Lang::get('admin/user/messages.delete.error'));
        }
    }


}
