<?php

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
		/*
		$row->idtipo = 1;
		$row->idfactorconservacion = 1;
		$row->cat_tipo = CatTipo::orderBy('tipo')->get();
		$row->cat_factores_conservacion = CatFactoresConservacion::orderBy('valor_factor_conservacion')->get();
		 * 
		 */
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
			AefConstrucciones::insAefConstrucciones($inputs, $total_metros_construccion, $valor_construccion, $total_valor_fisico);
			$total_metros_construccion = number_format($total_metros_construccion, 2, ".", ",");
			$valor_construccion = number_format($valor_construccion, 2, ".", ",");
			$total_valor_fisico = number_format($total_valor_fisico, 2, ".", ",");
			$response = array(
				'success' => true,
				'message' => '¡El registro fue ingresado satisfactoriamente!',
				'total_metros_construccion' => $total_metros_construccion,
				'valor_construccion' => $valor_construccion,
				'total_valor_fisico' => $total_valor_fisico
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
		/*
		$row->idfactorconservacion = CatFactoresConservacion::getIdByValue($row->factor_conservacion);
		$row->cat_tipo = CatTipo::orderBy('tipo')->get();
		$row->cat_factores_conservacion = CatFactoresConservacion::orderBy('valor_factor_conservacion')->get();
		 * 
		 */
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
			AefConstrucciones::updAefConstrucciones($inputs, $total_metros_construccion, $valor_construccion, $total_valor_fisico);
			$total_metros_construccion = number_format($total_metros_construccion, 2, ".", ",");
			$valor_construccion = number_format($valor_construccion, 2, ".", ",");
			$total_valor_fisico = number_format($total_valor_fisico, 2, ".", ",");
			$response = array(
				'success' => true,
				'message' => '¡El registro fue modificado satisfactoriamente!',
				'total_metros_construccion' => $total_metros_construccion,
				'valor_construccion' => $valor_construccion,
				'total_valor_fisico' => $total_valor_fisico
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
			$idavaluoenfoquefisico = $row->idavaluoenfoquefisico;
			$row->delete($id);

			//Set @VPC = (Select sum(valor_parcial_construccion) as nsuma from aef_construcciones where idavaluoenfoquefisico = old.idavaluoenfoquefisico);
			$VPC = AefConstrucciones::select(DB::raw('sum(valor_parcial_construccion) AS nsuma'))->where('idavaluoenfoquefisico', '=', $idavaluoenfoquefisico)->first();

			// Set @TMC = (Select sum(superficie_m2) as msuma from aef_construcciones where idavaluoenfoquefisico = old.idavaluoenfoquefisico);
			$TMC = AefConstrucciones::select(DB::raw('sum(superficie_m2) AS msuma'))->where('idavaluoenfoquefisico', '=', $idavaluoenfoquefisico)->first();

			//update avaluo_enfoque_fisico set valor_construccion = @VPC, total_metros_construccion = @TMC where idavaluoenfoquefisico = old.idavaluoenfoquefisico;
			$rowEnfoqueFisico = AvaluosFisico::find($idavaluoenfoquefisico);
			$rowEnfoqueFisico->valor_construccion = ( is_null($VPC->nsuma) ? 0 : $VPC->nsuma);
			$rowEnfoqueFisico->total_metros_construccion = ( is_null($TMC->msuma) ? 0 : $TMC->msuma);
			$rowEnfoqueFisico->total_valor_fisico = AvaluosFisico::updBeforeAvaluoEnfoqueFisico($rowEnfoqueFisico);
			$rowEnfoqueFisico->save();
			AvaluosFisico::updAfterAvaluoEnfoqueFisico($rowEnfoqueFisico->idavaluo, $rowEnfoqueFisico->total_valor_fisico);
			return Response::json(array('success' => true, 'message' => '!El registro fue eliminado satisfactoriamente!'));
		} else {
			return Response::json(array('success' => false, 'message' => '!El registro no existe!'));
		}
	}

	private function validate(&$inputs) {
		$inputs["edad_construcciones"] = (float) $inputs["edad_construcciones"];
		$inputs["valor_nuevo_construcciones"] = (float) $inputs["valor_nuevo_construcciones"];
		
		$rules = array(
			'valor_nuevo_construcciones' => array('required', 'numeric', 'min:0.00', 'max:99999999.99'),
			'edad_construcciones' => array('numeric', 'min:0', 'max:999', 'regex:/^[0-9]{1,3}$/'),
		);
		$messages = array(
			'edad_construcciones.integer' => '¡El valor del campo "Edad" debe ser un entero positivo!',
			'edad_construcciones.min' => '¡El valor mínimo del campo "Edad" debe ser cero!',
			'edad_construcciones.max' => '¡El valor máximo del campo "Edad" debe ser 99999999.99!',
			'edad_construcciones.regex' => '¡El formato del campo "Edad" debe ser 999!',
			
			'valor_nuevo_construcciones.required' => '¡El campo "V.R. Nuevo" es requerido!',
			'valor_nuevo_construcciones.numeric' => '¡El valor del campo "V.R. Nuevo" debe ser numérico!',
			'valor_nuevo_construcciones.min' => '¡El valor mínimo del campo "V.R. Nuevo" debe ser cero!',
			'valor_nuevo_construcciones.max' => '¡El valor máximo del campo "V.R. Nuevo" debe ser 99999999.99!',
		);
		return Validator::make($inputs, $rules, $messages);
	}

}
