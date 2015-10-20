<?php

use Carbon\Carbon;

class corevat_AiAcabadosController extends \BaseController {

	/**
	 * Retorna los registros de la tabla ai_acabados para cargar el dataTable
	 *
	 * @param  int  $id [idavaluoinmueble]
	 * @return Response
	 */
	public function getAjaxAiAcabados($id) {
		return AiAcabados::AiAcabadosByFk($id);
	}

	/**
	 * Retorna el registro de la tabla ai_medidas_colindancias
	 *
	 * @param  int  $id [idaimedidacolindancia]
	 * @return Response
	 */
	public function getAiAcabados($id) {
		return AiAcabados::find($id);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  
	 * @return Response
	 */
	public function setAiAcabados() {
		$inputs = Input::All();
		$response = array('success' => true, 'message' => '', 'errors' => '', 'idTable' => '');
		if ($inputs['ctrl_acabado'] == 'ins') {
			$inputs["created_at"] = Carbon::now()->format('Y-m-d H:i:s');
			AiAcabados::insAiAcabados($inputs);
			$response['message'] = '¡El registro fue ingresado satisfactoriamente!';
		} else {
			$inputs["updated_at"] = Carbon::now()->format('Y-m-d H:i:s');
			AiAcabados::updAiAcabados($inputs);
			$response['message'] = '¡El registro fue modificado satisfactoriamente!';
		}
		$response['success'] = true;
		return Response::json($response);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id) {
		$row = AiAcabados::findOrFail($id);
		$row->delete($id);
		return Response::json(array('success' => true, 'message' => '!El registro fue eliminado satisfactoriamente!'));
	}


}