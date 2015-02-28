<?php
/**
 * Este controlador nos sirve para ejecutar tareas de desarrollo en el servidor de staging y el local
 */
use Symfony\Component\Console\Output\BufferedOutput;

class DesarrolloController extends BaseController
{
    protected $title = "Ejecuta seeds";
    protected $environment = "";

    public function __construct(){
        $this->environment = App::environment();
    }

    /**
     * Muestra la forma que solicita el nombre de la clase del seeder a ejecutar
     */
    public function seedsIndex(){

        return View::make('admin.seeds.index',['title'=>$this->title, 'environment'=> $this->environment]);
    }

    /**
     * Ejecuta el seed y regresa respuesta
     * @return $this
     */
    public function ejecutaSeed(){

        $class = Input::get('class');
        if(!class_exists($class))
        {
            return Redirect::to('admin/ejecuta-seeds')->withInput()->with('error', "La clase $class no existe en el servidor, por favor haz push de tu seeder y vuelve a proporcionar el nombre de la clase.");
        }

        if(false === strpos($class, "Seeder") )
        {
            return Redirect::to('admin/ejecuta-seeds')->withInput()->with('error', "La clase $class no es una clase seeder válida, favor de corregir.");
        }

        $output = new BufferedOutput;
        $error = "";
        try {
            Artisan::call('db:seed', array('--class' => $class), $output);
        }
        catch(Exception $e){
            $error = $e->getMessage();
        }
        $output = $output->fetch();

        if($output.$error) {
            return Redirect::to('admin/ejecuta-seeds')->withInput()->with('error',$output.$error);
        }
        return Redirect::to('admin/ejecuta-seeds')->with('success',"Se ha ejecutado el seeder $class en el servidor ".$this->environment);
    }

}