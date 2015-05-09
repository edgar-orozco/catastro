<?php

class corevat_CatEstadoConservacionController extends \BaseController {

	protected $catalogo;

	/**
	 * Instancia del catalogo de aplanados [COREVAT]
	 * @var Catalogo de aplanados [COREVAT]
	 */
	public function __construct(CatEstadoConservacion $catalogo) {
		$this->catalogo = $catalogo;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($format = 'html') {
		$title = 'COREVAT';
		$title_section = 'Catálogo Estado Conservación';
		$titleGrid = 'Catálogo Estado Conservación';
		$row = $this->catalogo;
		$rows = CatEstadoConservacion::orderBy('estado_conservacion', 'asc')->get();
		return ($format == 'json') ? $rows : View::make('CorevatCatalogos.CatEstadoConservacion.index', compact('title', 'title_section', 'row', 'rows', 'titleGrid'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		$title = 'COREVAT';
		$title_section = 'Catálogo Estado Conservación';
		$titleGrid = 'Catálogo Estado Conservación';
		$row = $this->catalogo;
		$row->status_estado_conservacion = 1;
		$rows = CatEstadoConservacion::orderBy('estado_conservacion', 'asc')->get();
		return View::make('CorevatCatalogos.CatEstadoConservacion.create', compact('title', 'title_section', 'row', 'rows', 'titleGrid'));
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
			'estado_conservacion' => 'required',
		);
		$messages = array(
			'required' => 'El campo es requerido',
		);
		$validate = Validator::make($inputs, $rules, $messages);
		if ($validate->fails()) {
			return Redirect::back()->withInput()->withErrors($validate);
		}  else {
			$row = new CatEstadoConservacion;
			$row->estado_conservacion = $inputs["estado_conservacion"];
			$row->status_estado_conservacion = isset($inputs["status_estado_conservacion"]) ? $inputs["status_estado_conservacion"] : 0;
			$row->idemp = 1;
			$row->ip = $_SERVER['REMOTE_ADDR'];
			$row->host = isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : '';
			$row->creado_por = 1;
			$row->creado_el = date('Y-m-d H:i:s');
			$row->save();
			return Redirect::to('corevat/CatEstadoConservacion/create')->with('success', '¡Se ha creado correctamente el registro!');
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
		$title_section = 'Catálogo Estado Conservación';
		$titleGrid = 'Catálogo Estado Conservación';
		$row = CatEstadoConservacion::find($id);
		$rows = CatEstadoConservacion::orderBy('estado_conservacion', 'asc')->get();
		$id = $row->idaplanado;
		return View::make('CorevatCatalogos.CatEstadoConservacion.edit', compact('title', 'title_section', 'row', 'rows', 'id', 'titleGrid'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, $format = 'html') {
		$inputs = Input::All();
		$row = CatEstadoConservacion::find($id);
		$rules = array(
			'estado_conservacion' => 'required',
		);
		$messages = array(
			'required' => 'El campo es requerido',
		);
		$validate = Validator::make($inputs, $rules, $messages);
		if ($validate->fails()) {
			return Redirect::back()->withInput()->withErrors($validate);
		} else {
			$row->estado_conservacion = $inputs["estado_conservacion"];
			$row->status_estado_conservacion= isset($inputs["status_estado_conservacion"]) ? $inputs["status_estado_conservacion"] : 0;
			$row->modi_por = 1;
			$row->modi_el = date('Y-m-d H:i:s');
			$row->save();
			return Redirect::to('corevat/CatEstadoConservacion/' . $id . '/edit')->with('success', '¡La modificación se efectuo correctamente!');
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id = null) {
        $row = CatEstadoConservacion::findOrFail($id);
		try {
			$row->delete($id);
	        return Redirect::to('corevat/CatEstadoConservacion')->with('success', '¡La eliminación se efectuo correctamente!');
		} catch (\Illuminate\Database\QueryException $ex) {
			return Redirect::back()->with('error', $ex->getMessage());
		}
	}

}
