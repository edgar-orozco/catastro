<?php
//--Controlador para la busqueda de predios
class Ejecucion_BuscarController extends BaseController 
{
//cahcar parametros verificar vacio y evitar agregar en consulta k noi entre vacio

   public function getIndex() 
   { //abre function
        //captura de datos de buscar.blade.php
        $clave = Input::get('clave');
        $propietario = Input::get('nombre');
        $municipio = Input::get('municipio');
      //  $colonia= Input::get('colonia');
      //  $calle = Input::get('calle');
      //  $cp = Input::get('cp');
      // $estatus= Input::get('estatus');
      //  $date = Input::get('date');

        $clave = Str::upper($clave);
        if (!empty($propietario)) {    //abre if           
        $busqueda = emision::WHERE('emision_predial.clave', '=',  $clave)
            ->orWhere('personas.nombrec', 'LIKE', "%$propietario%")
            ->orWhere('emision_predial.municipio', $municipio)
            -> join ('propietarios', 'emision_predial.clave', '=' ,'propietarios.clave')
            -> join ( 'personas', 'propietarios.id_propietario',  '=',  'personas.id_p' )
            -> leftjoin ( 'ejecucion_fiscal', 'emision_predial.clave',  '=',  'ejecucion_fiscal.clave') 
            /*->whereNotExists(function($query)
              {
                  $query->select(ejecucion::raw(1))
                        ->from('ejecucion_fiscal')
                        ->whereRaw('emision_predial.clave', '=', 'ejecucion_fiscal.clave')
              })*/
            -> select ( 'emision_predial.clave', 'emision_predial.municipio AS municipio', 'personas.nombrec AS nombre', 'personas.rfc AS calle', 'personas.fecha_ingr AS colonia' ,  'propietarios.fecha_ingr AS cp', 'propietarios.tipo_propietario AS tipo', 'emision_predial.anio AS minimo', 'emision_predial.impuesto AS impuesto', 'ejecucion_fiscal.cve_status AS estatus')
            -> orderBy('emision_predial.clave','asc')
           // -> paginate(30);
            -> get ();
           // print_r($busqueda);
          }else//cierra if
          { //abre else
            
             $busqueda = emision::WHERE('emision_predial.clave', '=',  $clave)
            ->orWhere('personas.nombrec', $propietario)
            ->orWhere('emision_predial.municipio', $municipio)
            -> join ('propietarios', 'emision_predial.clave', '=' ,'propietarios.clave')
            -> join ( 'personas', 'propietarios.id_propietario',  '=',  'personas.id_p' ) 
            -> leftjoin ( 'ejecucion_fiscal', 'emision_predial.clave',  '=',  'ejecucion_fiscal.clave') 
            -> select ( 'emision_predial.clave', 'emision_predial.municipio AS municipio', 'personas.nombrec AS nombre', 'personas.rfc AS calle', 'personas.fecha_ingr AS colonia' ,  'propietarios.fecha_ingr AS cp', 'propietarios.tipo_propietario AS tipo', 'emision_predial.anio AS minimo', 'emision_predial.impuesto AS impuesto', 'ejecucion_fiscal.cve_status AS estatus')
            -> orderBy('emision_predial.clave','asc')
           // ->paginate(3);
           -> get ();         
          } //cierra else
          //consulta a la tabla de ejecutores por ahora esta vacia
          $ejecutores = ejecutores::all();
          $data = [
      'ejecutores' => $ejecutores,
      'types' => ejecutores::lists('id_ejecutor'),
              ];

  //return View::make('customers.edit', $data);
          //$selected = array();
          //View::make("ejecucion.buscar", compact());

        return View::make('ejecucion.buscar', compact('busqueda','data'));
    }//cierra function
}
