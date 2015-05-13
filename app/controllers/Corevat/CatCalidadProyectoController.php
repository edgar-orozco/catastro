<?php

class corevat_CatCalidadProyectoController extends \BaseController {

	protected $catalogo;

	/**
	 * Instancia del catalogo de aplanados [COREVAT]
	 * @var Catalogo de aplanados [COREVAT]
	 */
	public function __construct(CatCalidadProyecto $catalogo) {
		$this->catalogo = $catalogo;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($format = 'html') {
		$title = 'COREVAT';
		$title_section = 'Catálogo Calidad Proyecto';
		$titleGrid = 'Catálogo Calidad Proyecto';
		$row = $this->catalogo;
		$rows = CatCalidadProyecto::orderBy('calidad_proyecto')->get();
		return ($format == 'json') ? $rows : View::make('CorevatCatalogos.CatCalidadProyecto.index', compact('title', 'title_section', 'row', 'rows', 'titleGrid'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		$title = 'COREVAT';
		$title_section = 'Catálogo Calidad Proyecto';
		$titleGrid = 'Catálogo Calidad Proyecto';
		$row = $this->catalogo;
		$row->status_calidad_proy = 1;
		$rows = CatCalidadProyecto::orderBy('calidad_proyecto')->get();
		return View::make('CorevatCatalogos.CatCalidadProyecto.create', compact('title', 'title_section', 'row', 'rows', 'titleGrid'));
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
			'calidad_proyecto' => 'required',
		);
		$messages = array(
			'required' => 'El campo es requerido',
		);
		$validar = Validator::make($inputs, $rules, $messages);
		if ($validar->fails()) {
			return Redirect::back()->withInput()->withErrors($validar);
		}  else {
			$row = new CatCalidadProyecto;
			$row->calidad_proyecto = $inputs["calidad_proyecto"];
			$row->status_calidad_proy = isset($inputs["status_calidad_proy"]) ? $inputs["status_calidad_proy"] : 0;
			$row->idemp = 1;
			$row->ip = $_SERVER['REMOTE_ADDR'];
			$row->host = isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : '';
			$row->creado_por = 1;
			$row->creado_el = date('Y-m-d H:i:s');
			$row->save();
			return Redirect::to('corevat/CatCalidadProyecto/create')->with('success',
			'¡Se ha creado correctamente el registro!');
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
		$title_section = 'Catálogo Calidad Proyecto';
		$titleGrid = 'Catálogo Calidad Proyecto';
		$row = CatCalidadProyecto::find($id);
		$rows = CatCalidadProyecto::orderBy('calidad_proyecto')->get();
		$id = $row->idcalidadproyecto;
		return View::make('CorevatCatalogos.CatCalidadProyecto.edit', compact('title', 'title_section', 'row', 'rows', 'id', 'titleGrid'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, $format = 'html') {
		$inputs = Input::All();
		$row = CatCalidadProyecto::find($id);
		$rules = array(
			'calidad_proyecto' => 'required',
		);
		$messages = array(
			'required' => 'El campo es requerido',
		);
		$validate = Validator::make($inputs, $rules, $messages);
		if ($validate->fails()) {
			return Redirect::back()->withInput()->withErrors($validate);
		} else {
			$row->calidad_proyecto = $inputs["calidad_proyecto"];
			$row->status_calidad_proy= isset($inputs["status_calidad_proy"]) ? $inputs["status_calidad_proy"] : 0;
			$row->modi_por = 1;
			$row->modi_el = date('Y-m-d H:i:s');
			$row->save();
			return Redirect::to('corevat/CatCalidadProyecto/' . $id . '/edit')->with('success', '¡La modificación se efectuo correctamente!');
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id = null) {
        $row = CatCalidadProyecto::findOrFail($id);
		try {
			$row->delete($id);
			return Redirect::to('corevat/CatCalidadProyecto')->with('success', '¡La eliminación se efectuo correctamente!');
		} catch (\Illuminate\Database\QueryException $ex) {
			return Redirect::back()->with('error', $ex->getMessage());
		}
	}

}
