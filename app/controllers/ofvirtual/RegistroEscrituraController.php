<?php

class ofvirtual_RegistroEscrituraController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		  //
        $title = 'Listas de Registro de Escritura';

        //Título de sección:
        $title_section = "Listado de de Registros de Escritura. ";

        //Subtítulo de sección:
        $subtitle_section = "Crear, modificar, buscar, imprimir.";


        $registros = RegistroEscrituras::all();

        $misMunicipios = Auth::user()->municipios()->get(['gid']);

        $aMisMunicipios = array();
        foreach ($misMunicipios as $mun) {
            $aMisMunicipios[] = $mun->gid;
        }

        if (empty($aMisMunicipios)) {
            $municipios = Municipio::orderBy('nombre_municipio')->get();
        } else {
            $municipios = Municipio::whereIn('gid', $aMisMunicipios)->orderBy('nombre_municipio')->get();
        }
		$municipio = Municipio::orderBy('nombre_municipio', 'ASC')->lists('nombre_municipio', 'municipio');

        return View:: make('ofvirtual.notario.registro.index', compact('title', 'title_section', 'subtitle_section', 'traslados', 'municipios','registros'));

	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$title = "Captura de datos";
		 //Título de sección:
        $title_section = "Captura de datos. ";

        

	 $municipios = Municipio::orderBy('nombre_municipio', 'ASC')->lists('nombre_municipio', 'municipio');
		 return View::make('ofvirtual.notario.registro._form',compact('municipios','title',  'title_section', 'subtitle_section'));
       /*     compact('title', 'title_section','subtitle_section', 'inpc', 'inpcs', 'mes', 'anio'));
		  $persona = new personas();
			$persona->fill(Input::get('persona'))->save();
			Session::flash('mensaje', 'El registro ha sido ingresado exitosamente');
      return Response::json(array
        (
          'valor' => 'exito'
        ));*/

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
