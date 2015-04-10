<?php

class CartaInvitacion_PdfpruebaController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function imprimir($clave = null)
	{

		$resultado = DB::select("select sp_get_datos_predio('$clave')");

		foreach ($resultado as $key)
            {
                $vales = explode(',', $key->sp_get_datos_predio);
            }
            //sacamos la clave del array y la limpiamos
						$clave  = str_replace('(', '',$vales[0]);
							//sacamos el nomrbe del array y la limpiamos
						$nombre = str_replace('"', '',$vales[1]);

						 //$municipio = str_replace('"', '',$vales[2]);
						 //obtenemos id del municipio
						$id_mun =substr($clave, 3, 3);
						//obtenemos el nombre del municipio
						$mun_actual    =Municipio::where('municipio',$id_mun)->pluck('nombre_municipio');
						//obtenemos el git del municipio
						$gid    =Municipio::where('municipio',$id_mun)->pluck('gid');
						//obtenemos la configuracion del municipio
						$configutacion = configuracionMunicipal::where('municipio',$gid)->take(1)->get();
					//print_r($configutacion);

						$id_ejecucion=ejecucion::where('clave',$clave)->pluck('id_ejecucion_fiscal');
					 // $fecha=requerimientos::where('id_ejecucion_fiscal',$id_ejecucion)->pluck('f_requerimiento');
					 // obtenemos la fecha actual
					 $fecha=date("Y-m-d");
					 //array de fecha y nombre para el pdf
         $vale[] = array('0' =>str_replace('(', '',$vales[0]), '1' => str_replace('"', '',$vales[1]));
         //print_r($vale);
          //  $id_mun =substr($mun, 3, 3);
          //  $gid    =Municipio::where('municipio',$id_mun)->pluck('gid');
					  			//--$vista = View::make('CartaInvitacion.carta', compact('data', 'fecha', 'nombre_eje', '--mun_actual','--vale'));
									$vista    = View::make('CartaInvitacion.carta', compact('gid','vale','fecha', 'clave','nombre','mun_actual','configutacion'));
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
