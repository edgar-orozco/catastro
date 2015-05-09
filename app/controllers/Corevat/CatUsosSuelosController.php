<?php

class corevat_CatUsosSuelosController extends \BaseController {

	protected $catalogo;

	/**
	 * Instancia del catalogo de aplanados [COREVAT]
	 * @var Catalogo de aplanados [COREVAT]
	 */
	public function __construct(CatUsosSuelos $catalogo) {
		$this->catalogo = $catalogo;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($format = 'html') {
		$title = 'COREVAT';
		$title_section = 'Catálogo de Usos de Suelo';
		$titleGrid = 'Catálogo de Usos de Suelo';
		$row = $this->catalogo;
		$rows = CatUsosSuelos::orderBy('usos_suelos')->get();
		return ($format == 'json') ? $rows : View::make('CorevatCatalogos.CatUsosSuelos.index', compact('title', 'title_section', 'row', 'rows', 'titleGrid'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		$title = 'COREVAT';
		$title_section = 'Catálogo de Usos de Suelo';
		$titleGrid = 'Catálogo de Usos de Suelo';
		$row = $this->catalogo;
		$row->status_usos_suelos = 1;
		$rows = CatUsosSuelos::orderBy('usos_suelos')->get();
		return View::make('CorevatCatalogos.CatUsosSuelos.create', compact('title', 'title_section', 'row', 'rows', 'titleGrid'));
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
			'usos_suelos' => 'required',
		);
		$messages = array(
			'required' => 'El campo es requerido',
		);
		$validate = Validator::make($inputs, $rules, $messages);
		if ($validate->fails()) {
			return Redirect::back()->withInput()->withErrors($validate);
		}  else {
			$row = new CatUsosSuelos;
			$row->usos_suelos = $inputs["usos_suelos"];
			$row->status_usos_suelos = isset($inputs["status_usos_suelos"]) ? $inputs["status_usos_suelos"] : 0;
			$row->idemp = 1;
			$row->ip = $_SERVER['REMOTE_ADDR'];
			$row->host = isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : '';
			$row->creado_por = 1;
			$row->creado_el = date('Y-m-d H:i:s');
			$row->save();
			return Redirect::to('corevat/CatUsosSuelos/create')->with('success', '¡Se ha creado correctamente el registro!');
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
		$title_section = 'Catálogo de Usos de Suelo';
		$titleGrid = 'Catálogo de Usos de Suelo';
		$row = CatUsosSuelos::find($id);
		$rows = CatUsosSuelos::orderBy('usos_suelos')->get();
		$id = $row->idusossuelos;
		return View::make('CorevatCatalogos.CatUsosSuelos.edit', compact('title', 'title_section', 'row', 'rows', 'id', 'titleGrid'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, $format = 'html') {
		$inputs = Input::All();
		$row = CatUsosSuelos::find($id);
		$rules = array(
			'usos_suelos' => 'required',
		);
		$messages = array(
			'required' => 'El campo es requerido',
		);
		$validate = Validator::make($inputs, $rules, $messages);
		if ($validate->fails()) {
			return Redirect::back()->withInput()->withErrors($validate);
		} else {
			$row->usos_suelos = $inputs["usos_suelos"];
			$row->status_usos_suelos = isset($inputs["status_usos_suelos"]) ? $inputs["status_usos_suelos"] : 0;
			$row->modi_por = 1;
			$row->modi_el = date('Y-m-d H:i:s');
			$row->save();
			return Redirect::to('corevat/CatUsosSuelos/' . $id . '/edit')->with('success', '¡La modificación se efectuo correctamente!');
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id = null) {
        $row = CatUsosSuelos::findOrFail($id);
		try {
	        $row->delete($id);
			return Redirect::to('corevat/CatUsosSuelos')->with('success', '¡La eliminación se efectuo correctamente!');
		} catch (\Illuminate\Database\QueryException $ex) {
			return Redirect::back()->with('error', $ex->getMessage());
		}
        
	}

}
