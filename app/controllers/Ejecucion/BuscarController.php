<?php
//--Controlador para la busqueda de predios
class Ejecucion_BuscarController extends BaseController 
{
//cahcar parametros verificar vacio y evitar agregar en consulta k noi entre vacio
   protected $por_pagina = 10;
   public function getIndex() 
   { //abre function
        //captura de datos de buscar.blade.php
        $clave = Input::get('clave');
        $propietario = Input::get('nombre');
      //  $municipio = Input::get('municipio');
      //--------------------------DATOS FALTANTES PARA LA CONSULTA-------------------------------------------
      //  $colonia= Input::get('colonia');
      //  $calle = Input::get('calle');
      //  $cp = Input::get('cp');
      // $estatus= Input::get('estatus');
      //  $date = Input::get('date');
      
        $clave = Str::upper($clave);
        //----------------------------VALIDACION DE CAMPO PERSONA SI TRAE DATOS REALIZA ESTA CONSULTA SI LLEGA VACIO GENERA ERROR EN EL LIKE POR ESO HAY 2 CONSULTAS
        //ESTA EN PROCESO DE RESOLVER ESE ERROR Y LA CONSULTA NO ESTA COMPLETA YA QUE POR LA CONPLEJIDAD SE REALIZARA CON PROCEDIMIENTOS ALMACENADOS
        if (!empty($propietario)) {    //abre if           
        $busqueda = emision::WHERE('emision_predial.clave', '=',  $clave)
            ->orWhere('personas.nombrec', 'LIKE', "%$propietario%")
            //->orWhere('emision_predial.municipio', $municipio)
            -> join ('propietarios', 'emision_predial.clave', '=' ,'propietarios.clave')
            -> join ( 'personas', 'propietarios.id_propietario',  '=',  'personas.id_p' )
            -> leftjoin ( 'ejecucion_fiscal', 'emision_predial.clave',  '=',  'ejecucion_fiscal.clave') 
            -> select ( 'emision_predial.clave', 'personas.nombrec AS nombre', 'personas.rfc AS calle', 'personas.fecha_ingr AS colonia' ,  'propietarios.fecha_ingr AS cp', 'propietarios.tipo_propietario AS tipo', 'emision_predial.anio AS minimo', 'emision_predial.impuesto AS impuesto', 'ejecucion_fiscal.cve_status AS estatus')
            -> orderBy('emision_predial.clave','asc')
         //   ->paginate($this->por_pagina);
           // -> paginate(30);
            -> get ();
           // print_r($busqueda);
          }else//cierra if
          { //abre else
            
             $busqueda = emision::WHERE('emision_predial.clave', '=',  $clave)
            ->orWhere('personas.nombrec', $propietario)
            //->orWhere('emision_predial.municipio', $municipio)
            -> join ('propietarios', 'emision_predial.clave', '=' ,'propietarios.clave')
            -> join ( 'personas', 'propietarios.id_propietario',  '=',  'personas.id_p' ) 
            -> leftjoin ( 'ejecucion_fiscal', 'emision_predial.clave',  '=',  'ejecucion_fiscal.clave') 
            -> select ( 'emision_predial.clave', 'personas.nombrec AS nombre', 'personas.rfc AS calle', 'personas.fecha_ingr AS colonia' ,  'propietarios.fecha_ingr AS cp', 'propietarios.tipo_propietario AS tipo', 'emision_predial.anio AS minimo', 'emision_predial.impuesto AS impuesto', 'ejecucion_fiscal.cve_status AS estatus')
            -> orderBy('emision_predial.clave','asc')
           // ->paginate($this->por_pagina);
           // ->paginate(3);
           -> get ();         
          } //cierra else

          //consulta a la tabla de ejecutores por ahora esta vacia
          $catalogo = ejecutores::All();//->lists('cargo', 'id_ejecutor');
       // $datos = instalaciones::find($id);
        //return View::make('complementarios.editar',);
      // print_r($catalogo);
     // return View::make('ejecucion.inicio', compact("catalogo"));
    
        return View::make('ejecucion.inicio', compact('busqueda',"catalogo"));
    }//cierra function
}
