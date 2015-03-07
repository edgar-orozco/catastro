<?php

class Ejecucion_SeguimientobusController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	protected $por_pagina=10;
	public function getIndex()
	{
//captura de datos de buscar.blade.php
            $clave               = Input::get('clave');
            $string              = Input::get('nombre');
            // $this->por_pagina = Input::get('paginado');
            $this->por_pagina    = Input::get('paginado', $this->por_pagina);
            $propietario         = $this->sanear_string($string);
            //    $propietario   = strtoupper($propietario);
            $municipio           = Input::get('municipio');
        //--------------------------DATOS FALTANTES PARA LA CONSULTA-------------------------------------------
        //  $colonia= Input::get('colonia');
        //  $calle = Input::get('calle');
        //  $cp = Input::get('cp');
        // $estatus= Input::get('estatus');
        //  $date = Input::get('date');
            $resultado = DB::select("select sp_get_predios_status('$clave','$propietario','','')");
            	foreach ($resultado as $key)
            		{
            				$vale[] = explode(',', $key->sp_get_predios_status);
            	  }

            $catalogo = ejecutores::join('personas', 'ejecutores.id_p', '=', 'personas.id_p')//->lists('cargo', 'id_ejecutor');
            ->select('ejecutores.id_p AS id', 'personas.nombrec AS nombre')
            ->get();
            $municipio = Municipio::All();
            $status = status::All();
            $totalItems = count($resultado);
            if ($totalItems == 0)
            	{
			            $mensaje = 'No se encontraron coincidencias con los parametros de busqueda';
			            return View::make('ejecucion.inicio', compact('busqueda', "catalogo", "municipio", "status", "mensaje"));
            	}
            else
            	{
			            $paginator      = Paginator::make($vale, $totalItems, $this->por_pagina);
			            return View::make('ejecucion.seguimiento', compact('busqueda', "catalogo", "municipio", "status", "mensaje", 'vale', 'paginator'));
	            }
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


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update()
	{
            $id = Input::get('id');

           // return $id.'//'.$fecha.'//'.$ejecutor.'//'.$notificacion.'//'.$nombre.'//'.$identificacion.'//'.$clave.'//'.$observaciones;
            $datos=requerimientos::find($id);
            $datos->f_requerimiento = $fecha= Input::get('fechanotificacion');
            $datos->id_ejecutor = $ejecutor = Input::get('ejecutores');
            $datos->via_notificacion = $notificacion = Input::get('notificacion');
            $datos->nombre_persona_notificada = $nombre = Input::get('nombre');
            $datos->tipo_identificacion =  $identificacion = Input::get('identificacion');
            $datos->clave_identificacion = $clave = Input::get('clave');
            $datos->observaciones =  $observaciones = Input::get('observaciones');
            $datos->save();
        Session::flash('mensaje', 'El registro ha sido ingresado exitosamente');
        return Redirect::back();
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}
    public function modal( $idrequerimiento = null) 
    {
        $title = 'Crar nueva perosana';

        //Titulo de seccion:
        $title_section = "";

        //Subtitulo de seccion:
        $subtitle_section = "Crear nueva persona";
        //$format = 'html';
         $catalogo       = ejecutores::join('personas', 'ejecutores.id_p', '=', 'personas.id_p')//->lists('cargo', 'id_ejecutor');
            ->select('ejecutores.id_ejecutor AS id', 'personas.nombrec AS nombre')
            ->get();
         return  View::make('ejecucion.datos',compact('title','title_section','subtitle_section','idrequerimiento','catalogo'));

    }


}
