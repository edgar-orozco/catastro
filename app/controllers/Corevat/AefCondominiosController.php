<?php
use Carbon\Carbon;

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
		$subtotal_area_condominio = $total_valor_fisico = 0;
		$inputs = Input::All();
		$validate = $this->validate($inputs);
		if ($validate->fails()) {
			$response = array('success' => false, 'errors' => $validate->getMessageBag()->toArray());
		} else {
			$inputs["created_at"] = Carbon::now()->format('Y-m-d H:i:s');
			AefCondominios::insAefCondominios($inputs, $subtotal_area_condominio, $total_valor_fisico);
			$response = array('success' => true, 'message' => '¡El registro fue ingresado satisfactoriamente!',
				'subtotal_area_condominio' => number_format($subtotal_area_condominio, 2, ".", ","), 
				'total_valor_fisico' => number_format($total_valor_fisico, 2, ".", ","));
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
		$subtotal_area_condominio = $total_valor_fisico = 0;
		$inputs = Input::All();
		$validate = $this->validate($inputs);
		if ($validate->fails()) {
			$response = array('success' => false, 'errors' => $validate->getMessageBag()->toArray());
		} else {
			$inputs["updated_at"] = Carbon::now()->format('Y-m-d H:i:s');
			AefCondominios::updAefCondominios($inputs, $subtotal_area_condominio, $total_valor_fisico);
			$response = array('success' => true, 'message' => '¡El registro fue modificado satisfactoriamente!',
				'subtotal_area_condominio' => number_format($subtotal_area_condominio, 2, ".", ","), 
				'total_valor_fisico' => number_format($total_valor_fisico, 2, ".", ","));
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
			$row->delete($id);
			$rowEnfoqueFisico = AvaluosFisico::find($row->idavaluoenfoquefisico);
			return Response::json(array('success' => true, 'message' => '!El registro fue eliminado satisfactoriamente!',
				'subtotal_area_condominio' => number_format($rowEnfoqueFisico->subtotal_area_condominio, 2, ".", ","),
				'total_valor_fisico' => number_format($rowEnfoqueFisico->total_valor_fisico, 2, ".", ",")));
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
		$inputs["indiviso_condominios"] = number_format((float) $inputs["indiviso_condominios"], 2, ".", "");

		$rules = array(
			'cantidad_condominios' => array('required', 'numeric', 'min:0.00', 'max:99999999.99'),
			'valor_nuevo_condominios' => array('required', 'numeric', 'min:0.00', 'max:99999999.99'),
			'vida_remanente' => array('required', 'numeric', 'min:0.00', 'max:99999999.99'),
			'edad_condominios' => array('required', 'numeric', 'min:0.00', 'max:99999999.99'),
			'factor_edad_condominios' => array('required', 'numeric', 'min:0.00', 'max:99999999.99'),
			'factor_conservacion_condominios' => array('required', 'numeric', 'min:0.00', 'max:99999999.99'),
		);
		$messages = array(
			'cantidad_condominios.required' => '¡El campo "Cantidad" es requerido!',
			'cantidad_condominios.numeric' => '¡El valor del campo "Cantidad" debe ser numérico!',
			'cantidad_condominios.min' => '¡El valor mínimo del campo "Cantidad" debe ser cero!',
			'cantidad_condominios.max' => '¡El valor máximo del campo "Cantidad" debe ser 99999999.99!',
			
			'valor_nuevo_condominios.required' => '¡El campo "V.R. Nuevo" es requerido!',
			'valor_nuevo_condominios.numeric' => '¡El valor del campo "V.R. Nuevo" debe ser numérico!',
			'valor_nuevo_condominios.min' => '¡El valor mínimo del campo "V.R. Nuevo" debe ser cero!',
			'valor_nuevo_condominios.max' => '¡El valor máximo del campo "V.R. Nuevo" debe ser 99999999.99!',
			
			'vida_remanente.required' => '¡El campo "Vida Remanente" es requerido!',
			'vida_remanente.numeric' => '¡El valor del campo "Vida Remanente" debe ser numérico!',
			'vida_remanente.min' => '¡El valor mínimo del campo "Vida Remanente" debe ser cero!',
			'vida_remanente.max' => '¡El valor máximo del campo "Vida Remanente" debe ser 99999999.99!',
			
			'edad_condominios.required' => '¡El campo "Edad" es requerido!',
			'edad_condominios.numeric' => '¡El valor del campo "Edad" debe ser numérico!',
			'edad_condominios.min' => '¡El valor mínimo del campo "Edad" debe ser cero!',
			'edad_condominios.max' => '¡El valor máximo del campo "Edad" debe ser 99999999.99!',
			
			'factor_conservacion_condominios.required' => '¡El campo "Factor Conservación" es requerido!',
			'factor_conservacion_condominios.numeric' => '¡El valor del campo "Factor Conservación" debe ser numérico!',
			'factor_conservacion_condominios.min' => '¡El valor mínimo del campo "Factor Conservación" debe ser cero!',
			'factor_conservacion_condominios.max' => '¡El valor máximo del campo "Factor Conservación" debe ser 99999999.99!',
			
			'factor_edad_condominios.required' => '¡El campo "Factor Edad" es requerido!',
			'factor_edad_condominios.numeric' => '¡El valor del campo "Factor Edad" debe ser numérico!',
			'factor_edad_condominios.min' => '¡El valor mínimo del campo "Factor Edad" debe ser cero!',
			'factor_edad_condominios.max' => '¡El valor máximo del campo "Factor Edad" debe ser 99999999.99!',
			
		);
		return Validator::make($inputs, $rules, $messages);
	}

}
