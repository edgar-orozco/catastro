<?php

class corevat_CatFactoresFrenteController extends \BaseController {

	protected $catalogo;

	/**
	 * Instancia del catalogo de aplanados [COREVAT]
	 * @var Catalogo de aplanados [COREVAT]
	 */
	public function __construct(CatFactoresFrente $catalogo) {
		$this->catalogo = $catalogo;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($format = 'html') {
		$title = 'COREVAT';
		$title_section = 'Catálogo Factores Frente';
		$titleGrid = 'Catálogo Factores Frente';
		$row = $this->catalogo;
		$rows = CatFactoresFrente::orderBy('factor_frente')->get();
		return ($format == 'json') ? $rows : View::make('CorevatCatalogos.CatFactoresFrente.index', compact('title', 'title_section', 'row', 'rows', 'titleGrid'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		$title = 'COREVAT';
		$title_section = 'Catálogo Factores Frente';
		$titleGrid = 'Catálogo Factores Frente';
		$row = $this->catalogo;
		$row->status_factor_frente = 1;
		$rows = CatFactoresFrente::orderBy('factor_frente')->get();
		return View::make('CorevatCatalogos.CatFactoresFrente.create', compact('title', 'title_section', 'row', 'rows', 'titleGrid'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store($format = 'html') {
		$id=Input::get('id');
		$inputs = Input::All();
		$rules = array(
			'factor_frente' => 'required',
			'valor_factor_frente' => 'required',
		);
		$messages = array(
			'required' => 'El campo es requerido',
		);
		$validate = Validator::make($inputs, $rules, $messages);
		if ($validate->fails()) {
			return Redirect::back()->withInput()->withErrors($validate);
		}  else {
			$row = new CatFactoresFrente;
			$row->factor_frente = $inputs["factor_frente"];
			$row->valor_factor_frente = $inputs["valor_factor_frente"];
			$row->status_factor_frente = isset($inputs["status_factor_frente"]) ? $inputs["status_factor_frente"] : 0;
			$row->idemp = 1;
			$row->ip = $_SERVER['REMOTE_ADDR'];
			$row->host = isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : '';
			$row->creado_por = 1;
			$row->creado_el = date('Y-m-d H:i:s');
			$row->save();
			return Redirect::to('corevat/CatFactoresFrente/create')->with('success', '¡Se ha creado correctamente el registro!');
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
		$title_section = 'Catálogo Factores Frente';
		$titleGrid = 'Catálogo Factores Frente';
		$row = CatFactoresFrente::find($id);
		$rows = CatFactoresFrente::orderBy('factor_frente')->get();
		$id = $row->idfactorfrente;
		return View::make('CorevatCatalogos.CatFactoresFrente.edit', compact('title', 'title_section', 'row', 'rows', 'id', 'titleGrid'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, $format = 'html') {
		$inputs = Input::All();
		$row = CatFactoresFrente::find($id);
		$rules = array(
			'factor_frente' => 'required',
			'valor_factor_frente' => 'required',
		);
		$messages = array(
			'required' => 'El campo es requerido',
		);
		$validate = Validator::make($inputs, $rules, $messages);
		if ($validate->fails()) {
			return Redirect::back()->withInput()->withErrors($validate);
		} else {
			$row->factor_frente = $inputs["factor_frente"];
			$row->valor_factor_frente = $inputs["valor_factor_frente"];
			$row->status_factor_frente = isset($inputs["status_factor_frente"]) ? $inputs["status_factor_frente"] : 0;
			$row->modi_por = 1;
			$row->modi_el = date('Y-m-d H:i:s');
			$row->save();
			return Redirect::to('corevat/CatFactoresFrente/' . $id . '/edit')->with('success', '¡La modificación se efectuo correctamente!');
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id = null) {
        $row = CatFactoresFrente::findOrFail($id);
		try {
	        $row->delete($id);
			return Redirect::to('corevat/CatFactoresFrente')->with('success', '¡La eliminación se efectuo correctamente!');
		} catch (\Illuminate\Database\QueryException $ex) {
			return Redirect::back()->with('error', $ex->getMessage());
		}
        
	}
}
