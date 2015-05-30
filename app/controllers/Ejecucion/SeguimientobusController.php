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
        $title = "Seguimiento De Proceso.";

        //Título de sección:
        $title_section = "Seguimiento De Proceso";

        //Subtítulo de sección:
        $subtitle_section = "Ejecucion Fiscal.";
//captura de datos de buscar.blade.php
            $page                = Input::get('page');
            $clave               = Input::get('clave');
            $string              = Input::get('nombre');
            $por_pagina          = Input::get('paginado',10);
            $propietario         = $this->sanear_string($string);
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
                        $items[]  = explode(',', $key->sp_get_predios_status);
                    }
            /**
             * [$catalogo description]
             * @var [type]
             */
            $catalogo = ejecutores::join('personas', 'ejecutores.id_p', '=', 'personas.id_p')//->lists('cargo', 'id_ejecutor');
            ->select('ejecutores.id_p AS id', 'personas.nombrec AS nombre')
            ->get();
            /**
             * [$municipio description]
             * @var [type]
             */
            $municipio = Municipio::All();
            /**
             * [$status description]
             * @var [type]
             */
            $status = status::All();
            /**
             * [$totalItems description]
             * @var [type]
             */
            $totaldatos = count($resultado);
            if ($totaldatos == 0)
            	{
			            $mensaje = 'No se encontraron coincidencias con los parametros de busqueda';
			            return View::make('ejecucion.seguimiento', compact('busqueda', "catalogo", "municipio", "status", "mensaje",'title','title_section','subtitle_section'));
            	}
            else
            	{
                     $datos      = array_chunk($items, $por_pagina);
                     $totaldatos =count($datos);
                     $totalItems = count($items);
                     $page       = Input::get('page', 1);
                     $pagination =Paginator::make($datos[$page-1], $totalItems, $por_pagina );
			            return View::make('ejecucion.seguimiento', compact('busqueda', "catalogo", "municipio", "status", "mensaje", 'items', 'pagination','title','title_section','subtitle_section'));
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
                "."),
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
	public function validar()
	{
		$fecha = Input::get('fecha');
          return Response::json(array
                (
                    'fecha' => $fecha
                ));
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
            $datos->f_notificacion = $fecha= Input::get('date');
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
        $fechas1 = requerimientos::where('id_requerimiento', $idrequerimiento)->pluck('f_requerimiento');
        $fechas = date ( 'Y-m-d' , strtotime ( $fechas1 ));
        //$fechas = date_format($fechas, 'd/m/Y');
         $catalogo       = ejecutores::join('personas', 'ejecutores.id_p', '=', 'personas.id_p')//->lists('cargo', 'id_ejecutor');
            ->select('ejecutores.id_ejecutor AS id', 'personas.nombrec AS nombre')
            ->get();

       return  View::make('ejecucion.datos',compact('title','title_section','subtitle_section','idrequerimiento','catalogo', 'fechas'));

    }
    public function cancelar( $idrequerimiento = null)
    {
        $title = 'Cancelar Proceso';

        //Titulo de seccion:
        $title_section = "";

        //Subtitulo de seccion:
        $subtitle_section = "Cancelar Proceso'";
        //$format = 'html';
         $catalogo       = ejecutores::join('personas', 'ejecutores.id_p', '=', 'personas.id_p')//->lists('cargo', 'id_ejecutor');
            ->select('ejecutores.id_ejecutor AS id', 'personas.nombrec AS nombre')
            ->get();
         return  View::make('ejecucion.cancelar',compact('title','title_section','subtitle_section','idrequerimiento','catalogo'));

    }
    //script para cancelacion de proceso
    public function guardarcancelacion()
    {
            $usuario = Auth::user()->id;
            $fecha_server=date('Y-m-d');
            $id = Input::get('id');
            $ide = requerimientos::where('id_requerimiento', $id)->pluck('id_ejecucion_fiscal');
          //  $fecha= Input::get('fechacancelacion');
          //   $motivo = Input::get('motivo');
          //   $ejecutor = Input::get('ejecutores');

          //  return $id.'//'.$fecha.'//'.$motivo.'//'.$ejecutor;
            $datos=ejecucion::find($ide);
            $datos->cve_status='XC';
            $datos->f_cancelacion = $fecha= Input::get('date');
            $datos->motivo_cancelacion = $motivo = Input::get('motivo');
            $datos->id_ejecutor_cancelacion = $ejecutor = Input::get('ejecutores');
            $datos->save();

            $cancelacion= new requerimientos;
            $cancelacion->id_ejecucion_fiscal=$ide;
            $cancelacion->cve_status='XC';
            $cancelacion->f_requerimiento=$fecha;
            $cancelacion->usuario=$usuario;
            $cancelacion->f_alta=$fecha_server;
            $cancelacion->save();

        Session::flash('mensaje', 'El se cancelo correctamente');
        return Redirect::back();
    }

      public function proceso( $idrequerimiento = null)
    {
        $title = 'Crar nueva perosana';

        //Titulo de seccion:
        $title_section = "";

        //Subtitulo de seccion:
        $subtitle_section = "Crear nueva persona";
        //$format = 'html';
        $fechas1 = requerimientos::where('id_requerimiento', $idrequerimiento)->pluck('f_requerimiento');
        $fechas = date ( 'Y-m-d' , strtotime ( $fechas1 ));
        //$fechas = date_format($fechas, 'd/m/Y');
         $catalogo       = ejecutores::join('personas', 'ejecutores.id_p', '=', 'personas.id_p')//->lists('cargo', 'id_ejecutor');
            ->select('ejecutores.id_ejecutor AS id', 'personas.nombrec AS nombre')
            ->get();

       return  View::make('ejecucion.proceso',compact('title','title_section','subtitle_section','idrequerimiento','catalogo', 'fechas'));

    }
    /**
     * crea modal para requerimeinto
     * @param  string $idrequerimiento [description]
     * @return [type]                  [description]
     */
     public function requerimiento($idrequerimiento=null)
    {
         $title = 'Crar nueva perosana';

        //Titulo de seccion:
        $title_section = "";

        //Subtitulo de seccion:
        $subtitle_section = "Crear nueva persona";
        //$format = 'html';
        $fechas1 = requerimientos::where('id_requerimiento', $idrequerimiento)->pluck('f_requerimiento');
        $fechas = date ( 'Y-m-d' , strtotime ( $fechas1 ));
        //$fechas = date_format($fechas, 'd/m/Y');
         $catalogo       = ejecutores::join('personas', 'ejecutores.id_p', '=', 'personas.id_p')//->lists('cargo', 'id_ejecutor');
            ->select('ejecutores.id_ejecutor AS id', 'personas.nombrec AS nombre')
            ->get();

       return  View::make('ejecucion.requerimiento',compact('title','title_section','subtitle_section','idrequerimiento','catalogo', 'fechas'));


    }
     public function update_proceso($control=1)
    {

        $id=Input::get('id');
        $ide = requerimientos::where('id_requerimiento', $id)->pluck('id_ejecucion_fiscal');
        $total= requerimientos::where('id_ejecucion_fiscal', $ide)->get();

        if( count($total) < 2)
            {
                    $datos=ejecucion::find($ide);
                    $datos->cve_status='RC';
                    $datos->save();


                    $proceso= new requerimientos;
                    $proceso->id_ejecucion_fiscal=$ide;
                    $proceso->cve_status='RC';
                    $proceso->f_requerimiento=Input::get('date');
                    $proceso->usuario=Auth::user()->id;
                    $proceso->f_alta=date('Y-m-d');
                    $proceso->save();
            }
                 if($control==1)
                    {
                        $vista = View::make('CartaInvitacion.creditofiscal');
                        $pdf = PDF::load($vista)->show("credito");
                        $response = Response::make($pdf, 2000);
                        $response->header('Content-Type', 'application/pdf');
                        return $response;
                    }
            Session::flash('mensaje', 'El proceso ha sido hactualizado');
            return Redirect::back();
    }
     public function update_requerimiento($control=1)
    {

        $id=Input::get('id');
        $ide = requerimientos::where('id_requerimiento', $id)->pluck('id_ejecucion_fiscal');
        $total= requerimientos::where('id_ejecucion_fiscal', $ide)->get();

        if( count($total) < 3)
            {
                    $datos=ejecucion::find($ide);
                    $datos->cve_status='DC';
                    $datos->save();


                    $proceso= new requerimientos;
                    $proceso->id_ejecucion_fiscal=$ide;
                    $proceso->cve_status='DC';
                    $proceso->f_requerimiento=Input::get('date');
                    $proceso->usuario=Auth::user()->id;
                    $proceso->f_alta=date('Y-m-d');
                    $proceso->save();
            }
                 if($control==1)
                    { 
                        $fecha=date('Y-m-j');
                        $vista = View::make('CartaInvitacion.mandamientoejecucion',compact('fecha'));
                        $pdf = PDF::load($vista)->show("credito");
                        $response = Response::make($pdf, 2000);
                        $response->header('Content-Type', 'application/pdf');
                        return $response;
                    }
            Session::flash('mensaje', 'El proceso ha sido hactualizado');
            return Redirect::back();
    }
    public function procesorc()
    {
         $vista = View::make('CartaInvitacion.creditofiscal');
                        $pdf = PDF::load($vista)->show("credito");
                        $response = Response::make($pdf, 2000);
                        $response->header('Content-Type', 'application/pdf');
                        return $response;
    }



}
