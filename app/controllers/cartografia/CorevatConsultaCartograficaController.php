<?php

class CorevatConsultaCartografica extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(){

        if(Auth::guest()) {
            return View::make('index');
        }

        $result = DB::select('SELECT municipio, nombre_municipio from municipios order by municipio');
    	$municipios = array();
	    foreach($result as $registro){
	        $municipios[$registro->municipio] = $registro->nombre_municipio;
	    }       

		return View::make('cartografia.CorevatConsultaCartografica') 
							    ->with ('municipios',$municipios);

	
	}


	public function getMapa(){
		
		// 003-0029-000014
        
        $ClaveCatastral = Input::get('ClaveCatastral');

        $avaluo = Avaluos::where('cuenta_catastral',$ClaveCatastral)->get();

        $predio = predios::where('clave_catas',$ClaveCatastral)->get();

        return $predio;

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
