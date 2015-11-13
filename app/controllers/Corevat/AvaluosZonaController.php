<?php
use Carbon\Carbon;

class corevat_AvaluosZonaController extends \BaseController {

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
		$inputs["cobertura"] = (int) $inputs["cobertura"];
		$inputs["hidden_nivel_equipamiento"] = number_format((float) $inputs['hidden_nivel_equipamiento'], 2, '.', '');
		$inputs["updated_at"] = Carbon::now()->format('Y-m-d H:i:s');
		$inputs["construc_predominante"] = ($inputs["construc_predominante"]=='' ? '':substr($inputs["construc_predominante"], 0, 500));
		$inputs["vias_acceso_importante"] = ($inputs["vias_acceso_importante"]=='' ? '':substr($inputs["vias_acceso_importante"], 0, 500));
		$inputs["calles_transversales"] = ($inputs["calles_transversales"]=='' ? '':substr($inputs["calles_transversales"], 0, 500));
		AvaluosZona::updAvaluosZona($id, $inputs);
		return Redirect::to('/corevat/AvaluoZona/' . $id)->with('success', '¡El registro fue modificado satisfactoriamente!');
	}

}
