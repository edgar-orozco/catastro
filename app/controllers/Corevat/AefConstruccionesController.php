<?php
use Carbon\Carbon;

class corevat_AefConstruccionesController extends \BaseController {

	public function getAjax($id) {
		return AefConstrucciones::getAjaxAefConstruccionesByFk($id);
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /aefconstrucciones/create
	 *
	 * @return Response
	 */
	public function create() {
		$row = new AefConstrucciones();
		return $row;
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /aefconstrucciones
	 *
	 * @return Response
	 */
	public function store() {
		$total_metros_construccion = 0;
		$valor_construccion = 0;
		$total_valor_fisico = 0;
		$inputs = Input::All();
		$validate = $this->validate($inputs);
		if ($validate->fails()) {
			$response = array('success' => false, 'errors' => $validate->getMessageBag()->toArray());
		} else {
			$inputs["created_at"] = Carbon::now()->format('Y-m-d H:i:s');
			AefConstrucciones::insAefConstrucciones($inputs, $total_metros_construccion, $valor_construccion, $total_valor_fisico);
			$response = array(
				'success' => true,
				'message' => '¡El registro fue ingresado satisfactoriamente!',
				'total_metros_construccion' => number_format($total_metros_construccion, 2, ".", ","),
				'valor_construccion' => number_format($valor_construccion, 2, ".", ","),
				'total_valor_fisico' => number_format($total_valor_fisico, 2, ".", ",")
			);
		}
		return $response;
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /aefconstrucciones/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id) {
		$row = AefConstrucciones::find($id);
		return $row;
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /aefconstrucciones/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id) {
		$total_metros_construccion = 0;
		$valor_construccion = 0;
		$total_valor_fisico = 0;
		$inputs = Input::All();
		$validate = $this->validate($inputs);
		if ($validate->fails()) {
			$response = array('success' => false, 'errors' => $validate->getMessageBag()->toArray());
		} else {
			$inputs["updated_at"] = Carbon::now()->format('Y-m-d H:i:s');
			AefConstrucciones::updAefConstrucciones($inputs, $total_metros_construccion, $valor_construccion, $total_valor_fisico);
			$response = array(
				'success' => true,
				'message' => '¡El registro fue modificado satisfactoriamente!',
				'total_metros_construccion' => number_format($total_metros_construccion, 2, ".", ","),
				'valor_construccion' => number_format($valor_construccion, 2, ".", ","),
				'total_valor_fisico' => number_format($total_valor_fisico, 2, ".", ",")
			);
		}
		return $response;
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /aefconstrucciones/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id) {
		$row = AefConstrucciones::find($id);
		if ($row) {
			$row->delete($id);

			$rowEnfoqueFisico = AvaluosFisico::find($row->idavaluoenfoquefisico);
			return Response::json(array('success' => true, 'message' => '!El registro fue eliminado satisfactoriamente!',
				'valor_construccion' => number_format($rowEnfoqueFisico->valor_construccion, 2, ".", ","), 
				'total_metros_construccion' => number_format($rowEnfoqueFisico->total_metros_construccion, 2, ".", ","), 
				'total_valor_fisico' => number_format($rowEnfoqueFisico->total_valor_fisico, 2, ".", ",")));
		} else {
			return Response::json(array('success' => false, 'message' => '!El registro no existe!'));
		}
	}

	private function validate(&$inputs) {
		$inputs["edad_construcciones"] = number_format( (float) $inputs["edad_construcciones"], 2, ".", "");
		$inputs["valor_nuevo_construcciones"] = number_format( (float) $inputs["valor_nuevo_construcciones"], 2, ".", "");
		$inputs["factor_edad_construcciones"] = number_format( (float) $inputs["factor_edad_construcciones"], 2, ".", "");
		$inputs["factor_conservacion_construcciones"] = number_format( (float) $inputs["factor_conservacion_construcciones"], 2, ".", "");
		
		$rules = array(
			'valor_nuevo_construcciones' => array('required', 'numeric', 'min:0.00', 'max:99999999.99'),
			'edad_construcciones' => array('numeric', 'min:0', 'max:999'),
			'factor_edad_construcciones' => array('required', 'numeric', 'min:0.00', 'max:99999999.99'),
			'factor_conservacion_construcciones' => array('required', 'numeric', 'min:0.00', 'max:99999999.99'),
		);
		$messages = array(
			'edad_construcciones.integer' => '¡El valor del campo "Edad" debe ser un entero positivo!',
			'edad_construcciones.min' => '¡El valor mínimo del campo "Edad" debe ser cero!',
			'edad_construcciones.max' => '¡El valor máximo del campo "Edad" debe ser 99999999.99!',
			
			'valor_nuevo_construcciones.required' => '¡El campo "V.R. Nuevo" es requerido!',
			'valor_nuevo_construcciones.numeric' => '¡El valor del campo "V.R. Nuevo" debe ser numérico!',
			'valor_nuevo_construcciones.min' => '¡El valor mínimo del campo "V.R. Nuevo" debe ser cero!',
			'valor_nuevo_construcciones.max' => '¡El valor máximo del campo "V.R. Nuevo" debe ser 99999999.99!',

			'factor_edad_construcciones.numeric' => '¡El valor del campo "Factor Edad" debe ser un entero positivo!',
			'factor_edad_construcciones.min' => '¡El valor mínimo del campo "Factor Edad" debe ser cero!',
			'factor_edad_construcciones.max' => '¡El valor máximo del campo "Factor Edad" debe ser 99999999.99!',
			
			'factor_conservacion_construcciones.numeric' => '¡El valor del campo "Factor Conservación" debe ser un entero positivo!',
			'factor_conservacion_construcciones.min' => '¡El valor mínimo del campo "Factor Conservación" debe ser cero!',
			'factor_conservacion_construcciones.max' => '¡El valor máximo del campo "Factor Conservación" debe ser 99999999.99!',
			
		);
		return Validator::make($inputs, $rules, $messages);
	}

}
