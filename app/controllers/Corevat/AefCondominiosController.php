<?php

class corevat_AefCondominiosController extends \BaseController {

	public function getAjax($id) {
		return AefCondominios::getAjaxAefCondominiosByFk($id);
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /aefcondominios/create
	 *
	 * @return Response
	 */
	public function create() {
		$row = new AefCondominios();
		return $row;
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /aefcondominios
	 *
	 * @return Response
	 */
	public function store() {
		$inputs = Input::All();
		$validate = $this->validate($inputs);
		if ($validate->fails()) {
			$response = array('success' => false, 'errors' => $validate->getMessageBag()->toArray());
		} else {
			AefCondominios::insAefCondominios($inputs);
			$response = array('success' => true, 'message' => '¡El registro fue ingresado satisfactoriamente!');
		}
		return $response;
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /aefcondominios/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id) {
		$row = AefCondominios::find($id);
		return $row;
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /aefcondominios/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id) {
		$inputs = Input::All();
		$validate = $this->validate($inputs);
		if ($validate->fails()) {
			$response = array('success' => false, 'errors' => $validate->getMessageBag()->toArray());
		} else {
			AefCondominios::updAefCondominios($inputs);
			$response = array('success' => true, 'message' => '¡El registro fue modificado satisfactoriamente!');
		}
		return $response;
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /aefcondominios/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id) {
		$row = AefCondominios::findOrFail($id);
		if ($row) {
			$idavaluoenfoquefisico = $row->idavaluoenfoquefisico;
			$row->delete($id);

			$Total = AefCondominios::select(DB::raw('sum(valor_parcial) AS nsuma'))->where('idavaluoenfoquefisico', '=', $idavaluoenfoquefisico)->first();

			$rowEnfoqueFisico = AvaluosFisico::find($idavaluoenfoquefisico);
			$rowEnfoqueFisico->subtotal_area_condominio = ( is_null($Total->nsuma) ? 0 : $Total->nsuma);
			$rowEnfoqueFisico->total_valor_fisico = AvaluosFisico::updBeforeAvaluoEnfoqueFisico($rowEnfoqueFisico);
			$rowEnfoqueFisico->save();
			AvaluosFisico::updAfterAvaluoEnfoqueFisico($rowEnfoqueFisico->idavaluo, $rowEnfoqueFisico->total_valor_fisico);
			return Response::json(array('success' => true, 'message' => '!El registro fue eliminado satisfactoriamente!'));
		} else {
			return Response::json(array('success' => false, 'message' => '!El registro no existe!'));
		}
	}

	private function validate(&$inputs) {
		$inputs["cantidad_condominios"] = number_format( (float) $inputs["cantidad_condominios"], 2, ".", "");
		$inputs["valor_nuevo_condominios"] = number_format( (float) $inputs["valor_nuevo_condominios"], 2, ".", "");
		$inputs["vida_remanente"] = number_format( (float) $inputs["vida_remanente"], 2, ".", "");
		$inputs["edad_condominios"] = number_format( (float) $inputs["edad_condominios"], 2, ".", "");
		$inputs["factor_conservacion_condominios"] = number_format( (float) $inputs["factor_conservacion_condominios"], 2, ".", "");
		$inputs["indiviso_condominios"] = number_format( (float) $inputs["indiviso_condominios"], 2, ".", "");

		$rules = array(
			'descripcion' => 'required',
			'unidad' => 'required',
			'cantidad_condominios' => array('required', 'numeric', 'min:0.00', 'max:99999999.99', 'regex:/^[0-9]{1,8}(\.?)[0-9]{1,2}$/'),
			'valor_nuevo_condominios' => array('required', 'numeric', 'min:0.00', 'max:99999999.99', 'regex:/^[0-9]{1,8}(\.?)[0-9]{1,2}$/'),
			'vida_remanente' => array('required', 'numeric', 'min:0.00', 'max:99999999.99', 'regex:/^[0-9]{1,8}(\.?)[0-9]{1,2}$/'),
			'edad_condominios' => array('required', 'numeric', 'min:0.00', 'max:99999999.99', 'regex:/^[0-9]{1,8}(\.?)[0-9]{1,2}$/'),
			'factor_conservacion_condominios' => array('required', 'numeric', 'min:0.00', 'max:99999999.99', 'regex:/^[0-9]{1,8}(\.?)[0-9]{1,2}$/'),
			'indiviso_condominios' => array('required', 'numeric', 'min:0.00', 'max:99999999.99', 'regex:/^[0-9]{1,8}(\.?)[0-9]{1,2}$/'),
		);
		$messages = array(
			'descripcion.required' => '¡El campo "Descripción" es requerido!',
			'unidad.required' => '¡El campo "Unidad" es requerido!',
			
			'cantidad_condominios.required' => '¡El campo "Cantidad" es requerido!',
			'cantidad_condominios.numeric' => '¡El valor del campo "Cantidad" debe ser numérico!',
			'cantidad_condominios.min' => '¡El valor mínimo del campo "Cantidad" debe ser cero!',
			'cantidad_condominios.max' => '¡El valor máximo del campo "Cantidad" debe ser 99999999.99!',
			'cantidad_condominios.regex' => '¡El formato del campo "Cantidad" debe ser 99999999.99!',
			
			'valor_nuevo_condominios.required' => '¡El campo "V.R. Nuevo" es requerido!',
			'valor_nuevo_condominios.numeric' => '¡El valor del campo "V.R. Nuevo" debe ser numérico!',
			'valor_nuevo_condominios.min' => '¡El valor mínimo del campo "V.R. Nuevo" debe ser cero!',
			'valor_nuevo_condominios.max' => '¡El valor máximo del campo "V.R. Nuevo" debe ser 99999999.99!',
			'valor_nuevo_condominios.regex' => '¡El formato del campo "V.R. Nuevo" debe ser 99999999.99!',
			
			'vida_remanente.required' => '¡El campo "Vida Remanente" es requerido!',
			'vida_remanente.numeric' => '¡El valor del campo "Vida Remanente" debe ser numérico!',
			'vida_remanente.min' => '¡El valor mínimo del campo "Vida Remanente" debe ser cero!',
			'vida_remanente.max' => '¡El valor máximo del campo "Vida Remanente" debe ser 99999999.99!',
			'vida_remanente.regex' => '¡El formato del campo "Vida Remanente" debe ser 99999999.99!',
			
			'edad_condominios.required' => '¡El campo "Edad" es requerido!',
			'edad_condominios.numeric' => '¡El valor del campo "Edad" debe ser numérico!',
			'edad_condominios.min' => '¡El valor mínimo del campo "Edad" debe ser cero!',
			'edad_condominios.max' => '¡El valor máximo del campo "Edad" debe ser 99999999.99!',
			'edad_condominios.regex' => '¡El formato del campo "Edad" debe ser 99999999.99!',
			
			'factor_conservacion_condominios.required' => '¡El campo "Factor Conservación" es requerido!',
			'factor_conservacion_condominios.numeric' => '¡El valor del campo "Factor Conservación" debe ser numérico!',
			'factor_conservacion_condominios.min' => '¡El valor mínimo del campo "Factor Conservación" debe ser cero!',
			'factor_conservacion_condominios.max' => '¡El valor máximo del campo "Factor Conservación" debe ser 99999999.99!',
			'factor_conservacion_condominios.regex' => '¡El formato del campo "Factor Conservación" debe ser 99999999.99!',
			
			'indiviso.required' => '¡El campo "Indiviso (%)" es requerido!',
			'indiviso.numeric' => '¡El valor del campo "Indiviso (%)" debe ser numérico!',
			'indiviso.min' => '¡El valor mínimo del campo "Indiviso (%)" debe ser cero!',
			'indiviso.max' => '¡El valor máximo del campo "Indiviso (%)" debe ser 100.00!',
			'indiviso.regex' => '¡El formato del campo "Indiviso (%)" debe ser 100.00!',
		);
		return Validator::make($inputs, $rules, $messages);
	}

}
