<?php

class admin_AuditorAdminUsuariosController extends \BaseController
{
    /**
     * User Model
     * @var User
     */
    protected $usuario;

    /**
     * Municipios
     * @var Municipio
     */
    protected $municpios;

    /**
     * Actividades del sistema
     * @var ActividadesSistema
     */
    protected $activiades;

    /**
    * Elementos por página que se mostrarán en pantalla. Se usa en el paginador.
    * @var int
    */
    protected $por_pagina = 10;

    public function __construct(User $user, Municipio $municipio, ActividadesSistema $activiades)
    {
        $this->usuario = $user;
        $this->municpios = $municipio;
        $this->activiades = $activiades;
    }
    /**
     * Acción del index
     * @return mixed
     */
    public function index(){
        $title = "Bitácora de actividades";
        $title_section = "Bitácora de actividades";
        $subtitle_section = "de administración de usuarios";
        $actividades = ActividadesSistema::paginate($this->por_pagina);
        return View::make('admin.auditor.index',
            compact('title', 'title_section', 'subtitle_section', 'actividades'));
    }

    /**
     * Acción para consultar el listado de actividades
     * @return array
     */
    public function consulta(){

        return $this->activiades->consulta(Input::all());
    }

    /**
     * Acción para obtener los datos de los filtros para las consultas
     * @return array
     */
    public function filtros(){
        $filtros = array();
        $filtros['usuarios'] = $this->usuario->listAdmins();
        $filtros['actividades'] = [
            ['id' => 'Nuevo Usuario', 'label' => 'Nuevo usuario'],
            ['id' => 'Modificación de usuario', 'label' => 'Modificación de usuario' ] ];
        $filtros['municipios'] = $this->municpios->filtro();
        $filtros['roles'] = Role::filtro();

        return $filtros;
    }

}