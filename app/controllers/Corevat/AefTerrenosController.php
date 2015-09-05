<?php
use Carbon\Carbon;

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
		$row->indiviso = $ai->indiviso_terreno;

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
			$inputs["created_at"] = Carbon::now()->format('Y-m-d H:i:s');
			AefTerrenos::insAefTerrenos($inputs, $valor_terreno, $total_valor_fisico);
			$response = array('success' => true, 'message' => '¡El registro fue ingresado satisfactoriamente!', 'valor_terreno' => number_format($valor_terreno, 2, ".", ","), 'total_valor_fisico' => number_format($total_valor_fisico, 2, ".", ","));
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
			$inputs["updated_at"] = Carbon::now()->format('Y-m-d H:i:s');
			AefTerrenos::updAefTerrenos($inputs, $valor_terreno, $total_valor_fisico);
			$response = array('success' => true, 'message' => '¡El registro fue modificado satisfactoriamente!', 'valor_terreno' => number_format($valor_terreno, 2, ".", ","), 'total_valor_fisico' => number_format($total_valor_fisico, 2, ".", ","));
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
			$row->delete($id);
			$rowAef = AvaluosFisico::find($row->idavaluoenfoquefisico);
			return Response::json(array('success' => true, 'message' => '!El registro fue eliminado satisfactoriamente!', 'valor_terreno' => number_format($rowAef->valor_terreno, 2, ".", ","), 'total_valor_fisico' => number_format($rowAef->total_valor_fisico, 2, ".", ",")));
		} else {
			return Response::json(array('success' => false, 'message' => '!El registro no existe!'));
		}
	}

	private function validate(&$inputs) {
		$inputs["irregular"] = number_format((float) $inputs["irregular"], 2, ".", "");
		$inputs["top_terrenos"] = number_format((float) $inputs["top_terrenos"], 2, ".", "");
		$inputs["frente"] = number_format((float) $inputs["frente"], 2, ".", "");
		$inputs["forma"] = number_format((float) $inputs["forma"], 2, ".", "");
		$inputs["otros"] = number_format((float) $inputs["otros"], 2, ".", "");

		$rules = array(
			'irregular' => array('required', 'numeric', 'min:0.00', 'max:99999999.99', 'regex:/^[0-9]{1,8}(\.?){1}[0-9]{1,2}$/'),
			'top_terrenos' => array('required', 'numeric', 'min:0.00', 'max:99999999.99', 'regex:/^[0-9]{1,8}(\.?){1}[0-9]{1,2}$/'),
			'frente' => array('required', 'numeric', 'min:0.00', 'max:99999999.99', 'regex:/^[0-9]{1,8}(\.?){1}[0-9]{1,2}$/'),
			'forma' => array('required', 'numeric', 'min:0.00', 'max:99999999.99', 'regex:/^[0-9]{1,8}(\.?){1}[0-9]{1,2}$/'),
			'otros' => array('required', 'numeric', 'min:0.00', 'max:99999999.99', 'regex:/^[0-9]{1,8}(\.?){1}[0-9]{1,2}$/'),
		);
		$messages = array(
			'irregular.required' => '¡El campo "Irregular" es requerido!',
			'irregular.numeric' => '¡El valor del campo "Irregular" debe ser numérico!',
			'irregular.min' => '¡El valor mínimo del campo "Irregular" debe ser cero!',
			'irregular.max' => '¡El valor máximo del campo "Irregular" debe ser 9999999999.99!',
			'irregular.regex' => '¡El formato del campo "Irregular" debe ser 9999999999.99!',
			
			'top_terrenos.required' => '¡El campo "Top" es requerido!',
			'top_terrenos.numeric' => '¡El valor del campo "Top" debe ser numérico!',
			'top_terrenos.min' => '¡El valor mínimo del campo "Top" debe ser cero!',
			'top_terrenos.max' => '¡El valor máximo del campo "Top" debe ser 9999999999.99!',
			'top_terrenos.regex' => '¡El formato del campo "Top" debe ser 9999999999.99!',
			
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
		);
		return Validator::make($inputs, $rules, $messages);
	}

}
