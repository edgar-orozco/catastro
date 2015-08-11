<?php

class corevat_AvaluosZonaController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store() {
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id) {
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id) {
		$idavaluo = $id;
		$opt = 'zona';
		$rowA = Avaluos::find($id);
		$title = 'Características de la Zona: ' . $rowA['foliocoretemp'];
		$row = Avaluos::find($id)->AvaluosZona;
		if (count($row) <= 0) {
			AvaluosZona::insAvaluoZona($id);
			$row = Avaluos::find($id)->AvaluosZona;
		}
		$cat_clasificacion_zona = CatClasificacionZona::comboList();
		$cat_proximidad_urbana = CatProximidadUrbana::comboList();

		return View::make('Corevat.Avaluos.avaluos', compact('opt', 'idavaluo', 'idavaluozona', 'title', 'row', 'cat_clasificacion_zona', 'cat_proximidad_urbana'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id) {
		$inputs = Input::All();
		$rules = array(
			'nivel_equipamiento' => 'integer|min:0|max:100',
		);
		$messages = array(
			'nivel_equipamiento.integer' => '¡El campo "Nivel de Equipamiento" debe ser un entero positivo!',
			'nivel_equipamiento.min' => '¡El valor mínimo del campo "Nivel de Equipamiento" debe ser 0%!',
			'nivel_equipamiento.max' => '¡El valor máximo del campo "Nivel de Equipamiento" debe ser 100%!',
		);
		$validate = Validator::make($inputs, $rules, $messages);
		if ($validate->fails()) {
			return Redirect::back()->withInput()->withErrors($validate);
		} else {
			AvaluosZona::updAvaluosZona($id, $inputs);
			return Redirect::to('/corevat/AvaluoZona/' . $id)->with('success', '¡El registro fue modificado satisfactoriamente!');
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id) {
		//
	}

}
