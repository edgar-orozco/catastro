<?php

class Cajas_CajasController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('cajas.apertura_caja');
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$ordenes = [
					'0'=>	[
								'id' => '1',
								'no_orden' => '00001',
								'nombre' => 'Don Molestar',
								'monto' => '356.00',
								'municipio' => 'centro',
								'status' => '1'
							],
					'1'=>	[
								'id' => '2',
								'no_orden' => '00002',
								'nombre' => 'Enrique segoviano',
								'monto' => '234.00',
								'municipio' => 'Centla',
								'status' => '0'								
							],
					'2'=>	[
								'id' => '3',
								'no_orden' => '00003',
								'nombre' => 'Roberto Gomez Bolaños',
								'monto' => '165.00',
								'municipio' => 'Paraiso',
								'status' => '1'								
							]							
				];
		return View::make('cajas._list', compact('ordenes'));
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
		$ordenes = [
					'0'=>	[
								'id' => '1',
								'no_orden' => '00001',
								'nombre' => 'Don Molestar',
								'monto' => '356.00',
								'municipio' => 'centro',
								'status' => '1'
							],
					'1'=>	[
								'id' => '2',
								'no_orden' => '00002',
								'nombre' => 'Enrique segoviano',
								'monto' => '234.00',
								'municipio' => 'Centla',
								'status' => '0'								
							],
					'2'=>	[
								'id' => '3',
								'no_orden' => '00003',
								'nombre' => 'Roberto Gomez Bolaños',
								'monto' => '165.00',
								'municipio' => 'Paraiso',
								'status' => '1'								
							]							
				];
		$orden = $ordenes[$id];

		return View::make('cajas.edit', compact('orden'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$ordenes = [
					'0'=>	[
								'id' => '1',
								'no_orden' => '00001',
								'nombre' => 'Don Molestar',
								'monto' => '356.00',
								'municipio' => 'centro',
								'status' => '1'
							],
					'1'=>	[
								'id' => '2',
								'no_orden' => '00002',
								'nombre' => 'Enrique segoviano',
								'monto' => '234.00',
								'municipio' => 'Centla',
								'status' => '0'								
							],
					'2'=>	[
								'id' => '3',
								'no_orden' => '00003',
								'nombre' => 'Roberto Gomez Bolaños',
								'monto' => '165.00',
								'municipio' => 'Paraiso',
								'status' => '1'								
							]							
				];
		return View::make('cajas._list', compact('ordenes'));
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

	public function cierre()
	{
		return View::make('cajas.cierre');
	}

	public function cierrePdf()
	{
		$ordenes = [
					'0'=>	[
								'id' => '1',
								'no_orden' => '00001',
								'nombre' => 'Don Molestar',
								'monto' => '356.00',
								'municipio' => 'centro',
								'status' => '1'
							],
					'1'=>	[
								'id' => '2',
								'no_orden' => '00002',
								'nombre' => 'Enrique segoviano',
								'monto' => '234.00',
								'municipio' => 'Centla',
								'status' => '0'								
							],
					'2'=>	[
								'id' => '3',
								'no_orden' => '00003',
								'nombre' => 'Roberto Gomez Bolaños',
								'monto' => '165.00',
								'municipio' => 'Paraiso',
								'status' => '1'								
							]							
				];
		$vista= View::make('cajas.cierrePdf', compact('ordenes'));	

		$pdf = PDF::load($vista)->show();
		//load(variable, tamaño de hoja, orientacion landscape)
		$response = Response::make($pdf, 200);
		$response->header('Content-Type', 'application/pdf');
		return $response;
	}


}
