<?php

use Carbon\Carbon;

class corevat_AemAnalisisController extends \BaseController {

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getAemAnalisis($id) {
		$row = AemAnalisis::find($id);
		$row->valor_unitario_m2 = number_format($row->valor_unitario_m2, 2, '.', ',');
		$row->factor_superficie = number_format($row->factor_superficie, 2, '.', ',');
		$row->factor_resultante = number_format($row->factor_resultante, 2, '.', ',');
		$row->valor_unitario_resultante_m2 = number_format($row->valor_unitario_resultante_m2, 2, '.', ',');
		return $row;
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getAjaxAemAnalisis($id) {
		return AemAnalisis::getAjaxAemAnalisisByFk($id);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function setAemAnalisis() {
		$inputs = Input::All();
		$inputs['precio_venta'] = number_format((float) $inputs['precio_venta'], 2, '.', '');
		$inputs['superficie_terreno_aemanalisis'] = number_format((float) $inputs['superficie_terreno_aemanalisis'], 2, '.', '');
		$inputs['superficie_construccion_aemanalisis'] = number_format((float) $inputs['superficie_construccion_aemanalisis'], 2, '.', '');
		$inputs['factor_zona'] = number_format((float) $inputs['factor_zona'], 2, '.', '');
		$inputs['factor_ubicacion'] = number_format((float) $inputs['factor_ubicacion'], 2, '.', '');
		$inputs['factor_edad'] = number_format((float) $inputs['factor_edad'], 2, '.', '');
		$inputs['factor_conservacion'] = number_format((float) $inputs['factor_conservacion'], 2, '.', '');
		$inputs['factor_negociacion'] = number_format((float) $inputs['factor_negociacion'], 2, '.', '');

		$rules = array(
			'precio_venta' => array('required', 'numeric', 'min:0.00', 'max:9999999999999.99', 'regex:/^[0-9]{1,13}(\.?)[0-9]{1,2}$/'),
			'superficie_terreno_aemanalisis' => array('required', 'numeric', 'min:0.00', 'max:9999999999999.99', 'regex:/^[0-9]{1,13}(\.?)[0-9]{1,2}$/'),
			'superficie_construccion_aemanalisis' => array('required', 'numeric', 'min:0.00', 'max:9999999999999.99', 'regex:/^[0-9]{1,13}(\.?)[0-9]{1,2}$/'),
			'factor_edad' => array('required', 'numeric', 'min:0.00', 'max:99999999.99', 'regex:/^[0-9]{1,8}(\.?)[0-9]{1,2}$/'),
			'factor_negociacion' => array('required', 'numeric', 'min:0.00', 'max:100.00', 'regex:/^[0-9]{1,3}(\.?)[0-9]{1,2}$/'),
		);
		$messages = array(
			'precio_venta.required' => '¡El campo "Precio de Venta" es requerido!',
			'precio_venta.numeric' => '¡El valor del campo "Precio de Venta" debe ser numérico!',
			'precio_venta.min' => '¡El valor del campo "Precio de Venta" debe ser cero!',
			'precio_venta.max' => '¡El valor del campo "Precio de Venta" debe ser 9999999999999.99!',
			'precio_venta.regex' => '¡El formato del campo "Precio de Venta" debe ser 9999999999999.99!',
			'superficie_terreno_aemanalisis.required' => '¡El campo "Superficie del Terreno" es requerido!',
			'superficie_terreno_aemanalisis.numeric' => '¡El valor del campo "Superficie del Terreno" debe ser numérico!',
			'superficie_terreno_aemanalisis.min' => '¡El valor del campo "Superficie del Terreno" debe ser cero!',
			'superficie_terreno_aemanalisis.max' => '¡El valor del campo "Superficie del Terreno" debe ser 9999999999999.99!',
			'superficie_terreno_aemanalisis.regex' => '¡El formato del campo "Superficie del Terreno" debe ser 9999999999999.99!',
			'superficie_construccion_aemanalisis.required' => '¡El campo "Superficie de la Construcción" es requerido!',
			'superficie_construccion_aemanalisis.numeric' => '¡El valor del campo "Superficie de la Construcción" debe ser numérico!',
			'superficie_construccion_aemanalisis.min' => '¡El valor del campo "Superficie de la Construcción" debe ser cero!',
			'superficie_construccion_aemanalisis.max' => '¡El valor del campo "Superficie de la Construcción" debe ser 9999999999999.99!',
			'superficie_construccion_aemanalisis.regex' => '¡El formato del campo "Superficie de la Construcción" debe ser 9999999999999.99!',
			'factor_edad.required' => '¡El campo "Factor Edad" es requerido!',
			'factor_edad.numeric' => '¡El valor del campo "Factor Edad" debe ser numérico!',
			'factor_edad.min' => '¡El valor del campo "Factor Edad" debe ser cero!',
			'factor_edad.max' => '¡El valor del campo "Factor Edad" debe ser 99999999.99!',
			'factor_edad.regex' => '¡El formato del campo "Factor Edad" debe ser 99999999.99!',
			'factor_negociacion.required' => '¡El campo "Negociación" es requerido!',
			'factor_negociacion.numeric' => '¡El valor del campo "Negociación" debe ser numérico!',
			'factor_negociacion.min' => '¡El valor del campo "Negociación" debe ser cero!',
			'factor_negociacion.max' => '¡El valor del campo "Negociación" debe ser 100.00!',
			'factor_negociacion.regex' => '¡El formato del campo "Negociación" debe ser 100.00!',
		);
		$validate = Validator::make($inputs, $rules, $messages);
		if ($validate->fails()) {
			$response = array('success' => false, 'errors' => $validate->getMessageBag()->toArray());
		} else {
			$inputs["updated_at"] = Carbon::now()->format('Y-m-d H:i:s');
			AemAnalisis::updAemAnalisis($inputs);
			$rowAem = AvaluosMercado::find($inputs['idavaluoenfoquemercado4']);
			$rowAemAnalisis = AemAnalisis::find($inputs['idaemanalisis']);
			$response = array(
				'success' => true,
				'message' => '¡El registro fue modificado satisfactoriamente!',
				'valor_unitario_m2' => number_format($rowAemAnalisis->valor_unitario_m2, 2, '.', ','),
				'factor_superficie' => number_format($rowAemAnalisis->factor_superficie, 2, '.', ','),
				'factor_resultante' => number_format($rowAemAnalisis->factor_resultante, 2, '.', ','),
				'valor_unitario_resultante_m2' => number_format($rowAemAnalisis->valor_unitario_resultante_m2, 2, '.', ','),
				'promedio_analisis' => number_format($rowAem->promedio_analisis, 2, '.', ','),
				'superficie_construida' => number_format($rowAem->superficie_construida, 2, '.', ','),
				'valor_comparativo_mercado' => number_format($rowAem->valor_comparativo_mercado, 2, '.', ','),
			);
		}
		return $response;
	}

}
