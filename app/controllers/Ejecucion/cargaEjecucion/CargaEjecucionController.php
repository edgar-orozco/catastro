<?php

class ejecucion_cargaEjecucion_CargaEjecucionController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

	

	public function index()
	{      
        $title = 'Carta invitación masiva';
        //Título de sección:
        $title_section = "Carta invitación masiva";
        //Subtítulo de sección:
        $subtitle_section = "";

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
	    			$digitos = explode("-", $line);
	    			
					$validator = Validator::make
					(
	    				array
	    				(
	    					'est' 	=> trim($digitos[0]),
	    					'mun' 	=> trim($digitos[1]),
	    					'zon' 	=> trim($digitos[2]),
	    					'dig1' 	=> trim($digitos[3]),
	    					'dig2' 	=> trim($digitos[4])
	    				),
	    				array
	    				(
	    					'est' 	=> 'digits:2',
	    					'mun' 	=> 'digits:3',
	    					'zon' 	=> 'digits:3',
	    					'dig1' 	=> 'digits:4',
	    					'dig2' 	=> 'digits:6' 
	    				)
	    				
					);
					
	    			if ($validator->fails())
	    			{
	    				$fallaV[]='Error de sintaxis en la linea '.$num.' Formato no valido '.$line;
	    				$numF=$numF+1;
	    			}
	    			elseif (strcmp($digitos[0], '27') !== 0)  
	    			{
	    				$fallaV[]='Error de sintaxis en la linea '.$num.' Numero de estado no valido '.$line;
	    				$numF=$numF+1;		
	    			}
	    			else  			
	    			{                                        
	    				$consulta2=PadronFiscal::where('clave','=',trim($line))->count();
	    				
	    					if ($consulta2 > 0) 
	    					{   						
	    						$fallaR[]='Se encontro el registro '.$line;
	    						$numNE=$numNE+1;
	    				
	    					}
	    					else 
	    					{
	    						$fallaR[]='No existe ningun registro con la clave '.$line;
	    						$numNE=$numNE+1;
	    					}
	    			$consulta2 = 0;
                                                
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
