<?php

use \Catastro\Repos\Padron\PadronRepositoryInterface;

class VentanillaController extends BaseController
{
    protected $padron;
    protected $RequisitoTipotramite;
    protected $tipotramite;    
    /**
     * @param PadronRepositoryInterface $padron
     */
    public function __construct(PadronRepositoryInterface $padron, Tipotramite $tipotramite)
    {
        $this->padron = $padron;
        $this->tipotramite = $tipotramite;
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

        $misMunicipios = Auth::user()->municipios()->get(['gid']);

        $aMisMunicipios = array();
        foreach($misMunicipios as $mun)
        {
            $aMisMunicipios[] = $mun->gid;
        }

        if(empty($aMisMunicipios)){
            $municipios = Municipio::orderBy('nombre_municipio')->get();
        }
        else{
            $municipios = Municipio::whereIn('gid', $aMisMunicipios)->orderBy('nombre_municipio')->get();
        }


        return View::make('ventanilla.primera-atencion',
            compact('title', 'title_section', 'subtitle_section', 'tipotramites', 'municipios'));
    }

    /**
     * Regresa un registro del padrón fiscal mediante consulta de su clave catastral o cuenta.
     * @return mixed
     */
    public function getFiscalByClaveCatastral()
    {
        $identificador = Request::get('clave');
        $tipotramite_id = Request::get('tipotramite_id');
        $identificador = strtoupper($identificador);
        $res = $this->padron->getByClaveOCuenta($identificador);

        //Si la clave no se encuentra, se ingresa como un intento con bandera no encontrado
        if(!$res) {
            $intento = new Intento();
            $intento->clave = $identificador;
            $intento->usuario_id = Auth::id();
            $intento->noencontrado = true;
            $intento->tipotramite_id = $tipotramite_id;
            $intento->save();
        }
        return $res;
    }

    /**
     * Almacena el intento de iniciar trámite, esto sucede cuando el ciudadano no presenta todos los requisitos necesarios para el trámite.
     */
    public function storeIntento() {

        $intento = new Intento();
        $clave = Input::get('clave');
        $cuenta = Input::get('cuenta');
        $tipotramite_id = Input::get('tipotramite_id');

        $intento->clave = $clave;
        $intento->cuenta = $cuenta;
        $intento->tipotramite_id = $tipotramite_id;
        $intento->usuario_id = Auth::id();

        if(!$intento->save()){
            return Redirect::back()->withErrors($intento->errors());
        }

        //Armamos un arreglo con los requisitos no presentados para guardarlos en la relacion
        $requisitos = [];
        foreach(Input::get('requisitos') as $requisito_id => $presentado) {
            echo "rid: $requisito_id presentado: $presentado\n";
            if(!$presentado) {
                $requisitos[] = $requisito_id;
            }
        }
        //dd($requisitos);
        $intento->guardaRequisitos($requisitos);

        return $intento->id;
    }
    
    public function get_pdf() 
    {
        $tipotramites = Tipotramite::all();
        
        $vista = View::make('ventanilla.catalogo-tramites',compact('tipotramites'));
        $pdf = PDF::load($vista)->show('Tramite');
        $response = Response::make($pdf, 200);
        $response->header('Content-Type', 'application/pdf');
    }
}

