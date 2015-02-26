<?php
 
//--Controlador para la busqueda de predios
class Ejecucion_BuscarController extends BaseController
{
 
    //Limitador de registros por pagina.
    public $por_pagina = 10;
 
    /**
     * Ejecuta la búsqueda y regresa la vista principal
     * @return \Illuminate\View\View
     */
    public function getIndex()
    {
        //captura de datos de buscar.blade.php
        $clave = Input::get('clave');
        $string = Input::get('nombre');
       // $this->por_pagina = Input::get('paginado');
       echo  $this->por_pagina = Input::get('paginado', $this->por_pagina);
        $propietario = $this->sanear_string($string);
 
        //    $propietario = strtoupper($propietario);
        $municipio = Input::get('municipio');
        //--------------------------DATOS FALTANTES PARA LA CONSULTA-------------------------------------------
        //  $colonia= Input::get('colonia');
        //  $calle = Input::get('calle');
        //  $cp = Input::get('cp');
        // $estatus= Input::get('estatus');
        //  $date = Input::get('date');
        $resultado = DB::select("select sp_get_predios('$clave','$propietario','','','$municipio','','','','','')");
 
        foreach ($resultado as $key) {
            $vale[] = explode(',', $key->sp_get_predios);
        }
 
        $catalogo = ejecutores::All();//->lists('cargo', 'id_ejecutor');
        $municipio = Municipio::All();
        $status = status::All();
        echo $totalItems = count($resultado);
        if ($totalItems == 0) {
            $mensaje = 'No se encontraron coincidencias con los parametros de busqueda';
        }
 
        $paginator = Paginator::make($vale, $totalItems, $this->por_pagina);
        return View::make('ejecucion.inicio', compact('busqueda', "catalogo", "municipio", "status", "mensaje", 'vale', 'paginator'));
 
    }
 
    /**
     * Filtra y sanea cadenas de entrada para realizar la búsqueda
     * @param $string
     * @return mixed|string
     */
    public function sanear_string($string)
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
}