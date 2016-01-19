<?php

class WebServiceIretController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$title = "Consulta Iret.";
    //Título de sección:
    $title_section = "Consulta Volantes Iret";
    //Subtítulo de sección:
    $subtitle_section = "Volantes Iret";
		return View::make('WebServiceIret.index', compact('title', 'title_section', 'subtitle_section'));
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

		     $volante=Input::get('volante');
    $predios = sprintf("http://www.irettabasco.gob.mx:8080/volante/%s", $volante);
    try{
        $content = json_decode(file_get_contents($predios));
        $res = json_last_error();
        if($res == JSON_ERROR_NONE){
          //Al parecer todo está bien.
          return View::make('WebServiceIret.TablaWebService', compact('content'));
        }else{
          //Aquí el servidor aunque no contestó con un error 500 no nos mandó un objeto json.
          //Habría que responder con un mensaje al usuario, talvez otra plantilla diferente a WebServiceIret.TablaWebService ?
            echo '<div class="alert alert-danger">No existe registro para el numero de folio ingresado.</div>';
            exit;
        }
    }
    catch(Exception $e)
    {
      //Aquí deplano el servidor se indigestó y mando un error 500 o algun otro codigo de error
      //Habria tambien que indicarle al usuario de forma amable que lo que metió no arrojó ningun dato 
      //y por ningun motivo mostrarle el error de oracle que sale si se le mete una letra en lugar de un numero
        echo '<div class="alert alert-danger">Erro de respuesta del servidor.</div>';
        echo $e->getMessage();
    }
		/*$volante=Input::get('volante');
		$predios = sprintf("http://www.irettabasco.gob.mx:8080/volante/%s", $volante);
		try{
		$content = json_decode(file_get_contents($predios));
		return View::make('WebServiceIret.TablaWebService', compact('content'));
		}
		catch(Exception $e)
				{
					//dd($e);
					return Response::json(array(
							'result' => $e,						
							'succes' => 'succes'
						));
				}*/
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
