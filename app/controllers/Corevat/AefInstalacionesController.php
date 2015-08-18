<?php

class corevat_AefInstalacionesController extends \BaseController {

	public function getAjax($id) {
		return AefInstalaciones::getAjaxAefInstalacionesByFk($id);
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /aefinstalaciones/create
	 *
	 * @return Response
	 */
	public function create() {
		$row = new AefInstalaciones();
		return $row;
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /aefinstalaciones
	 *
	 * @return Response
	 */
	public function store() {
		$total_metros_construccion = 0;
		$subtotal_instalaciones_especiales = 0;
		$total_valor_fisico = 0;
		$inputs = Input::All();
		$validate = $this->validate($inputs);
		if ($validate->fails()) {
			$response = array('success' => false, 'errors' => $validate->getMessageBag()->toArray());
		} else {
			AefInstalaciones::insAefInstalaciones($inputs, $total_metros_construccion, $subtotal_instalaciones_especiales, $total_valor_fisico);
			$total_metros_construccion = number_format($total_metros_construccion, 2, ".", ",");
			$response = array(
				'success' => true,
				'message' => '¡El registro fue ingresado satisfactoriamente!',
				'subtotal_instalaciones_especiales' => number_format($subtotal_instalaciones_especiales, 2, ".", ","),
				'total_valor_fisico' => number_format($total_valor_fisico, 2, ".", ",")
			);
		}
		return $response;
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /aefinstalaciones/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id) {
		$row = AefInstalaciones::find($id);
		return $row;
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /aefinstalaciones/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id) {
		$subtotal_instalaciones_especiales = 0;
		$total_valor_fisico = 0;
		$inputs = Input::All();
		$validate = $this->validate($inputs);
		if ($validate->fails()) {
			$response = array('success' => false, 'errors' => $validate->getMessageBag()->toArray());
		} else {
			AefInstalaciones::updAefInstalaciones($inputs, $subtotal_instalaciones_especiales, $total_valor_fisico);
			$response = array(
				'success' => true,
				'message' => '¡El registro fue modificado satisfactoriamente!',
				'subtotal_instalaciones_especiales' => number_format($subtotal_instalaciones_especiales, 2, ".", ","),
				'total_valor_fisico' => number_format($total_valor_fisico, 2, ".", ",")
			);
		}
		return $response;
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /aefinstalaciones/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id) {
		$row = AefInstalaciones::findOrFail($id);
		if ($row) {
			$idavaluoenfoquefisico = $row->idavaluoenfoquefisico;
			$row->delete($id);
			$Total = AefInstalaciones::select(DB::raw('sum(valor_parcial) AS nsuma'))->where('idavaluoenfoquefisico', '=', $idavaluoenfoquefisico)->first();
			$rowEnfoqueFisico = AvaluosFisico::find($idavaluoenfoquefisico);
			$rowEnfoqueFisico->subtotal_instalaciones_especiales = ( is_null($Total->nsuma) ? 0 : $Total->nsuma);
			$rowEnfoqueFisico->total_valor_fisico = AvaluosFisico::updBeforeAvaluoEnfoqueFisico($rowEnfoqueFisico);
			$rowEnfoqueFisico->save();
			AvaluosFisico::updAfterAvaluoEnfoqueFisico($rowEnfoqueFisico->idavaluo, $rowEnfoqueFisico->total_valor_fisico);
			return Response::json(array('success' => true, 'message' => '!El registro fue eliminado satisfactoriamente!',
				'subtotal_instalaciones_especiales' => number_format($rowEnfoqueFisico->subtotal_instalaciones_especiales, 2, ".", ","),
				'total_valor_fisico' => number_format($rowEnfoqueFisico->total_valor_fisico, 2, ".", ",")
				));
		} else {
			return Response::json(array('success' => false, 'message' => '!El registro no existe!'));
		}
	}

	private function validate(&$inputs) {
		$inputs["cantidad_instalaciones"] = number_format(  (float) $inputs["cantidad_instalaciones"], 2, ".", "");
		$inputs["valor_nuevo_instalaciones"] = number_format( (float) $inputs["valor_nuevo_instalaciones"], 2, ".", "");
		$inputs["vida_util_instalaciones"] = number_format( (float) $inputs["vida_util_instalaciones"], 2, ".", "");
		$inputs["edad_instalaciones"] = (int) $inputs["edad_instalaciones"];
		$inputs["factor_conservacion_instalaciones"] = number_format( (float) $inputs["factor_conservacion_instalaciones"], 2, ".", "");
		
		$rules = array(
			'cantidad_instalaciones' => array('required', 'numeric', 'min:0.00', 'max:99999999.99'),
			'valor_nuevo_instalaciones' => array('required', 'numeric', 'min:0.00', 'max:99999999.99'),
			'vida_util_instalaciones' => array('required', 'numeric', 'min:0.00', 'max:99999999.99'),
			'edad_instalaciones' => array('required', 'numeric', 'min:0.00', 'max:99999999.99'),
			'factor_conservacion_instalaciones' => array('required', 'numeric', 'min:0.00', 'max:99999999.99'),
		);
		$messages = array(
			'cantidad_instalaciones.required' => '¡El campo "Cantidad" es requerido!',
			'cantidad_instalaciones.numeric' => '¡El valor del campo "Cantidad" debe ser numérico!',
			'cantidad_instalaciones.min' => '¡El valor mínimo del campo "Cantidad" debe ser cero!',
			'cantidad_instalaciones.max' => '¡El valor máximo del campo "Cantidad" debe ser 99999999.99!',

			'valor_nuevo_instalaciones.required' => '¡El campo "V.R. Nuevo" es requerido!',
			'valor_nuevo_instalaciones.numeric' => '¡El valor del campo "V.R. Nuevo" debe ser numérico!',
			'valor_nuevo_instalaciones.min' => '¡El valor mínimo del campo "V.R. Nuevo" debe ser cero!',
			'valor_nuevo_instalaciones.max' => '¡El valor máximo del campo "V.R. Nuevo" debe ser 99999999.99!',
			
			'vida_util_instalaciones.required' => '¡El campo "Vida Útil " es requerido!',
			'vida_util_instalaciones.numeric' => '¡El valor del campo "Vida Útil " debe ser numérico!',
			'vida_util_instalaciones.min' => '¡El valor mínimo del campo "Vida Útil " debe ser cero!',
			'vida_util_instalaciones.max' => '¡El valor máximo del campo "Vida Útil " debe ser 99999999.99!',
			
			'edad_instalaciones.required' => '¡El campo "Edad" es requerido!',
			'edad_instalaciones.numeric' => '¡El valor del campo "Edad" debe ser numérico!',
			'edad_instalaciones.min' => '¡El valor mínimo del campo "Edad" debe ser cero!',
			'edad_instalaciones.max' => '¡El valor máximo del campo "Edad" debe ser 99999999.99!',
			'edad_instalaciones.regex' => '¡El formato del campo "Edad" debe ser 99999999.99!',

			'factor_conservacion_instalaciones.required' => '¡El campo "Factor Conservación" es requerido!',
			'factor_conservacion_instalaciones.numeric' => '¡El valor del campo "Factor Conservación" debe ser numérico!',
			'factor_conservacion_instalaciones.min' => '¡El valor mínimo del campo "Factor Conservación" debe ser cero!',
			'factor_conservacion_instalaciones.max' => '¡El valor máximo del campo "Factor Conservación" debe ser 99999999.99!',
			
		);
		return Validator::make($inputs, $rules, $messages);
	}

}
