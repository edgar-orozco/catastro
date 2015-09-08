<?php
use Illuminate\Support\Facades\Input;

/**
 * Este controlador nos permite navegar via web en el log de laravel para determinar problemas en ambientes staging y producción
 */

class AuditarLogController extends BaseController
{
    protected $path = "";
    protected $logname = "";
    protected $logfile = "";

    public function __construct(){
        $this->path = storage_path();
        $this->logname = 'logs/laravel.log';
        $this->logfile = $this->path."/".$this->logname;
    }

    public function index(){

        $accion = Input::get('accion');
        $numlineas = intval(Input::get('lineas', 100));
        $fecha = Input::get('fecha', date("Y-m-d H"));
        $lineas = array();

        if($accion == 'por-lineas' || $accion==''){
            exec("tail -n ". $numlineas." ".$this->logfile, $lineas);
        }

        if($accion == 'por-fecha'){
            $fecha = str_replace(";","",$fecha);
            $fecha = str_replace("'","",$fecha);
            $fecha = str_replace('"',"",$fecha);
            $fecha = str_replace('\\',"",$fecha);
            $fecha = str_replace('/',"",$fecha);
            exec("cat ".$this->logfile." | grep '$fecha'", $lineas);
        }

        $title = 'Auditor Log';
        //Título de sección:
        $title_section = "Audita bitácora de servidor.";
        //Subtítulo de sección:
        $subtitle_section = "Revisar por últimas n líneas, por fecha y hora";
        return View::make('admin.auditor.log.index',compact('title','title_section', 'subtitle_section', 'lineas'));
    }
}
