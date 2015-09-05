<?php

use Carbon\Carbon;

class corevat_AemInformacionController extends \BaseController {

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getAemInformacion($id){
		return AemInformacion::find($id);

	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getAjaxAemInformacion($id) {
		return AemInformacion::getAjaxAemInformacionByFk($id);
	}
	
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function setAemInformacion() {
		$inputs = Input::All();
		$inputs["edad"] = (int) $inputs["edad"];
		$rules = array(
			'edad' => array('required', 'integer', 'min:0', 'max:99999999', 'regex:/^[0-9]{1,8}$/'),
		);
		$messages = array(
			'edad.required' => '¡El campo "Edad" es requerido!',
			'edad.min' => '¡El valor mínimo del campo "Edad" debe ser cero!',
			'edad.max' => '¡El valor máximo del campo "Edad" debe ser 99999999!',
			'edad.regex' => '¡El formato del campo "Edad" debe ser 99999999!',
		);
		$validate = Validator::make($inputs, $rules, $messages);
		if ($validate->fails()) {
			$response = array('success' => false, 'errors' => $validate->getMessageBag()->toArray());
		} else {
			if ($inputs['ctrlAemInformacion'] == 'ins') {
				$inputs["created_at"] = Carbon::now()->format('Y-m-d H:i:s');
				AemInformacion::insAemInformacion($inputs);
				$rowAem = AvaluosMercado::find($inputs['idavaluoenfoquemercado3']);
				$response = array(
					'success' => true,
					'message' => '¡El registro fue ingresado satisfactoriamente!',
					'promedio_analisis' => number_format($rowAem->promedio_analisis, 2, '.', ','),
					'superficie_construida' => number_format($rowAem->superficie_construida, 2, '.', ','),
					'valor_comparativo_mercado' => number_format($rowAem->valor_comparativo_mercado, 2, '.', ','),
				);
			} else {
				$inputs["updated_at"] = Carbon::now()->format('Y-m-d H:i:s');
				AemInformacion::updInformacion($inputs);
				$rowAem = AvaluosMercado::find($inputs['idavaluoenfoquemercado3']);
				$response = array(
					'success' => true,
					'message' => '¡El registro fue modificado satisfactoriamente!',
					'promedio_analisis' => number_format($rowAem->promedio_analisis, 2, '.', ','),
					'superficie_construida' => number_format($rowAem->superficie_construida, 2, '.', ','),
					'valor_comparativo_mercado' => number_format($rowAem->valor_comparativo_mercado, 2, '.', ','),
				);
			}
		}
		return $response;
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /aeminformacion/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id) {
		AemInformacion::where('idaeminformacion', '=', $id)->delete();
		// ACTUALIZAR TODOS LOS SUBTOTALES
		// CONSULTAMOS LOS DATOS DE avaluo_enfoque_mercado
		return array('success' => true, 'message' => '!El registro fue eliminado satisfactoriamente!');
	}

}
