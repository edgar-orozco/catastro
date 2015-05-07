<?php

class corevat_EmpresasController extends \BaseController {

	protected $table;

	/**
	 * Instancia del catalogo de empresas [COREVAT]
	 * @var Catalogo de empresas [COREVAT]
	 */
	public function __construct(Empresas $table) {
		$this->table = $table;
	}

	/**
	 * 
	 */
	public function index($format = 'html') {
		$title = 'COREVAT';
		$title_section = 'Catálogo de Empresas';
		$titleGrid = 'Empresas';
		$row = $this->table;
		$rows = Empresas::orderBy('rs', 'asc')->get();
		return ($format == 'json') ? $rows : View::make('CorevatCatalogos.Empresas.index', compact('title', 'title_section', 'row', 'rows', 'titleGrid'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		$title = 'COREVAT';
		$title_section = 'Catálogo de Empresas';
		$titleGrid = 'Catálogo de Empresas';
		$row = $this->table;
		$rows = Empresas::orderBy('rs', 'asc')->get();
		return View::make('CorevatCatalogos.Empresas.create', compact('title', 'title_section', 'row', 'rows', 'titleGrid'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store($format = 'html') {
		$id = Input::get('id');
		$inputs = Input::All();
		$rules = array(
			'rs' => 'required',
			'ncomer' => 'required',
			'df' => 'required',
			'rfc' => 'required',
		);
		$validar = Validator::make($inputs, $rules);
		if ($validar->fails()) {
			return Redirect::back()->withInput()->withErrors($validar);
		}  else {
			$row = new Empresas;
			$row->rs = $inputs["rs"];
			$row->ncomer = $inputs["ncomer"];
			$row->df = $inputs["df"];
			$row->rfc = $inputs["rfc"];
			$row->save();
			return Redirect::to('corevat/Empresas/create')->with('success', '¡El registro fue creado satisfactoriamente!');
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
		$row = Empresas::find($id);
		$this->table = $row;
		$title = 'COREVAT';
		$title_section = 'Catálogo de Empresas';
		$titleGrid = 'Catálogo de Empresas';
		$rows = $this->table->all();
		$id = $row->idemp;
		return View::make('CorevatCatalogos.Empresas.edit', compact('title', 'title_section', 'row', 'rows', 'id', 'titleGrid'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 * 
	 * NO HAY VALIDACIONES
	 */
	public function update($id, $format = 'html') {
		$inputs = Input::All();
		$row = Empresas::find($id);
		$rules = array(
			'rs' => 'required',
			'ncomer' => 'required',
			'df' => 'required',
			'rfc' => 'required',
		);
		$messages = array(
			"unique" => "¡Ya existe una empresa con esta razón social!",
		);
		if ($row->rs != $inputs["rs"]) {
			$rules["rs"] = 'required|unique:empresas';
		}
		$validar = Validator::make($inputs, $rules, $messages);
		if ($validar->fails()) {
			return Redirect::back()->withInput()->withErrors($validar);
		}  else {
			$row->rs = $inputs["rs"];
			$row->ncomer = $inputs["ncomer"];
			$row->df = $inputs["df"];
			$row->rfc = $inputs["rfc"];
			$row->save();
			return Redirect::to('corevat/Empresas/' . $id . '/edit')->with('success', '¡La modificación se efectuo correctamente!');
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id = null) {
        $row = Empresas::findOrFail($id);
		try {
	        $row->delete($id);
			return Redirect::to('corevat/Empresas')->with('success', '¡La eliminación se efectuo correctamente!');
		} catch (\Illuminate\Database\QueryException $ex) {
			return Redirect::back()->with('error', $ex->getMessage());
		}
	}

}
