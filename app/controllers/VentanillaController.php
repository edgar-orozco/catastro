<?php
class VentanillaController extends BaseController
{

    public function index(){

        $title = 'Ventanilla primera atención';

        //Título de sección:
        $title_section = "Ventanilla de primera atención";

        //Subtítulo de sección:
        $subtitle_section = "Revisar requisitos, crear nuevos trámites, estatus de trámites.";

        $tipotramites = Tipotramite::all();

        return View::make('ventanilla.primera-atencion', compact('title', 'title_section', 'subtitle_section', 'tipotramites'));
    }


    public function getClaveCatastral($clave){


    }
}