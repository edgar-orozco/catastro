<?php

class CartaInvitacion_PdfpruebaController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function imprimir($clave = null)
	{
		$resultado = DB::select("select sp_get_predios('$clave','','','','','','','','','')");
		//print_r($resultado);
		foreach ($resultado as $key)
            {
                $items = explode(',', $key->sp_get_predios);
            }
           // print_r($items);
						$clave  = str_replace('(', '',$items[0]);
						$nombre = str_replace('"', '',$items[1]);
						$municipio = str_replace('"', '',$items[2]);
						$id_mun =substr($clave, 3, 3);

						$gid    =Municipio::where('municipio',$id_mun)->pluck('gid');
						$configutacion = configuracionMunicipal::where('municipio',$gid)->take(1)->get();
					//print_r($configutacion);

						$id_ejecucion=ejecucion::where('clave',$clave)->pluck('id_ejecucion_fiscal');
						$fecha=requerimientos::where('id_ejecucion_fiscal',$id_ejecucion)->pluck('f_requerimiento');


									$vista    = View::make('CartaInvitacion.carta2', compact('git','items','fecha', 'clave','nombre','municipio','configutacion'));
									$pdf      = PDF::load($vista)->show("Copia-CartaInvitacion");
									$response = Response::make($pdf, 200);
									$response->header('Content-Type', 'application/pdf');
									return $response;

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
