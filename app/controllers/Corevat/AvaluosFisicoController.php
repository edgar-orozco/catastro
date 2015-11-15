<?php
use Carbon\Carbon;

class corevat_AvaluosFisicoController extends \BaseController {

	/**
	 * Show the form for editing the specified resource.
	 * GET /avaluosfisico/{id}/edit
	 *
	 * @param  int  $idavaluo
	 * @return Response
	 */
	public function edit($idavaluo) {
		$rowAvaluos = Avaluos::find($idavaluo);

		if ( $rowAvaluos->estatus ) {
			return Redirect::to('/corevat/Avaluos')->with('error', '¡El avalúo ya fue registrado!');
		} else {
			$opt = 'fisico';
			$title = 'Enfoque de Físico: ' . $rowAvaluos['foliocoretemp'];

			$row = Avaluos::find($idavaluo)->AvaluosFisico;
			if ( !$row->idavaluo ) {
				AvaluosFisico::insAvaluoFisico($idavaluo);
				$row = Avaluos::find($idavaluo)->AvaluosFisico;
			}

			$AvaluoInmueble = AvaluosInmueble::where('idavaluo', '=', $idavaluo)->first();
			$superficie_total_terreno = number_format($AvaluoInmueble->superficie_total_terreno, 2, '.', ',');
			$indiviso_terreno = number_format($AvaluoInmueble-> indiviso_terreno, 2, '.', ',');

			$cat_clase_general_inmueble = CatClaseGeneralInmueble::comboList();
			$cat_tipo_inmueble = CatTipoInmueble::comboList();
			$cat_estado_conservacion = CatEstadoConservacion::comboList();
			$cat_calidad_proyecto = CatCalidadProyecto::comboList();

			$cat_factores_frente = CatFactoresFrente::orderBy('valor_factor_frente')->where('status_factor_frente', '=', '1')->get();
			$cat_factores_forma = CatFactoresForma::orderBy('valor_factor_forma')->where('status_factor_forma', '=', '1')->get();
			$cat_factores_conservacion = CatFactoresConservacion::orderBy('valor_factor_conservacion')->where('status_factor_conservacion', '=', '1')->get();
			$cat_factores_top = CatFactoresConservacion::orderBy('valor_factor_conservacion')->where('status_factor_conservacion', '=', '1')->get();
			$cat_tipo = CatTipo::orderBy('tipo')->where('status_tipo', '=', '1')->get();
			$cat_obras_complementarias = CatObrasComplementarias::orderBy('obra_complementaria')->where('status_obra_complementaria', '=', '1')->get();
		
			return View::make('Corevat.Avaluos.avaluos', compact('opt', 'idavaluo', 'title', 'row', 'cat_clase_general_inmueble', 
				'cat_tipo_inmueble', 'cat_estado_conservacion', 'cat_calidad_proyecto', 'cat_factores_frente', 
				'cat_factores_forma', 'cat_factores_conservacion', 'cat_factores_top', 'cat_tipo', 'cat_obras_complementarias',
				'superficie_total_terreno', 'indiviso_terreno'));
		}
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /avaluosfisico/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id) {
		$inputs = Input::All();
		$inputs["edad_construccion"] = (int) $inputs["edad_construccion"];
		$inputs["vida_util"] = (int) $inputs["vida_util"];
		$rules = array(
			'edad_construccion' => 'min:0|max:999|regex:/^[0-9]{1,3}$/',
			'vida_util' => 'min:0|max:999|regex:/^[0-9]{1,3}$/',
		);
		$messages = array(
			'edad_construccion.numeric' => '¡El campo "Edad de la Construcción (Años)" debe ser un número!',
			'edad_construccion.min' => '¡El valor mínimo del campo "Edad de la Construcción (Años)" debe ser cero!',
			'edad_construccion.max' => '¡El valor máximo del campo "Edad de la Construcción (Años)" debe ser 999.99!',
			'edad_construccion.regex' => '¡El formato del campo "Edad de la Construcción (Años)" debe ser 999.99!',
			
			'vida_util.numeric' => '¡El campo "Vida Útil Remanente" debe ser un número!',
			'vida_util.min' => '¡El valor mínimo del campo "Vida Útil Remanente" debe ser cero!',
			'vida_util.max' => '¡El valor máximo del campo "Vida Útil Remanente" debe ser 999.99!',
			'vida_util.regex' => '¡El formato del campo "Vida Útil Remanente" debe ser 999.99!',
		);
		$validate = Validator::make($inputs, $rules, $messages);
		if ($validate->fails()) {
			return Redirect::back()->withInput()->withErrors($validate);
		} else {
			AvaluosFisico::updAvaluoFisico($id, $inputs);
			return Redirect::to('/corevat/AvaluoEnfoqueFisico/' . $id)->with('success', '¡El registro fue modificado satisfactoriamente!');
		}
	}

}
