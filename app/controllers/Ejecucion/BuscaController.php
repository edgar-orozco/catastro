<?php
//--Controlador para la busqueda de predios
class Ejecucion_BuscaController extends BaseController 
{
//cahcar parametros verificar vacio y evitar agregar en consulta k noi entre vacio

   public function getIndex() 
   { //abre function

       $catalogo = ejecutores::All();//->lists('cargo', 'id_ejecutor');
       // $datos = instalaciones::find($id);
        //return View::make('complementarios.editar',);
      // print_r($catalogo);
      return View::make('ejecucion.inicio', compact("catalogo"));
    }//cierra function
}
