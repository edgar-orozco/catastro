<?php

class ejecucion_cargaEjecucion_ajaxController extends \BaseController 
{

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

	public function index ()
	{

		$title = 'Modulo de ejecucion';

        //Título de sección:
        $title_section = "Modulo de ejecución.";

        //Subtítulo de sección:
        $subtitle_section = "Cargado de datos.";

        $catalogo = ejecutor::All();

		return View::make('ejecucion.cargaEjecucion.index', 
			compact('title', 'title_section', 'subtitle_section', 'catalogo'));
	}

	public function cargado ()
	{
		if(Request::ajax())
		{
	        if (Input::hasFile('file'))
			{
				$file = Input::file('file');
				$falla=array();
				$num = 0;
				$numF=0;
				$predios=array();

				foreach(file($file) as $line) 
				{
	    			$num = $num+1;
					$validator = Validator::make(
	    				array('name' => $line),
	    				array('name' => 'integer')
						);

	    			if ($validator->fails())
	    			{
	    				$falla[]='Error de sintaxis en la linea '.$num.' Formato no valido '.$line;
	    				$numF=$numF+1;
	    			}
	    			else  			
	    			{
	    				$consulta= Predios::find($line);
	    					if ($consulta) 
	    					{
	    						$predios[]= $consulta.'<br>';
	    					}
	    					else 
	    					{
	    						$falla[]='No existe ningun registro con la clave '.$line;

	    					}
	    			}
				}
				
			   
				return Response::json(array(
	            'predios' =>    $predios,
	            'fallas' =>		$falla,
	            'totalR' => 	$num,
	            'totalF' =>		$numF,
	            'descarga'=> 	""));
			
			}
	        //si la validación falla redirigimos al formulario de registro con los errores          
   		}


	}




}

