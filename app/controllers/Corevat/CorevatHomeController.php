<?php

/**
 * Este controlador es el encargado de recibir al usuario valuador y mostrar su pantalla principal
 * Class CorevatHomeController
 *
 */
class CorevatHomeController extends \BaseController {

    /**
     * Regresa la plantilla inicial del rol
     */
    public function index() {
        return View::make('Corevat.home-valuador');
    }
}