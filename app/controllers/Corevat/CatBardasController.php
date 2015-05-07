<?php

class corevat_CatBardasController extends \BaseController {

	protected $catalogo;

	/**
	 * 
	 * Instancia del catalogo de bardas [COREVAT]
	 * @var Catalogo de bardas [COREVAT]
	 * 
	 */
	public function __construct(CatBardas $catalogo) {
		$this->catalogo = $catalogo;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($format = 'html') {
		$title = 'COREVAT';
		$title_section = 'Catálogo de Bardas';
		$titleGrid = 'Catálogo de Bardas';
		$row = $this->catalogo;
		$rows = CatBardas::orderBy('barda')->get();
		return ($format == 'json') ? $rows : View::make('CorevatCatalogos.CatBardas.index', compact('title', 'title_section', 'row', 'rows', 'titleGrid'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		$title = 'COREVAT';
		$title_section = 'Catálogo de Bardas';
		$titleGrid = 'Catálogo de Bardas';
		$row = $this->catalogo;
		$row->status = 1;
		$rows = CatBardas::orderBy('barda')->get();
		return View::make('CorevatCatalogos.CatBardas.create', compact('title', 'title_section', 'row', 'rows', 'titleGrid'));
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
			'barda' => 'required',
		);
		$messages = array(
			'required' => 'El campo es requerido',
		);
		$validate = Validator::make($inputs, $rules, $messages);
		if ($validate->fails()) {
			return Redirect::back()->withInput()->withErrors($validate);
		} else {
			$row = new CatBardas;
			$row->barda = $inputs["barda"];
			$row->status = isset($inputs["status"]) ? $inputs["status"] : 0;
			$row->idemp = 1;
			$row->ip = $_SERVER['REMOTE_ADDR'];
			$row->host = isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : '';
			$row->creado_por = 1;
			$row->creado_el = date('Y-m-d H:i:s');
			$row->save();
			return Redirect::to('corevat/CatBardas/create')->with('success', '¡Se ha creado correctamente el registro!');
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
		$title_section = 'Catálogo de Bardas';
		$titleGrid = 'Catálogo de Bardas';
		$row = CatBardas::find($id);
		$rows = CatBardas::orderBy('barda')->get();
		$id = $row->idaplanado;
		return View::make('CorevatCatalogos.CatBardas.edit', compact('title', 'title_section', 'row', 'rows', 'id', 'titleGrid'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, $format = 'html') {
		$inputs = Input::All();
		$row = CatBardas::find($id);
		$rules = array(
			'barda' => 'required',
		);
		$messages = array(
			'required' => 'El campo es requerido',
		);
		$validate = Validator::make($inputs, $rules, $messages);
		if ($validate->fails()) {
			return Redirect::back()->withInput()->withErrors($validate);
		} else {
			$row->barda = $inputs["barda"];
			$row->status = isset($inputs["status"]) ? $inputs["status"] : 0;
			$row->modi_por = 1;
			$row->modi_el = date('Y-m-d H:i:s');
			$row->save();
			return Redirect::to('corevat/CatBardas/' . $id . '/edit')->with('success', '¡La modificación se efectuo correctamente!');
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id = null) {
		$row = CatBardas::findOrFail($id);
		try {
			$row->delete($id);
			return Redirect::to('corevat/CatBardas')->with('success', '¡La eliminación se efectuo correctamente!');
		} catch (\Illuminate\Database\QueryException $ex) {
			return Redirect::back()->with('error', $ex->getMessage());
		}
	}

}
