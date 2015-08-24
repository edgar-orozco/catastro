<?php

class ClavesCobrosController extends BaseController {

    public function ObtenerValores() {
        return View::make('ClavesCobros.ClavesCobros');
    }

    public function CrearValores() {
        return View::make('ClavesCobros.create');
    }

}
