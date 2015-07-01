<?php

class admin_usuarioNotariaController extends \BaseController
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
        $title = "Administración de usuarios de notarias.";

        //Título de sección:
        $title_section = "Administración de usuarios de notarias";

        //Subtítulo de sección:
        $subtitle_section = "Buscar, crear y modificar usuarios.";

        // All roles
        $roles = $this->role->all();

        //Lista de usuarios

        return  View::make('admin.user.notarias.index', compact('roles', 'selectedRoles', 'title', 'title_section', 'subtitle_section', 'user'));
    }

    /**
     * Control para generar la lista de usuarios registrados
     *
     * @return array
     */
    public function all(){

        return $this->user->listAngularNotarias();
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

        $this->user->rfc = Input::get( 'rfc' );
        $this->user->curp = Input::get( 'curp' );

        $this->user->password = Input::get( 'password' );
        $this->user->password_confirmation = Input::get( 'password_confirmation' );
        $this->user->confirmed = true;

        if ($this->user->save()) {
            // Save if valid. Password field will be hashed before save
            // Save roles. Handles updating.
            if(Input::get( 'roles' )){
                $this->user->saveRoles(Input::get( 'roles' ));
            }
            if( is_array(Input::get( 'notarias' ) ) ){
                // Se guardan los municipios a los que pertenece un usuario
                $this->user->notarias()->sync(Input::get( 'notarias' ));
            }
            if ($format == 'json') {
                return array(
                    'status' => 'success',
                    'msg' => 'Usuario guardado',
                    'data' => array('id' => $this->user->id, 'idx' => Input::get('idx'), 'roles' => $this->user->roles, 'notarias' => $this->user->notarias)
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
        $this->user->rfc = Input::get( 'rfc' );
        $this->user->curp = Input::get( 'curp' );

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

            if ( is_array(Input::get( 'notarias' ) ) ){
                // Se guardan los municipios a los que pertenece un usuario
                $user->notarias()->sync(Input::get( 'notarias' ));
            }
            if ($format == 'json') {
                return array(
                    'status' => 'success',
                    'msg' => 'Usuario actuaizado',
                    'data' => array('id' => $user->id, 'idx' => Input::get('idx'), 'roles' => $user->roles, 'notarias' => $user->notarias)
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

}
