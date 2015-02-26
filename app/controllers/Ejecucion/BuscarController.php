<?php
//--Controlador para la busqueda de predios
class Ejecucion_BuscarController extends BaseController 
{
//cahcar parametros verificar vacio y evitar agregar en consulta k noi entre vacio

  //public $por_pagina = 10;
   public function getIndex() 
   { //abre function
        //captura de datos de buscar.blade.php
        $clave = Input::get('clave');
        $string = Input::get('nombre');
        $por_pagina = Input::get('paginado');


function sanear_string($string)
{
    $string = trim($string);

    $string = str_replace(
        array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
        array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
        $string
    );

    $string = str_replace(
        array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
        array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
        $string
    );

    $string = str_replace(
        array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
        array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
        $string
    );

    $string = str_replace(
        array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
        array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
        $string
    );

    $string = str_replace(
        array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
        array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
        $string
    );

    $string = str_replace(
        array('ñ', 'Ñ', 'ç', 'Ç'),
        array('n', 'N', 'c', 'C',),
        $string
    );

    //Esta parte se encarga de eliminar cualquier caracter extraño
    $string = str_replace(
        array("\\", "¨", "º", "-", "~",
             "#", "@", "|", "!", "\"",
             "·", "$", "%", "&", "/",
             "(", ")", "?", "'", "¡",
             "¿", "[", "^", "`", "]",
             "+", "}", "{", "¨", "´",
             ">", "< ", ";", ",", ":",
             ".", " "),
        '',
        $string
    );


    return $string;
}
      $propietario=sanear_string($string);

        $propietario = strtoupper($propietario);








      $municipio = Input::get('municipio');
      //--------------------------DATOS FALTANTES PARA LA CONSULTA-------------------------------------------
      //  $colonia= Input::get('colonia');
      //  $calle = Input::get('calle');
      //  $cp = Input::get('cp');
      // $estatus= Input::get('estatus');
      //  $date = Input::get('date');
         $resultado = DB::select("select sp_get_predios('$clave','$propietario','','','$municipio','','','','','')");
//var_dump($resultado);
//$res=_aa_sp_obtiene_predio;
//print_r($resultado);
//echo '</pre>';

foreach ($resultado as $key ) {



$vale[]= explode(',', $key->sp_get_predios);
         //cierra else
         // print_r($busqueda);
         // if(!$busqueda)
         // {
            //return Redirect::to('ejecucion/inicio')->with('success','¡No: ');
         //   Session::flash('mensaje', 'No se encontraron resultados');
            //return Redirect::to('complementarios/agregar');
        //    return Redirect::back();
         // }else{
          //consulta a la tabla de ejecutores por ahora esta vacia
          $catalogo = ejecutores::All();//->lists('cargo', 'id_ejecutor');
          $municipio = Municipio::All();
          $status = status::All();
          $totalItems=count($resultado);
          if($totalItems == 0)
          {
            $mensaje='No se encontraron coincidencias con los parametros de busqueda';
          }
       // $datos = instalaciones::find($id);
        //return View::make('complementarios.editar',);
      // print_r($catalogo);
     // return View::make('ejecucion.inicio', compact("catalogo"));
    }
   // print_r($vale);
    $paginator = Paginator::make($vale, $totalItems, $por_pagina);
     return View::make('ejecucion.inicio', compact('busqueda',"catalogo","municipio","status","mensaje",'vale','paginator'));
   // }
  
    //cierra function
}
}