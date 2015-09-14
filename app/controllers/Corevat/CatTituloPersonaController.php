<?php

class corevat_CatTituloPersonaController extends \BaseController {

	protected $catalogo;

	/**
	 * 
	 * Instancia del catalogo de bardas [COREVAT]
	 * @var Catalogo de bardas [COREVAT]
	 * 
	 */
	public function __construct(CatTituloPersona $catalogo) {
		$this->catalogo = $catalogo;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($format = 'html') {
		$title = 'COREVAT';
		$title_section = 'Catálogo de Títulos';
		$titleGrid = 'Catálogo de Titulos';
		$row = $this->catalogo;
		$rows = CatTituloPersona::orderBy('titulo_persona')->get();
		return ($format == 'json') ? $rows : View::make('CorevatCatalogos.CatTituloPersona.index', compact('title', 'title_section', 'row', 'rows', 'titleGrid'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		$title = 'COREVAT';
		$title_section = 'Catálogo de Títulos';
		$titleGrid = 'Catálogo de Titulos';
		$row = $this->catalogo;
		$row->status = 1;
		$rows = CatTituloPersona::orderBy('titulo_persona')->get();
		return View::make('CorevatCatalogos.CatTituloPersona.create', compact('title', 'title_section', 'row', 'rows', 'titleGrid'));
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
			'titulo_persona' => 'required',
		);
		$messages = array(
			'required' => 'El campo es requerido',
		);
		$validate = Validator::make($inputs, $rules, $messages);
		if ($validate->fails()) {
			return Redirect::back()->withInput()->withErrors($validate);
		} else {
			$row = new CatTituloPersona();
			$row->titulo_persona = $inputs["titulo_persona"];
			$row->status = isset($inputs["status"]) ? $inputs["status"] : 0;
			$row->created_at = date('Y-m-d H:i:s');
			$row->save();
			return Redirect::to('corevat/CatTituloPersona/create')->with('success', '¡Se ha creado correctamente el registro!');
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
		$title_section = 'Catálogo de Títulos';
		$titleGrid = 'Catálogo de Titulos';
		$row = CatTituloPersona::find($id);
		$rows = CatTituloPersona::orderBy('titulo_persona')->get();
		$id = $row->idtitulopersona;
		return View::make('CorevatCatalogos.CatTituloPersona.edit', compact('title', 'title_section', 'row', 'rows', 'id', 'titleGrid'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, $format = 'html') {
		$inputs = Input::All();
		$row = CatTituloPersona::find($id);
		$rules = array(
			'titulo_persona' => 'required',
		);
		$messages = array(
			'required' => 'El campo es requerido',
		);
		$validate = Validator::make($inputs, $rules, $messages);
		if ($validate->fails()) {
			return Redirect::back()->withInput()->withErrors($validate);
		} else {
			$row->titulo_persona = $inputs["titulo_persona"];
			$row->status = isset($inputs["status"]) ? $inputs["status"] : 0;
			$row->updated_at = date('Y-m-d H:i:s');
			$row->save();
			return Redirect::to('corevat/CatTituloPersona/' . $id . '/edit')->with('success', '¡La modificación se efectuo correctamente!');
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id = null) {
		$row = CatTituloPersona::findOrFail($id);
		try {
			$row->delete($id);
			return Redirect::to('corevat/CatTituloPersona')->with('success', '¡La eliminación se efectuo correctamente!');
		} catch (\Illuminate\Database\QueryException $ex) {
			return Redirect::back()->with('error', $ex->getMessage());
		}
	}

}
