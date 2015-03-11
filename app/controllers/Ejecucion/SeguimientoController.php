<?php

class Ejecucion_SeguimientoController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		$title = "Seguimiento De Proceso.";

        //Título de sección:
        $title_section = "Seguimiento De Proceso";

        //Subtítulo de sección:
        $subtitle_section = "Ejecucion Fiscal.";
				$catalogo  = ejecutores::All();//->lists('cargo', 'id_ejecutor');
				$municipio = Municipio::All();
				$status    = status::All();
				$mensaje   ='';
				return View::make('ejecucion.seguimiento', compact("catalogo","municipio","status","mensaje",'title','title_section','subtitle_section'));
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
