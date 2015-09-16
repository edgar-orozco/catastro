<?php

class corevat_CatFinalidadController extends \BaseController {

	protected $catalogo;

	/**
	 * Instancia del catalogo de aplanados [COREVAT]
	 * @var Catalogo de aplanados [COREVAT]
	 */
	public function __construct(CatFinalidad $catalogo) {
		$this->catalogo = $catalogo;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($format = 'html') {
		$title = 'COREVAT';
		$title_section = 'Catálogo Finalidad';
		$titleGrid = 'Catálogo Finalidad';
		$row = $this->catalogo;
		$rows = CatFinalidad::orderBy('finalidad')->get();
		return ($format == 'json') ? $rows : View::make('CorevatCatalogos.CatFinalidad.index', compact('title', 'title_section', 'row', 'rows', 'titleGrid'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		$title = 'COREVAT';
		$title_section = 'Catálogo Finalidad';
		$titleGrid = 'Catálogo Finalidad';
		$row = $this->catalogo;
		$row->status = 1;
		$rows = CatFinalidad::orderBy('finalidad')->get();
		return View::make('CorevatCatalogos.CatFinalidad.create', compact('title', 'title_section', 'row', 'rows', 'titleGrid'));
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
			'finalidad' => 'required',
		);
		$messages = array(
			'required' => 'El campo es requerido',
		);
		$validate = Validator::make($inputs, $rules, $messages);
		if ($validate->fails()) {
			return Redirect::back()->withInput()->withErrors($validate);
		}  else {
			$row = new CatFinalidad;
			$row->finalidad = $inputs["finalidad"];
			$row->status = isset($inputs["status"]) ? $inputs["status"] : 0;
			$row->created_at = date('Y-m-d H:i:s');
			$row->save();
			return Redirect::to('corevat/CatFinalidad/create')->with('success', '¡Se ha creado correctamente el registro!');
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
		$title_section = 'Catálogo Finalidad';
		$titleGrid = 'Catálogo FFinalidad';
		$row = CatFinalidad::find($id);
		$rows = CatFinalidad::orderBy('finalidad')->get();
		$id = $row->idfinalidad;
		return View::make('CorevatCatalogos.CatFinalidad.edit', compact('title', 'title_section', 'row', 'rows', 'id', 'titleGrid'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, $format = 'html') {
		$inputs = Input::All();
		$row = CatFinalidad::find($id);
		$rules = array(
			'finalidad' => 'required',
		);
		$messages = array(
			'required' => 'El campo es requerido',
		);
		$validate = Validator::make($inputs, $rules, $messages);
		if ($validate->fails()) {
			return Redirect::back()->withInput()->withErrors($validate);
		} else {
			$row->finalidad = $inputs["finalidad"];
			$row->status = isset($inputs["status"]) ? $inputs["status"] : 0;
			$row->updated_at = date('Y-m-d H:i:s');
			$row->save();
			return Redirect::to('corevat/CatFinalidad/' . $id . '/edit')->with('success', '¡La modificación se efectuo correctamente!');
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id = null) {
        $row = CatFinalidad::findOrFail($id);
		try {
	        $row->delete($id);
			return Redirect::to('corevat/CatFinalidad')->with('success', '¡La eliminación se efectuo correctamente!');
		} catch (\Illuminate\Database\QueryException $ex) {
			return Redirect::back()->with('error', $ex->getMessage());
		}
        
	}

}
