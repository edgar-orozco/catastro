<?php
/**
 * Created by PhpStorm.
 */

class CargaShapesController extends BaseController
{

    /**
     * Muestra la pantalla principal para la carga de shapes
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Title
        $title = "Carga Cartográfica";
        // Title
        $title_section = "Carga Cartográfica";

        return View::make('admin.cargashapes.upload-shape', compact('title', 'title_section'));
    }
}