<?php

class corevat_CatFactoresUbicacionController extends \BaseController {

	protected $catalogo;

	/**
	 * Instancia del catalogo de aplanados [COREVAT]
	 * @var Catalogo de aplanados [COREVAT]
	 */
	public function __construct(CatFactoresUbicacion $catalogo) {
		$this->catalogo = $catalogo;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($format = 'html') {
		$title = 'COREVAT';
		$title_section = 'Catálogo Factores Ubicación';
		$titleGrid = 'Catálogo Factores Ubicación';
		$row = $this->catalogo;
		$rows = CatFactoresUbicacion::orderBy('factor_ubicacion')->get();
		return ($format == 'json') ? $rows : View::make('CorevatCatalogos.CatFactoresUbicacion.index', compact('title', 'title_section', 'row', 'rows', 'titleGrid'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		$title = 'COREVAT';
		$title_section = 'Catálogo Factores Ubicación';
		$titleGrid = 'Catálogo Factores Ubicación';
		$row = $this->catalogo;
		$row->status_factor_ubicacion = 1;
		$rows = CatFactoresUbicacion::orderBy('factor_ubicacion')->get();
		return View::make('CorevatCatalogos.CatFactoresUbicacion.create', compact('title', 'title_section', 'row', 'rows', 'titleGrid'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store($format = 'html') {
		$id=Input::get('id');
		$inputs = Input::All();
		$inputs['valor_minimo'] = number_format((float) $inputs['valor_minimo'], 2, '.', '');
		$inputs['valor_maximo'] = number_format((float) $inputs['valor_maximo'], 2, '.', '');
		$rules = array(
			'valor_minimo' => array('before:valor_maximo'),
			'valor_maximo' => array('after:valor_minimo'),
		);
		$messages = array(
			'valor_minimo.before' => '¡El "Valor mínimo" debe ser menor al "Valor Máximo!',
			'valor_maximo.after' => '¡El "Valor máximo" debe ser mayor al "Valor Mínimo!',
		);
		$validate = Validator::make($inputs, $rules, $messages);
		if ($validate->fails()) {
			return Redirect::back()->withInput()->withErrors($validate);
		}  else {
			$row = new CatFactoresUbicacion;
			$row->factor_ubicacion = $inputs["factor_ubicacion"];
			$row->valor_factor_ubicacion = 0;
			$row->valor_minimo = $inputs["valor_minimo"];
			$row->valor_maximo = $inputs["valor_maximo"];
			$row->status_factor_ubicacion = isset($inputs["status_factor_ubicacion"]) ? $inputs["status_factor_ubicacion"] : 0;
			$row->idemp = 1;
			$row->ip = $_SERVER['REMOTE_ADDR'];
			$row->host = isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : '';
			$row->creado_por = 1;
			$row->creado_el = date('Y-m-d H:i:s');
			$row->save();
			return Redirect::to('corevat/CatFactoresUbicacion/create')->with('success', '¡Se ha creado correctamente el registro!');
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
		$title_section = 'Catálogo Factores Ubicación';
		$titleGrid = 'Catálogo Factores Ubicación';
		$row = CatFactoresUbicacion::find($id);
		$rows = CatFactoresUbicacion::orderBy('factor_ubicacion')->get();
		$id = $row->idfactorubicacion;
		return View::make('CorevatCatalogos.CatFactoresUbicacion.edit', compact('title', 'title_section', 'row', 'rows', 'id', 'titleGrid'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, $format = 'html') {
		$inputs = Input::All();
		$row = CatFactoresUbicacion::find($id);
		$inputs['valor_minimo'] = number_format((float) $inputs['valor_minimo'], 2, '.', '');
		$inputs['valor_maximo'] = number_format((float) $inputs['valor_maximo'], 2, '.', '');
		$rules = array(
			'valor_minimo' => array('before:valor_maximo'),
			'valor_maximo' => array('after:valor_minimo'),
		);
		$messages = array(
			'valor_minimo.before' => '¡El "Valor mínimo" debe ser menor al "Valor Máximo!',
			'valor_maximo.after' => '¡El "Valor máximo" debe ser mayor al "Valor Mínimo!',
		);
		$validate = Validator::make($inputs, $rules, $messages);
		if ($validate->fails()) {
			return Redirect::back()->withInput()->withErrors($validate);
		} else {
			$row->factor_ubicacion = $inputs["factor_ubicacion"];
			$row->valor_factor_ubicacion = 0;
			$row->valor_minimo = $inputs["valor_minimo"];
			$row->valor_maximo = $inputs["valor_maximo"];
			$row->status_factor_ubicacion = isset($inputs["status_factor_ubicacion"]) ? $inputs["status_factor_ubicacion"] : 0;
			$row->modi_por = 1;
			$row->modi_el = date('Y-m-d H:i:s');
			$row->save();
			return Redirect::to('corevat/CatFactoresUbicacion/' . $id . '/edit')->with('success', '¡La modificación se efectuo correctamente!');
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id = null) {
		$row = CatFactoresUbicacion::findOrFail($id);
		try {
			$row->delete($id);
			return Redirect::to('corevat/CatFactoresUbicacion')->with('success', '¡La eliminación se efectuo correctamente!');
		} catch (\Illuminate\Database\QueryException $ex) {
			//$ex->getMessage()
			return Redirect::back()->with('error', '¡EL REGISTRO NO PUEDE SER ELIMINADO DEBIDO A QUE ESTA SIENDO UTILIZADO POR ALGUN AVALUO!');
		}
	}

}
