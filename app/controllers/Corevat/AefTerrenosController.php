<?php

class corevat_AefTerrenosController extends \BaseController {

	/**
	 * Show the form for creating a new resource.
	 * GET /aefterrenos/create
	 *
	 * @return Response
	 */
	public function getAjax($id) {
		return AefTerrenos::getAjaxAefTerrenosByFk($id);
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /aefconstrucciones/create
	 *
	 * @return Response
	 */
	public function create($idaef) {
		$row = new AefTerrenos();
		$af = AvaluosFisico::select('idavaluo')->where('idavaluoenfoquefisico', '=', $idaef)->first();
		$ai = AvaluosInmueble::select('superficie_total_terreno')->where('idavaluo', '=', $af->idavaluo)->first();
		$row->superficie = $ai->superficie_total_terreno;

		return $row;
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /aefconstrucciones
	 *
	 * @return Response
	 */
	public function store() {
		$valor_terreno = 0;
		$total_valor_fisico = 0;
		$inputs = Input::All();
		$validate = $this->validate($inputs);
		if ($validate->fails()) {
			$response = array('success' => false, 'errors' => $validate->getMessageBag()->toArray());
		} else {
			AefTerrenos::insAefTerrenos($inputs, $valor_terreno, $total_valor_fisico);
			$valor_terreno = number_format($valor_terreno, 2, ".", ",");
			$total_valor_fisico = number_format($total_valor_fisico, 2, ".", ",");
			$response = array('success' => true, 'message' => '¡El registro fue ingresado satisfactoriamente!', 'valor_terreno' => $valor_terreno, 'total_valor_fisico' => $total_valor_fisico);
		}
		return $response;
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /aefterrenos/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id) {
		$row = AefTerrenos::find($id);
		return $row;
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /aefterrenos/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update() {
		$valor_terreno = 0;
		$total_valor_fisico = 0;
		$inputs = Input::All();
		$validate = $this->validate($inputs);
		if ($validate->fails()) {
			$response = array('success' => false, 'errors' => $validate->getMessageBag()->toArray());
		} else {
			AefTerrenos::updAefTerrenos($inputs, $valor_terreno, $total_valor_fisico);
			$valor_terreno = number_format($valor_terreno, 2, ".", ",");
			$total_valor_fisico = number_format($total_valor_fisico, 2, ".", ",");
			$response = array('success' => true, 'message' => '¡El registro fue modificado satisfactoriamente!', 'valor_terreno' => $valor_terreno, 'total_valor_fisico' => $total_valor_fisico);
		}
		return $response;
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /aefterrenos/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id) {
		$row = AefTerrenos::find($id);
		if ($row) {
			$idavaluoenfoquefisico = $row->idavaluoenfoquefisico;
			$row->delete($id);
			$Val = AefTerrenos::select(DB::raw('sum(valor_parcial) AS valorpar'))->where('idavaluoenfoquefisico', '=', $idavaluoenfoquefisico)->first();
			$rowEnfoqueFisico = AvaluosFisico::find($idavaluoenfoquefisico);
			$rowEnfoqueFisico->valor_terreno = ( is_null($Val->valorpar) ? 0 : $Val->valorpar);
			$rowEnfoqueFisico->total_valor_fisico = AvaluosFisico::updBeforeAvaluoEnfoqueFisico($rowEnfoqueFisico);
			$rowEnfoqueFisico->save();
			AvaluosFisico::updAfterAvaluoEnfoqueFisico($rowEnfoqueFisico->idavaluo, $rowEnfoqueFisico->total_valor_fisico);
			$valor_terreno = $rowEnfoqueFisico->valor_terreno;
			return Response::json(array('success' => true, 'message' => '!El registro fue eliminado satisfactoriamente!', 'valor_terreno' => $valor_terreno));
		} else {
			return Response::json(array('success' => false, 'message' => '!El registro no existe!'));
		}
	}

	private function validate(&$inputs) {
		$inputs["irregular"] = number_format((float) $inputs["irregular"], 2, ".", "");
		$inputs["top"] = number_format((float) $inputs["top"], 2, ".", "");
		$inputs["frente"] = number_format((float) $inputs["frente"], 2, ".", "");
		$inputs["forma"] = number_format((float) $inputs["forma"], 2, ".", "");
		$inputs["otros"] = number_format((float) $inputs["otros"], 2, ".", "");
		$inputs["indiviso_terrenos"] = number_format((float) $inputs["indiviso_terrenos"], 2, ".", "");
		
		$rules = array(
			'irregular' => array('required', 'numeric', 'min:0.00', 'max:9999999999.99', 'regex:/^[0-9]{1,10}(\.?){1}[0-9]{1,2}$/'),
			'top' => array('required', 'numeric', 'min:0.00', 'max:9999999999.99', 'regex:/^[0-9]{1,10}(\.?){1}[0-9]{1,2}$/'),
			'frente' => array('required', 'numeric', 'min:0.00', 'max:9999999999.99', 'regex:/^[0-9]{1,10}(\.?){1}[0-9]{1,2}$/'),
			'forma' => array('required', 'numeric', 'min:0.00', 'max:9999999999.99', 'regex:/^[0-9]{1,10}(\.?){1}[0-9]{1,2}$/'),
			'otros' => array('required', 'numeric', 'min:0.00', 'max:9999999999.99', 'regex:/^[0-9]{1,10}(\.?){1}[0-9]{1,2}$/'),
			'indiviso_terrenos' => array('required', 'numeric', 'min:0.00', 'max:100.00', 'regex:/^[0-9]{1,3}(\.?)[0-9]{1,2}$/'),
		);
		$messages = array(
			'irregular.required' => '¡El campo "Irregular" es requerido!',
			'irregular.numeric' => '¡El valor del campo "Irregular" debe ser numérico!',
			'irregular.min' => '¡El valor mínimo del campo "Irregular" debe ser cero!',
			'irregular.max' => '¡El valor máximo del campo "Irregular" debe ser 9999999999.99!',
			'irregular.regex' => '¡El formato del campo "Irregular" debe ser 9999999999.99!',
			
			'top.required' => '¡El campo "Top" es requerido!',
			'top.numeric' => '¡El valor del campo "Top" debe ser numérico!',
			'top.min' => '¡El valor mínimo del campo "Top" debe ser cero!',
			'top.max' => '¡El valor máximo del campo "Top" debe ser 9999999999.99!',
			'top.regex' => '¡El formato del campo "Top" debe ser 9999999999.99!',
			
			'frente.required' => '¡El campo "Frente" es requerido!',
			'frente.numeric' => '¡El valor del campo "Frente" debe ser numérico!',
			'frente.min' => '¡El valor mínimo del campo "Frente" debe ser cero!',
			'frente.max' => '¡El valor máximo del campo "Frente" debe ser 9999999999.99!',
			'frente.regex' => '¡El formato del campo "Frente" debe ser 9999999999.99!',
			
			'forma.required' => '¡El campo "Forma" es requerido!',
			'forma.numeric' => '¡El valor del campo "Forma" debe ser numérico!',
			'forma.min' => '¡El valor mínimo del campo "Forma" debe ser cero!',
			'forma.max' => '¡El valor máximo del campo "Forma" debe ser 9999999999.99!',
			'forma.regex' => '¡El formato del campo "Forma" debe ser 9999999999.99!',
			
			'otros.required' => '¡El campo "Otros" es requerido!',
			'otros.numeric' => '¡El valor del campo "Otros" debe ser numérico!',
			'otros.min' => '¡El valor mínimo del campo "Otros" debe ser cero!',
			'otros.max' => '¡El valor máximo del campo "Otros" debe ser 9999999999.99!',
			'otros.regex' => '¡El formato del campo "Otros" debe ser 9999999999.99!',
			
			'indiviso_terrenos.required' => '¡El campo "Indiviso (%)" es requerido!',
			'indiviso_terrenos.numeric' => '¡El valor del campo "Indiviso (%)" debe ser numérico!',
			'indiviso_terrenos.min' => '¡El valor mínimo del campo "Indiviso (%)" debe ser cero!',
			'indiviso_terrenos.max' => '¡El valor máximo del campo "Indiviso (%)" debe ser 100.00!',
			'indiviso_terrenos.regex' => '¡El formato del campo "Indiviso (%)" debe ser 999.99!',
		);
		return Validator::make($inputs, $rules, $messages);
	}

}
