<?php

class ConsultaMzPredio extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
/**
*	public function index()
*	{
*	$predios = Predio::all();
*		return View::make('cartografia.consultas.index') -> with ('predios',$predios);
*	}
*/

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function index()
	{
	   
    $result = DB::select('SELECT municipio, nombre_municipio from municipios order by municipio');
    
    $municipios = array();

    foreach($result as $registro){
        $municipios[$registro->municipio] = $registro->nombre_municipio;
    }       
       
	//$view = View::make('cartografia.consultas.form') ;

	return View::make('cartografia.consultas.form') 
							    ->with ('municipios',$municipios);
                                	//return Response::make($view)->compact('municipios');


	}
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
		$script_name = "DGCEF-Map.php";

		return View::make('cartografia.consultas.form');


	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */

	public function show()
	{

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
