<?php

class ejecucion_cargaEjecucion_CargaEjecucionController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

	

	public function index()
	{      
        $title = 'Modulo de ejecucion';
        //Título de sección:
        $title_section = "Modulo de ejecución.";
        //Subtítulo de sección:
        $subtitle_section = "Cargado de datos.";

        $catalogo = ejecutores::All();

		return View::make('ejecucion.cargaEjecucion.index', 
			compact('title', 'title_section', 'subtitle_section', 'catalogo'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		
	}
	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		if(Request::ajax())
		{
	        if (Input::hasFile('file'))
			{
				$file = Input::file('file');
				$fallaV=array();
				$fallaR=array();
				$num = 0;
				$numF=0;
				$predios=array();
				$numNE=0;

				foreach(file($file) as $line) 
				{
	    			$num = $num+1;
					$validator = Validator::make
					(
	    				array('name' => $line),
	    				array('name' => 'integer'),
	    				array('name' => 'required')
					);

	    			if ($validator->fails())
	    			{
	    				$fallaV[]='Error de sintaxis en la linea '.$num.' Formato no valido '.$line;
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
	    						$fallaR[]='No existe ningun registro con la clave '.$line;
	    						$numNE=$numNE+1;
	    					}
	    			}
				}
				return Response::json(array(
	            'predios' =>    $predios,
	            'fallasR' =>	$fallaR,
	            'fallasV' =>	$fallaV,
	            'totalR' => 	$num,
	            'totalFV' =>	$numF,
	            'totalNE' =>	$numNE,
	            'descarga'=> 	""));
			}//si la validación falla redirigimos al formulario de registro con los errores          
   		}	
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
	public function update($id)
	{
		//
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

	


}
