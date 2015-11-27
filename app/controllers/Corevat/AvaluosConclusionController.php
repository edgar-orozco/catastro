<?php

class corevat_AvaluosConclusionController extends \BaseController {

	/**
	 * Show the form for editing the specified resource.
	 * GET /avaluosconclusion/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id) {
		$idavaluo = $id;
		$row = Avaluos::find($id);
		if ( $row->estatus ) {
			return Redirect::to('/corevat/Avaluos')->with('error', '¡El avalúo ya fue registrado!');
		} else {
			$opt = 'conclusiones';
			$title = 'Conclusiones: ' . $row['foliocoretemp'];
			$row = Avaluos::find($id)->AvaluosConclusiones;
			if (count($row) <= 0) {
				AvaluosConclusiones::insAvaluoConclusiones($id);
				$row = Avaluos::find($id)->AvaluosConclusiones;
			}

			return View::make('Corevat.Avaluos.avaluos', compact('opt', 'idavaluo', 'title', 'row'));
		}
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /avaluosconclusion/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id) {
		$inputs = Input::All();
		$row = Avaluos::find($id)->AvaluosConclusiones;
		//$row->valor_fisico = $row->valor_fisico;
		//$row->valor_mercado = $row->valor_mercado;
		$row->factor_seleccion_valor = $inputs["factor_seleccion_valor"];
		if ($inputs["factor_seleccion_valor"] == '1') {
			$row->valor_concluido = $row->valor_fisico;
		} else {
			$row->valor_concluido = $row->valor_mercado;
		}
		$row->leyenda = $inputs["leyenda"];
		//$row->sello = '';
		//$row->firma = '';
		$row->idemp = 1;
		$row->ip = $_SERVER['REMOTE_ADDR'];
		$row->host = isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : '';
		$row->modi_por = 1;
		$row->modi_el = date('Y-m-d H:i:s');
		$row->save();
		return Redirect::to('/corevat/AvaluoConclusiones/' . $id)->with('success', '¡La modificación se efectuo correctamente!');
	}

}
