<?php
use Carbon\Carbon;

class corevat_AemHomologacionController extends \BaseController {

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getAemHomologacion($id) {
		$row = AemHomologacion::find($id);
		return $row;
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getAjaxAemHomologacion($id) {
		return AemHomologacion::getAjaxAemHomologacionByFk($id);
	}
	
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function setAemHomologacion() {
		$valor_unitario_promedio = 0;
		$valor_aplicado_m2 = 0;
		$inputs = Input::All();

		$inputs['zona_aemhomologacion'] = number_format((float) $inputs['zona_aemhomologacion'], 2, '.', '');
		$inputs['ubicacion_aemhomologacion'] = number_format((float) $inputs['ubicacion_aemhomologacion'], 2, '.', '');
		$inputs['frente'] = number_format((float) $inputs['frente'], 2, '.', '');
		$inputs['forma'] = number_format((float) $inputs['forma'], 2, '.', '');
		$inputs['valor_unitario_negociable'] = number_format($inputs['valor_unitario_negociable'], 2, '.', '');

		$rules = array(
			'valor_unitario_negociable' => array('required', 'numeric', 'min:0.00', 'max:1.00', 'regex:/^[0-1]{1}(\.?)[0-9]{1,2}$/'),
		);
		$messages = array(
			'valor_unitario_negociable.required' => '¡El campo "Negociable" es requerido!',
			'valor_unitario_negociable.numeric' => '¡El valor del campo "Negociable" debe ser numérico!',
			'valor_unitario_negociable.min' => '¡El valor mínimo del campo "Negociable" debe ser cero!',
			'valor_unitario_negociable.max' => '¡El valor máximo del campo "Negociable" deber ser 1.00!',
			'valor_unitario_negociable.regex' => '¡El formato del campo "Negociable" debe ser 0.99!',
		);
		$validate = Validator::make($inputs, $rules, $messages);
		if ($validate->fails()) {
			$response = array('success' => false, 'errors' => $validate->getMessageBag()->toArray());
		} else {
			$inputs["updated_at"] = Carbon::now()->format('Y-m-d H:i:s');
			AemHomologacion::updAemHomologacion($inputs);
			$rowAem = AvaluosMercado::find($inputs["idavaluoenfoquemercado2"]);
			$response = array(
				'success' => true,
				'message' => '¡El registro fue modificado satisfactoriamente!',
					'valor_unitario_promedio' => number_format($rowAem->valor_unitario_promedio, 2, '.', ','),
					'valor_aplicado_m2' => number_format($rowAem->valor_aplicado_m2, 2, '.', ','));
		}
		return $response;
	}

}
