<?php

use \Catastro\Repos\Padron\PadronRepositoryInterface;

class VentanillaController extends BaseController
{
    protected $padron;

    /**
     * @param PadronRepositoryInterface $padron
     */
    public function __construct(PadronRepositoryInterface $padron)
    {
        $this->padron = $padron;
    }

    /**
     * Muestra la pantalla de primera atención.
     * @return \Illuminate\View\View
     */
    public function index()
    {

        $title = 'Ventanilla primera atención';

        //Título de sección:
        $title_section = "Ventanilla de primera atención";

        //Subtítulo de sección:
        $subtitle_section = "Revisar requisitos, crear nuevos trámites, estatus de trámites.";

        $tipotramites = Tipotramite::all();

        return View::make('ventanilla.primera-atencion',
            compact('title', 'title_section', 'subtitle_section', 'tipotramites'));
    }

    /**
     * Regresa un registro del padrón fiscal mediante consulta de su clave catastral o cuenta.
     * @return mixed
     */
    public function getFiscalByClaveCatastral()
    {
        $identificador = Request::get('clave');
        return $this->padron->getByClaveOCuenta($identificador);
    }
}

