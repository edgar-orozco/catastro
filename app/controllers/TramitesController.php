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
    public function indexDocumentos(){
        $clave = Input::get('clave');
        $cuenta = Input::get('cuenta');


        $tipotramite_id = Input::get('tipotramite_id');

        $tipotramite = $this->tipotramite->findOrFail($tipotramite_id);
        $predio = $this->padron->getByClaveOCuenta($cuenta);

        $requisitos = $tipotramite->requisitos;

        $num_requisitos = count($requisitos);

        //echo "<h1>Aquí debe ir el guardado de archivos de los documentos escaneados</h1>\n";

        //echo $clave." ".$cuenta." ".$tipotramite->nombre."<br>";

        $title = 'Guardar documentos';

        return View::make('ventanilla.documentos', compact('title', 'clave', 'cuenta', 'requisitos','predio','tipotramite'));

    }


    public function storeDocumentos() {

        $clave = Input::get('clave');
        $cuenta = Input::get('cuenta');


        //echo $clave." ".$cuenta." ".$num_requisitos."<br>";

        $docs = Input::file('documento');
        $requisito_ids = Input::get('requisito_ids');

//dd($requisito_ids);
        $rules = array();
        foreach($requisito_ids as $requisito_id){
            $rules[] = array('documento.'.$requisito_id => ['required', 'max:2000', 'mimes:jpeg,png,pdf']);
            //$rules[] = array('documento.'.$requisito_id => 'required|max:2000|mimes:jpeg,png,pdf');

        }
//dd($rules);
        //print_r($docs);
        //print_r($requisito_ids);

        if(count($docs) <  count($requisito_ids)) {

        }

        $tipotramite_id = Input::get('tipotramite_id');

        $tipotramite = $this->tipotramite->findOrFail($tipotramite_id);
        $predio = $this->padron->getByClaveOCuenta($cuenta);

        $validator = Validator::make($docs, $rules);

        if($validator->fails())
        {
            return Redirect::back()->withErrors($validator->errors());
        }
    }
}