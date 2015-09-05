<?php

use Carbon\Carbon;

class corevat_AemCompTerrenosController extends \BaseController {

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getAemCompTerrenos($id) {
		return AemCompTerrenos::find($id);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getAjaxAemCompTerrenos($id) {
		return AemCompTerrenos::getAjaxAemCompTerrenosByFk($id);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function setAemCompTerrenos() {
		$inputs = Input::All();
		$idaemcompterreno = 0;
		$inputs['precio'] = number_format((float) $inputs['precio'], 2, '.', '');
		$inputs['superficie_terreno_aemcompterreno'] = number_format((float) $inputs['superficie_terreno_aemcompterreno'], 2, '.', '');
		$rules = array(
			'ubicacion_aemcompterreno' => 'required',
			'precio' => array('required', 'numeric', 'min:0.00', 'max:99999999.99', 'regex:/^[0-9]{1,8}(\.?)[0-9]{1,2}$/'),
			'superficie_terreno_aemcompterreno' => array('required', 'numeric', 'min:0.00', 'max:99999999.99', 'regex:/^[0-9]{1,8}(\.?)[0-9]{1,2}$/'),
			'observaciones_aemcompterreno' => 'required',
		);
		$messages = array(
			'ubicacion_aemcompterreno.required' => '¡El campo "Ubicación" es requerido!',
			'precio.required' => '¡El campo "Precio" es requerido!',
			'precio.numeric' => '¡El valor del campo "Precio" debe ser numérico!',
			'precio.min' => '¡El valor mínimo del campo "Precio" debe ser cero!',
			'precio.max' => '¡El valor máximo del campo "Precio" debe ser 99999999.99!',
			'precio.regex' => '¡El formato del campo "Precio" debe ser 99999999.99!',
			'superficie_terreno_aemcompterreno.required' => '¡El campo "Superficie del Terreno" es requerido!',
			'superficie_terreno_aemcompterreno.numeric' => '¡El valor del campo "Superficie del Terreno" debe ser numérico!',
			'superficie_terreno_aemcompterreno.min' => '¡El valor del campo "Superficie del Terreno" debe ser cero!',
			'superficie_terreno_aemcompterreno.max' => '¡El valor del campo "Superficie del Terreno" debe ser 99999999.99!',
			'superficie_terreno_aemcompterreno.regex' => '¡El formato del campo "Superficie del Terreno" debe ser 99999999.99!',
			'observaciones_aemcompterreno.required' => '¡El campo "Observaciones" es requerido!',
		);
		$validate = Validator::make($inputs, $rules, $messages);
		if ($validate->fails()) {
			$response = array('success' => false, 'errors' => $validate->getMessageBag()->toArray());
		} else {
			if ($inputs['ctrlAemCompTerrenos'] == 'ins') {
				$inputs["created_at"] = Carbon::now()->format('Y-m-d H:i:s');
				AemCompTerrenos::insAemCompTerrenos($inputs);
				$rowAem = AvaluosMercado::find($inputs["idavaluoenfoquemercado1"]);
				$response = array(
					'success' => true,
					'message' => '¡El registro fue ingresado satisfactoriamente!',
					'valor_unitario_promedio' => number_format($rowAem->valor_unitario_promedio, 2, '.', ','),
					'valor_aplicado_m2' => number_format($rowAem->valor_aplicado_m2, 2, '.', ','));
			} else {
				$inputs["updated_at"] = Carbon::now()->format('Y-m-d H:i:s');
				AemCompTerrenos::updAemCompTerrenos($inputs);
				$rowAem = AvaluosMercado::find($inputs["idavaluoenfoquemercado1"]);
				$response = array(
					'success' => true,
					'message' => '¡El registro fue modificado satisfactoriamente!',
					'valor_unitario_promedio' => number_format($rowAem->valor_unitario_promedio, 2, '.', ','),
					'valor_aplicado_m2' => number_format($rowAem->valor_aplicado_m2, 2, '.', ','));
			}
		}
		return $response;
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /aemcompterrenos/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id) {
		$row = AemCompTerrenos::find($id);
		AemCompTerrenos::where('idaemcompterreno', '=', $id)->delete();
		$rowAem = AvaluosMercado::find($row->idavaluoenfoquemercado);
		$response = array('success' => true, 'message' => '!El registro fue eliminado satisfactoriamente!',
			'valor_unitario_promedio' => $rowAem->valor_unitario_promedio,
			'valor_aplicado_m2' => $rowAem->valor_aplicado_m2);

		return $response;
	}

}
