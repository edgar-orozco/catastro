<?php


use Carbon\Carbon;

class corevat_AiMedidasController extends \BaseController {

	/**
	 * Retorna los registros de la tabla ai_medidas_colindancias para cargar el dataTable
	 *
	 * @param  int  $id [idavaluoinmueble]
	 * @return Response
	 */
	public function getAjaxAiMedidasColindancias($id) {
		return AiMedidasColindancias::AiMedidasColindanciasByFk($id);
	}

	/**
	 * Retorna el registro de la tabla ai_medidas_colindancias
	 *
	 * @param  int  $id [idaimedidacolindancia]
	 * @return Response
	 */
	public function getAiMedidasColindancias($id) {
		return AiMedidasColindancias::find($id);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  
	 * @return Response
	 */
	public function setAiMedidasColindancias() {
		$inputs = Input::All();
		$response = array('success' => true, 'message' => '', 'errors' => '', 'idTable' => '');
		$rules = array(
			'medidas' => 'required|numeric|min:0.0001|max:9999999999.9999',
			'unidad_medida' => 'required',
			'colindancia' => 'required',
		);
		$messages = array(
			'medidas.required' => '¡El campo "Medidas" es requerido!',
			'medidas.min' => '¡El valor mínimo del campo "Medidas" es "0.0001"!',
			'medidas.max' => '¡El valor máximo del campo "Medidas" es "9999999999.9999"!',
			'unidad_medida.required' => '¡El campo "Unidad de Medida" es requerido!',
			'colindancia.required' => '¡El campo "Colindancias" es requerido!',
		);
		$validate = Validator::make($inputs, $rules, $messages);
		if ($validate->fails()) {
			$response['success'] = false;
			$response['errors'] = $validate->getMessageBag()->toArray();
		} else {
			if ($inputs['ctrl'] == 'ins') {
				$inputs["created_at"] = Carbon::now()->format('Y-m-d H:i:s');
				$response['idTable'] = AiMedidasColindancias::insAiMedidasColindancias($inputs);
				$response['message'] = '¡El registro fue ingresado satisfactoriamente!';
			} else {
				$inputs["updated_at"] = Carbon::now()->format('Y-m-d H:i:s');
				$response['idTable'] = AiMedidasColindancias::updAiMedidasColindancias($inputs);
				$response['message'] = '¡El registro fue modificado satisfactoriamente!';
			}
			$response['success'] = true;
		}
		return Response::json($response);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id) {

		$row = AiMedidasColindancias::findOrFail($id);
		$row->delete($id);
		return Response::json(array('success' => true, 'message' => '!El registro fue eliminado satisfactoriamente!'));
	}

}

