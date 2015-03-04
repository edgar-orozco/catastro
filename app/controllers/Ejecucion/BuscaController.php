<?php
//--Controlador para la busqueda de predios
class Ejecucion_BuscaController extends BaseController
{
//cahcar parametros verificar vacio y evitar agregar en consulta k noi entre vacio

   public function getIndex()
   { //abre function

       $catalogo = ejecutores::All();//->lists('cargo', 'id_ejecutor');
       $municipio = Municipio::All();
       $status = status::All();
       $mensaje='';




       return View::make('ejecucion.inicio', compact("catalogo","municipio","status","mensaje",'vale'));
    }
}
