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
	$view = View::make('cartografia.consultas.form');

	return Response::make($view);


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
