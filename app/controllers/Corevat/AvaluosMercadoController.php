<?php

Carbon\Carbon;

class corevat_AvaluosMercadoController extends \BaseController {

	/**
	 * Show the form for editing the specified resource.
	 * GET /avaluosmercado/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id) {
		$idavaluo = $id;
		$opt = 'mercado';
		$rowAvaluos = Avaluos::find($id);
		$title = 'Enfoque de Mercado: ' . $rowAvaluos['foliocoretemp'];
		$row = Avaluos::find($id)->AvaluosMercado;
		if (count($row) <= 0) {
			AvaluosMercado::insAvaluoMercado($id);
			$row = Avaluos::find($id)->AvaluosMercado;
		}

		$cat_factores_zonas = CatFactoresZonas::orderBy('valor_factor_zona')->get();
		$cat_factores_ubicacion = CatFactoresUbicacion::orderBy('valor_factor_ubicacion')->get();
		$cat_factores_frente = CatFactoresFrente::orderBy('valor_factor_frente')->get();
		$cat_factores_forma = CatFactoresForma::orderBy('valor_factor_forma')->get();
		$cat_factores_conservacion = CatFactoresConservacion::orderBy('valor_factor_conservacion')->get();
		return View::make('Corevat.Avaluos.avaluos', compact('opt', 'idavaluo', 'title', 'row', 'cat_factores_zonas', 'cat_factores_ubicacion', 'cat_factores_frente', 'cat_factores_forma', 'cat_factores_conservacion'));
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /avaluosmercado/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id) {
	}

}
