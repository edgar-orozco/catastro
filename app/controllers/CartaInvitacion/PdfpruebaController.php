<?php

class CartaInvitacion_PdfpruebaController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function imprimir($clave = null)
	{	//recibe la clave catastral y la guarda en un array
		
		$id = ejecucion::where('clave',$clave)->pluck('id_ejecucion_fiscal');
	  $fecha = requerimientos::where('id_ejecucion_fiscal',$id)->first()->pluck('f_requerimiento');
		$claves[]=$clave;

		//se envia el array a la funcion para poder ser procesado y generar el pdf
		$fechaven = PdfHelper::imprimirpdf($claves, $fecha);
		//se imprime lo que retorna la funcion en este caso el pdf de la carta invitacion
		echo $fechaven;

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
