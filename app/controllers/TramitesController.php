<?php
use \Catastro\Repos\Padron\PadronRepositoryInterface;


class TramitesController extends BaseController {

    protected $padron;
    protected $tipotramite;
    protected $tramite;

    /**
     * @param PadronRepositoryInterface $padron
     * @param Tipotramite $tipotramite
     */
    public function __construct(PadronRepositoryInterface $padron, Tipotramite $tipotramite, Tramite $tramite)
    {
        $this->padron = $padron;
        $this->tipotramite = $tipotramite;
        $this->tramite = $tramite;
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

        $title = $tipotramite->nombre;

        $title_section = $tipotramite->nombre;
        //$subtitle_section = $tipotramite->nombre;

        //TODO: catálogo de folios por municipio.
        $folio = "";

        //TODO: cálculo de tiempo consumido de trámite
        $tiempo_consumido = 0;

        //TODO: Tiempo restante de trámite
        $tiempo_restante = 0;

        //TODO: crear catalogo de estados de trámite: Iniciado, En proceso, Finalizado, Finalizado con observaciones,
        $estado = 'Iniciado';

        $lista_notarias = [];

        $requisitos = $tipotramite->requisitos;

        $num_requisitos = count($requisitos);

        return View::make('ventanilla.control', compact(
            'title',
            'title_section',
            'subtitle_section',
            'clave',
            'cuenta',
            'requisitos',
            'predio',
            'tipotramite',
            'tipotramite_id',
            'folio',
            'estado',
            'tiempo_consumido',
            'tiempo_restante',
            'lista_notarias'
        ));

    }


    public function storeTramite() {
        $clave = Input::get('clave');
        $cuenta = Input::get('cuenta');
        $tipotramite_id = Input::get('tipotramite_id');
        $tipo_persona = Input::get('tipo_persona');

        $nombre = Input::get('nombre');
        $apepat = Input::get('apellido_paterno');
        $apemat = Input::get('apellido_materno');
        $notaria_id = Input::get('notaria_id');

        echo $nombre,$apepat,$apemat;

        $this->tramite->clave= $clave;
        $this->tramite->tipotramite_id = $tipotramite_id;
        //$this->tramite->tipo_p = $tipotramite_id;
        $this->tramite->usuario_id = Auth::id();

        $this->tramite->folio = 1;

        //Si es persona física seteamos el nombre completo y los apellidos
        if($tipo_persona == 'F') {
            $this->tramite->solicitante()->create(['nombres'=>$nombre, 'apellido_paterno'=>$apepat, 'apellido_materno'=>$apemat]);
        }
        else{
            $this->tramite->solicitante()->create(['nombres'=>$nombre]);
        }

        $this->tramite->save();



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