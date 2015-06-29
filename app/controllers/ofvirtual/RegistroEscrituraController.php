<?php

class ofvirtual_RegistroEscrituraController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		$llave = Input::get('tipo');
		$title = "Captura de personas";
		//echo "hola mundo de macros, valor recibido: ".$tipo;
		return View::make('macros.personasMac', compact('tipo', 'title'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
	/*	$datos = Input::all();
		$token   = $datos['_token'];
    $opcion  = $datos['opcion'];
    $boton   = $datos['boton'];

    unset($datos['opcion']);
    unset($datos['boton']);
    unset($datos['_token']);

  //  foreach($datos as $cla )
       // {
        	 echo $datos['persona']['nombres'];
        	 echo $datos['persona']['apellido_paterno'];
        	 echo $datos['persona']['curp'];
        	 echo $datos['persona']['RFC'];
      //  }
      //  
      //  
      //  */
      $persona = new personas();
			$persona->fill(Input::get('persona'))->save();
			 Session::flash('mensaje', 'El registro ha sido ingresado exitosamente');



        return Response::json(array
                    (
                    'valor' => 'exito'
        ));

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
