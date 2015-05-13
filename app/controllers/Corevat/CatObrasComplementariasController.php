<?php

class corevat_CatObrasComplementariasController extends \BaseController {

	protected $catalogo;

	/**
	 * Instancia del catalogo de aplanados [COREVAT]
	 * @var Catalogo de aplanados [COREVAT]
	 */
	public function __construct(CatObrasComplementarias $catalogo) {
		$this->catalogo = $catalogo;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($format = 'html') {
		$title = 'COREVAT';
		$title_section = 'Catálogo de Obras Complementarias';
		$titleGrid = 'Catálogo de Obras Complementarias';
		$row = $this->catalogo;
		$rows = CatObrasComplementarias::orderBy('obra_complementaria')->get();
		return ($format == 'json') ? $rows : View::make('CorevatCatalogos.CatObrasComplementarias.index', compact('title', 'title_section', 'row', 'rows', 'titleGrid'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		$title = 'COREVAT';
		$title_section = 'Catálogo de Obras Complementarias';
		$titleGrid = 'Catálogo de Obras Complementarias';
		$row = $this->catalogo;
		$row->status_obra_complementaria = 1;
		$rows = CatObrasComplementarias::orderBy('obra_complementaria')->get();
		return View::make('CorevatCatalogos.CatObrasComplementarias.create', compact('title', 'title_section', 'row', 'rows', 'titleGrid'));
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
			'obra_complementaria' => 'required',
		);
		$messages = array(
			'required' => 'El campo es requerido',
		);
		$validate = Validator::make($inputs, $rules, $messages);
		if ($validate->fails()) {
			return Redirect::back()->withInput()->withErrors($validate);
		}  else {
			$row = new CatObrasComplementarias;
			$row->obra_complementaria = $inputs["obra_complementaria"];
			$row->status_obra_complementaria = isset($inputs["status_obra_complementaria"]) ? $inputs["status_obra_complementaria"] : 0;
			$row->idemp = 1;
			$row->ip = $_SERVER['REMOTE_ADDR'];
			$row->host = isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : '';
			$row->creado_por = 1;
			$row->creado_el = date('Y-m-d H:i:s');
			$row->save();
			return Redirect::to('corevat/CatObrasComplementarias/create')->with('success', '¡Se ha creado correctamente el registro!');
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
		$title_section = 'Catálogo de Obras Complementarias';
		$titleGrid = 'Catálogo de Obras Complementarias';
		$row = CatObrasComplementarias::find($id);
		$rows = CatObrasComplementarias::orderBy('obra_complementaria')->get();
		$id = $row->idobracomplementaria;
		return View::make('CorevatCatalogos.CatObrasComplementarias.edit', compact('title', 'title_section', 'row', 'rows', 'id', 'titleGrid'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, $format = 'html') {
		$inputs = Input::All();
		$row = CatObrasComplementarias::find($id);
		$rules = array(
			'obra_complementaria' => 'required',
		);
		$messages = array(
			'required' => 'El campo es requerido',
		);
		$validate = Validator::make($inputs, $rules, $messages);
		if ($validate->fails()) {
			return Redirect::back()->withInput()->withErrors($validate);
		} else {
			$row->obra_complementaria = $inputs["obra_complementaria"];
			$row->status_obra_complementaria = isset($inputs["status_obra_complementaria"]) ? $inputs["status_obra_complementaria"] : 0;
			$row->modi_por = 1;
			$row->modi_el = date('Y-m-d H:i:s');
			$row->save();
			return Redirect::to('corevat/CatObrasComplementarias/' . $id . '/edit')->with('success', '¡La modificación se efectuo correctamente!');
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id = null) {
        $row = CatObrasComplementarias::findOrFail($id);
		try {
	        $row->delete($id);
			return Redirect::to('corevat/CatObrasComplementarias')->with('success', '¡La eliminación se efectuo correctamente!');
		} catch (\Illuminate\Database\QueryException $ex) {
			return Redirect::back()->with('error', $ex->getMessage());
		}
        
	}

}
