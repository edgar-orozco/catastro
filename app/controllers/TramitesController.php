<?php
use \Catastro\Repos\Padron\PadronRepositoryInterface;


class TramitesController extends BaseController {

    protected $padron;
    protected $tipotramite;

    /**
     * @param PadronRepositoryInterface $padron
     * @param Tipotramite $tipotramite
     */
    public function __construct(PadronRepositoryInterface $padron, Tipotramite $tipotramite)
    {
        $this->padron = $padron;
        $this->tipotramite = $tipotramite;
    }

    /**
     * Pantalla para subir los documentos escaneados
     */
    public function getDocumentos(){
        $clave = Input::get('clave');
        $cuenta = Input::get('cuenta');
        $tipotramite_id = Input::get('tipotramite_id');

        $tipotramite = $this->tipotramite->findOrFail($tipotramite_id);
        $predio = $this->padron->getByClaveOCuenta($cuenta);

        $requisitos = $tipotramite->requisitos;

        echo "<h1>Aquí debe ir el guardado de archivos de los documentos escaneados</h1>\n";

        echo $clave." ".$cuenta." ".$tipotramite->nombre."<br>";


        foreach($requisitos as $requisito ) {

            echo $requisito->nombre."<br>";
        }

    }

}