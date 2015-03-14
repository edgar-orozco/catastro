<?php
use \Catastro\Repos\Padron\PadronRepositoryInterface;
use Carbon\Carbon;
use Laravelrus\LocalizedCarbon\LocalizedCarbon;

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

        $notarias = Notaria::all();
        $lista_notarias = array();
        $lista_notarias[] = '--Seleccione';
        foreach($notarias as $notaria) {
            $lista_notarias[$notaria->id_notaria] =$notaria->nombre;
        }

        $requisitos = $tipotramite->requisitos;

        $num_requisitos = count($requisitos);

        $uuid = \Webpatser\Uuid\Uuid::generate(4);

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
            'lista_notarias',
            'uuid'
        ));

    }


    public function storeTramite() {

        //Validamos que no se esté tratando de reenviar la forma:
        $uuid = Input::get('uuid');
        $existe = Tramite::existeUuid($uuid);
        if($existe){
            return Redirect::to('tramites/proceso/'.$existe->id);
        }

        $clave = Input::get('clave');
        $cuenta = Input::get('cuenta');
        $tipotramite_id = Input::get('tipotramite_id');
        $tipo_persona = Input::get('tipo_persona');


        //Por el momento en lo que se implementa la dependencia foliable, se asocia al municipio

        $municipio = substr($cuenta, 0, 2);
        $oMunicipio = Municipio::where('municipio',"0".$municipio)->first();

        $folio = FolioTramite::actual($oMunicipio->gid);

        $nombre = Input::get('nombres');
        $apepat = Input::get('apellido_paterno');
        $apemat = Input::get('apellido_materno');
        $rfc = Input::get('rfc');
        $curp = Input::get('curp');
        $notaria_id = Input::get('notaria_id');

        //echo $nombre,$apepat,$apemat;

        $this->tramite->clave= $clave;
        $this->tramite->tipotramite_id = $tipotramite_id;
        //$this->tramite->tipo_p = $tipotramite_id;
        $this->tramite->usuario_id = Auth::id();
        $this->tramite->notaria_id = $notaria_id;
        $this->tramite->folio = $folio;
        $this->tramite->uuid = $uuid;

        //Si es persona física seteamos el nombre completo y los apellidos
        if($tipo_persona == 'F') {
            $this->tramite->tipo_solicitante = 'FISICA';

            $aNombrec = array();
            if($nombre) $aNombrec[] = mb_strtoupper($nombre);
            if($apepat) $aNombrec[] = mb_strtoupper($apepat);
            if($apemat) $aNombrec[] = mb_strtoupper($apemat);
            $nombrec = "";
            if(count($aNombrec)>0) {
                $nombrec = implode(" ", $aNombrec);
            }
            $solicitante = personas::create([
                'nombres'=>mb_strtoupper($nombre),
                'apellido_paterno'=>mb_strtoupper($apepat),
                'apellido_materno'=>mb_strtoupper($apemat),
                'nombrec' => $nombrec,
                'rfc' => mb_strtoupper($rfc),
                'curp' => mb_strtoupper($curp),
            ]);

            $this->tramite->solicitante_id = $solicitante->id_p;
        }
        else if($tipo_persona == 'M'){
            $solicitante = personas::create([
                'nombres'=>mb_strtoupper($nombre),
                'rfc' => mb_strtoupper($rfc),
            ]);

            $this->tramite->solicitante()->create(['nombres'=>$nombre]);
            $this->tramite->tipo_solicitante = 'MORAL';
        }

        $res = $this->tramite->save();
        if($res) {
            FolioTramite::incrementar($oMunicipio->gid);
        }

        return Redirect::to('tramites/proceso/'.$this->tramite->id)->with('success', "Se ha iniciado el trámite con folio: ".$folio);
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



    public function proceso($tramite_id) {

        $tramite = Tramite::findOrFail($tramite_id);

        $fiscal = $this->padron->getByClaveOCuenta($tramite->clave);
        $clave = $fiscal->clave;
        $cuenta = $fiscal->cuenta;

        $predio = $fiscal;

        //La librería default implementa localizacón para español de es, nuestro local es es_MX, por lo tanto declaramos una alias
        //Nota, la librería localizedcarbon tiene un detalle, debe pasarlse el alias del locale en minúsculas, si no no toma en cuenta el alias
        DiffFormatter::alias('es_mx', 'es');

        $tipotramite = $tramite->tipotramite;
        $solicitante = $tramite->solicitante;
        $notaria = $tramite->notaria;
        $tiempo = $tipotramite->tiempo;

        $folio = $tramite->folio;

        //echo sprintf("%06d",$folio) ,"<br>";
        //echo $fiscal->clave ,"<br>";

        $title = $tipotramite->nombre;

        $title_section = $tipotramite->nombre;
        //echo $tramite->created_at."<br>";
        $transcurrido = Carbon::createFromTimeStamp($tramite->created_at->timestamp)->diffInDays();
        //echo $transcurrido."<br>";
        //echo "Han transcurrido ".$transcurrido ." días de ".$tiempo. " días para fin de trámite <br>";

        $hace = LocalizedCarbon::instance($tramite->created_at)->diffForHumans();
        //echo $hace."<br>";

        //exit;




        $estado = "En proceso";


        return View::make('ventanilla.flujo', compact(
            'title',
            'title_section',
            'subtitle_section',
            'clave',
            'cuenta',
            //'requisitos',
            'predio',
            'tramite',
            'tipotramite',
            'tipotramite_id',
            'folio',
            'estado',
            'tiempo_consumido',
            'tiempo_restante',
            'lista_notarias',
            'uuid'
        ));

    }


}



