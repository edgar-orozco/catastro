<?php
use Carbon\Carbon;

class corevat_AvaluosInmuebleController extends \BaseController {

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id) {
		$idavaluo = $id;
		$opt = 'inmueble';
		$row = Avaluos::find($id);
		$title = 'Características del Inmueble: ' . $row['foliocoretemp'];
		$row = Avaluos::find($id)->AvaluosInmueble;
		$cat_cimentaciones = CatCimentaciones::comboList();
		$cat_estructuras = CatEstructuras::comboList();
		$cat_muros = CatMuros::comboList();
		$cat_entrepisos = CatEntrepisos::comboList();
		$cat_techos = CatTechos::comboList();
		$cat_bardas = CatBardas::comboList();
		$cat_usos_suelos = CatUsosSuelos::comboList();
		$cat_niveles = CatNiveles::comboList();

		$cat_pisos = CatPisos::comboList();
		$cat_aplanados = CatAplanados::comboList();
		$cat_plafones = CatPlafones::comboList();
		$cat_orientaciones = CatOrientaciones::comboList();

		$croquis = $row->croquis != '' ? '/corevat/files/' . $row->croquis : '';
		$fachada = $row->fachada != '' ? '/corevat/files/' . $row->fachada : '';

		$arrMedCol = array('Metros' => 'Metros', 'Metros Cuadrados' => 'Metros Cuadrados', 'Metros Cúbicos' => 'Metros Cúbicos', 'Metros Lineales' => 'Metros Lineales', 'Kilometros' => 'Kilometros', 'Kilometros Cuadrados' => 'Kilometros Cuadrados', 'Hectareas' => 'Hectareas', 'Hectareas Cuadradas' => 'Hectareas Cuadradas');

		return View::make('Corevat.Avaluos.avaluos', compact('opt', 'idavaluo', 'title', 'row', 'cat_cimentaciones', 'cat_estructuras', 'cat_muros', 'cat_entrepisos', 'cat_techos', 'cat_bardas', 'cat_usos_suelos', 'cat_niveles', 'cat_pisos', 'cat_aplanados', 'cat_plafones', 'cat_orientaciones', 'arrMedCol', 'croquis', 'fachada'));
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
			'unidades_rentables_escritura' => 'integer|min:0|max:9999',
			'superficie_total_terreno' => 'numeric|min:0.0001|max:9999999999.9999',
			'indiviso_terreno' => 'numeric|min:0|max:100.0000',
			'superficie_terreno' => 'numeric|min:0.0001|max:9999999999.9999',
			'indiviso_areas_comunes' => 'numeric|min:0|max:100.0000',
			'superficie_construccion' => 'numeric|min:0|max:9999999999.9999',
			'indiviso_accesoria' => 'numeric|min:0|max:9999999999.9999',
			'superficie_escritura' => 'numeric|min:0|max:9999999999.9999',
			'superficie_vendible' => 'numeric|min:0|max:9999999999.9999',
		);
		$messages = array(
			'unidades_rentables_escritura.integer' => '¡El campo "Unidades Rentables en la misma Estructura" debe ser un entero positivo!',
			'unidades_rentables_escritura.min' => '¡El valor mínimo del campo "Unidades Rentables en la misma Estructura" debe ser cero!',
			'unidades_rentables_escritura.max' => '¡El valor máximo del campo "Unidades Rentables en la misma Estructura" debe ser 9999!',
			
			'superficie_total_terreno.numeric' => '¡El campo "Superficie Total del Terreno" debe ser un número!',
			'superficie_total_terreno.min' => '¡El valor mínimo del campo "Superficie Total del Terreno" debe ser mayor a cero!',
			'superficie_total_terreno.max' => '¡El valor máximo del campo "Superficie Total del Terreno" debe ser 9999999999.9999!',
			
			'indiviso_terreno.numeric' => '¡El campo "Indiviso del Terreno (%)" debe ser un número!',
			'indiviso_terreno.min' => '¡El valor mínimo del campo "Indiviso del Terreno (%)" debe ser mayor cero!',
			'indiviso_terreno.max' => '¡El valor máximo del campo "Indiviso del Terreno (%)" debe ser 100.0000!',
			
			'superficie_terreno.numeric' => '¡El campo "Superfice del Terreno" debe ser un número!',
			'superficie_terreno.min' => '¡El valor mínimo del campo "Superfice del Terreno" debe ser mayor cero!',
			'superficie_terreno.max' => '¡El valor máximo del campo "Superfice del Terreno" debe ser 9999999999.9999!',
			
			'indiviso_areas_comunes.numeric' => '¡El campo "Indiviso de Áreas Comunes (%)" debe ser un número!',
			'indiviso_areas_comunes.min' => '¡El valor mínimo del campo "Indiviso de Áreas Comunes (%)" debe ser mayor o igual a cero!',
			'indiviso_areas_comunes.max' => '¡El valor máximo del campo "Indiviso de Áreas Comunes (%)" debe ser 100.0000!',
			
			'superficie_construccion.numeric' => '¡El campo "Superficie de Construcción" debe ser un número!',
			'superficie_construccion.min' => '¡El valor mínimo del campo "Superficie de Construcción" debe ser mayor o igual cero!',
			'superficie_construccion.max' => '¡El valor máximo del campo "Superficie de Construcción" debe ser 9999999999.9999!',
			
			'indiviso_accesoria.numeric' => '¡El campo "Edad de la Construcción (años)" debe ser un número!',
			'indiviso_accesoria.min' => '¡El valor mínimo del campo "Edad de la Construcción (años)" debe ser mayor o igual cero!',
			'indiviso_accesoria.max' => '¡El valor máximo del campo "Edad de la Construcción (años)" debe ser 9999999999.9999!',
			
			'superficie_escritura.numeric' => '¡El campo "Superficie Asentada en Escritura" debe ser un número!',
			'superficie_escritura.min' => '¡El valor mínimo del campo "Superficie Asentada en Escritura" debe ser mayor o igual cero!',
			'superficie_escritura.max' => '¡El valor máximo del campo "Superficie Asentada en Escritura" debe ser 9999999999.9999!',
			
			'superficie_vendible.numeric' => '¡El campo "Superficie Vendible" debe ser un número!',
			'superficie_vendible.min' => '¡El valor mínimo del campo "Superficie Vendible" debe ser mayor o igual cero!',
			'superficie_vendible.max' => '¡El valor máximo del campo "Superficie Vendible" debe ser 9999999999.9999!',
			'superficie_vendible.regex' => '¡El formato del campo "Superficie Vendible" debe ser 9999999999.9999!',
			
		);
		$validate = Validator::make($inputs, $rules, $messages);
		if ($validate->fails()) {
			return Redirect::back()->withInput()->withErrors($validate);
		} else {
			$inputs["updated_at"] = Carbon::now()->format('Y-m-d H:i:s');
			AvaluosInmueble::updAvaluosInmueble($id, $inputs);
			$message = '¡El registro fue modificado satisfactoriamente!';
			if (Input::hasFile('croquis') || Input::hasFile('fachada')) {
				$row = Avaluos::find($id)->AvaluosInmueble;
				if (Input::hasFile('croquis')) {
					$row->croquis = 'croquis-' . $row->idavaluo . '.' . Input::file('croquis')->guessExtension();
					Input::file('croquis')->move(public_path() . '/corevat/files/', $row->croquis);
					$message .= '<br />¡El croquis fue actualizado satisfactoriamente!';
				}
				if (Input::hasFile('fachada')) {
					$row->fachada = 'fachada-' . $row->idavaluo  . '.' .  Input::file('fachada')->guessExtension();
					Input::file('fachada')->move(public_path() . '/corevat/files/', $row->fachada);
					$message .= '<br />¡La imagen de la fachada fue actualizada satisfactoriamente!';
				}
				$row->save();
			}
			return Redirect::to('/corevat/AvaluoInmueble/' . $id)->with('success', $message);
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


	public function getFieldAutoCompleteInmueble() {
		
	}

}
