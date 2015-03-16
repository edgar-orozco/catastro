<?php
//--Controlador para la busqueda de predios
class Ejecucion_BuscarController extends BaseController
{
    /**
     * Ejecuta la búsqueda y regresa la vista principal
     * @return \Illuminate\View\View
     */
    public function getIndex()
    {
         $title = "Generacion De Carta Invitación.";

         //Título de sección:
         $title_section = "Generacion De Carta Invitación";

         //Subtítulo de sección:
         $subtitle_section = "Ejecucion Fiscal.";
        //captura de datos de inicio.blade.php
            $clave       = Input::get('clave');
            $string      = Input::get('nombre');
            $por_pagina  = Input::get('paginado',10);
            $propietario = $this->sanear_string($string);
            $municipios   = Input::get('municipios');
            $mayor = Input::get('mayor');
            $menor = Input::get('menor');
            $adeudo = Input::get('adeudos');
            $resultado = DB::select("select sp_get_predios('$clave','$propietario','$mayor','$menor','$municipios','','','','','')");

            foreach ($resultado as $key)
            {
                $items[] = explode(',', $key->sp_get_predios);
            }
            /**
             * Consulta retorna nombre del ejecutor
             * @var [type]
             */
            $catalogo = ejecutores::join('personas', 'ejecutores.id_p', '=', 'personas.id_p')
            ->select('ejecutores.id_p AS id', 'personas.nombrec AS nombre')
            ->get();
            /**
             * Retorna los municipios para select
             * @var [type]
             */
            $municipio = Municipio::All();
            /**
             * Retorna los Estatus para select
             * @var [type]
             */
            $status    = status::All();
            /**
             * valida si hubo resultados en la busqueda y retorna resultado a la vista sergun resultado
             * @var [type]
             */
             $totaldatos     = count($resultado);
             if ($totaldatos == 0)
                {
                    $mensaje = 'No se encontraron coincidencias con los parametros de busqueda';
                    return View::make('ejecucion.inicio', compact('busqueda', "catalogo", "municipio", "status", "mensaje",'title','title_section','subtitle_section'));
                }
             else
                {
                     $datos      = array_chunk($items, $por_pagina);
                     $totaldatos =count($datos);
                     $totalItems = count($items);
                     $page       = Input::get('page', 1);
                     $pagination =Paginator::make($datos[$page-1], $totalItems, $por_pagina );
                     //var_dump($pagination);
                    return View::make('ejecucion.inicio', compact('busqueda', "catalogo", "municipio", "status", "mensaje", 'items', 'pagination','por_pagina','datos','title','title_section','subtitle_section','propietario','clave','menor','mayor','municipios'));
                }
    }
    /**
     * Filtra y sanea cadenas de entrada de nombre para realizar la búsqueda
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