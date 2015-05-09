<?php

class corevat_CatPisosController extends \BaseController {

	protected $catalogo;

	/**
	 * Instancia del catalogo de pisos [COREVAT]
	 * @var Catalogo de aplanados [COREVAT]
	 */
	public function __construct(CatPisos $catalogo) {
		$this->catalogo = $catalogo;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($format = 'html') {
		$title = 'COREVAT';
		$title_section = 'Catálogo de Pisos';
		$titleGrid = 'Catálogo de Pisos';
		$row = $this->catalogo;
		$rows = CatPisos::orderBy('piso')->get();
		return ($format == 'json') ? $rows : View::make('CorevatCatalogos.CatPisos.index', compact('title', 'title_section', 'row', 'rows', 'titleGrid'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		$title = 'COREVAT';
		$title_section = 'Catálogo de Pisos';
		$titleGrid = 'Catálogo de Pisos';
		$row = $this->catalogo;
		$row->status_piso = 1;
		$rows = CatPisos::orderBy('piso')->get();
		return View::make('CorevatCatalogos.CatPisos.create', compact('title', 'title_section', 'row', 'rows', 'titleGrid'));
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
			'piso' => 'required',
		);
		$messages = array(
			'required' => 'El campo es requerido',
		);
		$validate = Validator::make($inputs, $rules, $messages);
		if ($validate->fails()) {
			return Redirect::back()->withInput()->withErrors($validate);
		}  else {
			$row = new CatPisos;
			$row->piso = $inputs["piso"];
			$row->status_piso = isset($inputs["status_piso"]) ? $inputs["status_piso"] : 0;
			$row->idemp = 1;
			$row->ip = $_SERVER['REMOTE_ADDR'];
			$row->host = isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : '';
			$row->creado_por = 1;
			$row->creado_el = date('Y-m-d H:i:s');
			$row->save();
			return Redirect::to('corevat/CatPisos/create')->with('success', '¡Se ha creado correctamente el registro!');
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
		$title_section = 'Catálogo de Pisos';
		$titleGrid = 'Catálogo de Pisos';
		$row = CatPisos::find($id);
		$rows = CatPisos::orderBy('piso')->get();
		$id = $row->idpiso;
		return View::make('CorevatCatalogos.CatPisos.edit', compact('title', 'title_section', 'row', 'rows', 'id', 'titleGrid'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, $format = 'html') {
		$inputs = Input::All();
		$row = CatPisos::find($id);
		$rules = array(
			'piso' => 'required',
		);
		$messages = array(
			'required' => 'El campo es requerido',
		);
		$validate = Validator::make($inputs, $rules, $messages);
		if ($validate->fails()) {
			return Redirect::back()->withInput()->withErrors($validate);
		} else {
			$row->piso = $inputs["piso"];
			$row->status_piso = isset($inputs["status_piso"]) ? $inputs["status_piso"] : 0;
			$row->modi_por = 1;
			$row->modi_el = date('Y-m-d H:i:s');
			$row->save();
			return Redirect::to('corevat/CatPisos/' . $id . '/edit')->with('success', '¡La modificación se efectuo correctamente!');
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id = null) {
        $row = CatPisos::findOrFail($id);
		try {
	        $row->delete($id);
			return Redirect::to('corevat/CatPisos')->with('success', '¡La eliminación se efectuo correctamente!');
		} catch (\Illuminate\Database\QueryException $ex) {
			return Redirect::back()->with('error', $ex->getMessage());
		}
        
	}

}
