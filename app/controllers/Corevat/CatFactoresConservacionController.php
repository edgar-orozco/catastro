<?php

class corevat_CatFactoresConservacionController extends \BaseController {

	protected $catalogo;

	/**
	 * Instancia del catalogo de aplanados [COREVAT]
	 * @var Catalogo de aplanados [COREVAT]
	 */
	public function __construct(CatFactoresConservacion $catalogo) {
		$this->catalogo = $catalogo;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($format = 'html') {
		$title = 'COREVAT';
		$title_section = 'Catálogo de Factores Conservacion';
		$titleGrid = 'Catálogo de Factores Conservacion';
		$row = $this->catalogo;
		$rows = CatFactoresConservacion::orderBy('abr_factor_conservacion')->get();
		return ($format == 'json') ? $rows : View::make('CorevatCatalogos.CatFactoresConservacion.index', compact('title', 'title_section', 'row', 'rows', 'titleGrid'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		$title = 'COREVAT';
		$title_section = 'Catálogo de Factores Conservacion';
		$titleGrid = 'Catálogo de Factores Conservacion';
		$row = $this->catalogo;
		$row->status_factor_conservacion = 1;
		$rows = CatFactoresConservacion::orderBy('abr_factor_conservacion')->get();
		return View::make('CorevatCatalogos.CatFactoresConservacion.create', compact('title', 'title_section', 'row', 'rows', 'titleGrid'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store($format = 'html') {
		$id=Input::get('id');
		$inputs = Input::All();
		$inputs['factor_conservacion'] = strtoupper($inputs['factor_conservacion']);
		$inputs['valor_factor_conservacion'] = number_format((float) $inputs['valor_factor_conservacion'], 2, '.', '');
		$rules = array(
			'valor_factor_conservacion' => 'numeric|min:0.0000|max:1.0000',
		);
		$messages = array(
			'valor_factor_conservacion.numeric' => '¡El campo "Valor" debe ser un número!',
			'valor_factor_conservacion.min' => '¡El valor mínimo del campo "Valor" debe ser mayor a cero!',
			'valor_factor_conservacion.max' => '¡El valor máximo del campo "Valor" debe ser 1.000!',
		);
		$validate = Validator::make($inputs, $rules, $messages);
		if ($validate->fails()) {
			return Redirect::back()->withInput()->withErrors($validate);
		}  else {
			$row = new CatFactoresConservacion;
			$row->abr_factor_conservacion = $inputs["abr_factor_conservacion"];
			$row->factor_conservacion = $inputs["factor_conservacion"];
			$row->valor_factor_conservacion = $inputs["valor_factor_conservacion"];
			$row->status_factor_conservacion = isset($inputs["status_factor_conservacion"]) ? $inputs["status_factor_conservacion"] : 0;
			$row->idemp = 1;
			$row->ip = $_SERVER['REMOTE_ADDR'];
			$row->host = isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : '';
			$row->creado_por = 1;
			$row->creado_el = date('Y-m-d H:i:s');
			$row->save();
			return Redirect::to('corevat/CatFactoresConservacion/create')->with('success', '¡Se ha creado correctamente el registro!');
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id) {
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id) {
		$title = 'COREVAT';
		$title_section = 'Catálogo de Factores Conservacion';
		$titleGrid = 'Catálogo de Factores Conservacion';
		$row = CatFactoresConservacion::find($id);
		$rows = CatFactoresConservacion::orderBy('abr_factor_conservacion')->get();
		$id = $row->idfactorconservacion;
		$row->valor_factor_conservacion = round((float) $row->valor_factor_conservacion, 2);
		return View::make('CorevatCatalogos.CatFactoresConservacion.edit', compact('title', 'title_section', 'row', 'rows', 'id', 'titleGrid'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, $format = 'html') {
		$inputs = Input::All();
		$row = CatFactoresConservacion::find($id);
		$inputs['abr_factor_conservacion'] = strtoupper($inputs['abr_factor_conservacion']);
		$inputs['factor_conservacion'] = strtoupper($inputs['factor_conservacion']);
		$inputs['valor_factor_conservacion'] = number_format((float) $inputs['valor_factor_conservacion'], 2, '.', '');
		$rules = array(
			'valor_factor_conservacion' => 'numeric|min:0.0000|max:1.0000',
		);
		$messages = array(
			'valor_factor_conservacion.numeric' => '¡El campo "Valor" debe ser un número!',
			'valor_factor_conservacion.min' => '¡El valor mínimo del campo "Valor" debe ser mayor a cero!',
			'valor_factor_conservacion.max' => '¡El valor máximo del campo "Valor" debe ser 1.000!',
		);
		$validate = Validator::make($inputs, $rules, $messages);
		if ($validate->fails()) {
			return Redirect::back()->withInput()->withErrors($validate);
		} else {
			$row->abr_factor_conservacion = $inputs["abr_factor_conservacion"];
			$row->factor_conservacion = $inputs["factor_conservacion"];
			$row->valor_factor_conservacion = $inputs["valor_factor_conservacion"];
			$row->status_factor_conservacion = isset($inputs["status_factor_conservacion"]) ? $inputs["status_factor_conservacion"] : 0;
			$row->modi_por = 1;
			$row->modi_el = date('Y-m-d H:i:s');
			$row->save();
			return Redirect::to('corevat/CatFactoresConservacion/' . $id . '/edit')->with('success', '¡La modificación se efectuo correctamente!');
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id = null) {
		$row = CatFactoresConservacion::findOrFail($id);
		try {
			$row->delete($id);
			return Redirect::to('corevat/CatFactoresConservacion')->with('success', '¡La eliminación se efectuo correctamente!');
		} catch (\Illuminate\Database\QueryException $ex) {
			return Redirect::back()->with('error', $ex->getMessage());
		}
	}

}
