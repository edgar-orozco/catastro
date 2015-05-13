<?php

class corevat_CatClaseGeneralInmuebleController extends \BaseController {

	protected $catalogo;

	/**
	 * Instancia del catalogo de aplanados [COREVAT]
	 * @var Catalogo de aplanados [COREVAT]
	 */
	public function __construct(CatClaseGeneralInmueble $catalogo) {
		$this->catalogo = $catalogo;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($format = 'html') {
		$title = 'COREVAT';
		$title_section = 'Catálogo Clase General Inmueble';
		$titleGrid = 'Catálogo Clase General Inmueble';
		$row = $this->catalogo;
		$rows = CatClaseGeneralInmueble::orderBy('clase_general_inmueble', 'asc')->get();
		return ($format == 'json') ? $rows : View::make('CorevatCatalogos.CatClaseGeneralInmueble.index', compact('title', 'title_section', 'row', 'rows', 'titleGrid'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		$title = 'COREVAT';
		$title_section = 'Catálogo Clase General Inmueble';
		$titleGrid = 'Catálogo Clase General Inmueble';
		$row = $this->catalogo;
		$row->status_clase_general_inmueble = 1;
		$rows = CatClaseGeneralInmueble::orderBy('clase_general_inmueble', 'asc')->get();
		return View::make('CorevatCatalogos.CatClaseGeneralInmueble.create', compact('title', 'title_section', 'row', 'rows', 'titleGrid'));
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
			'clase_general_inmueble' => 'required',
		);
		$messages = array(
			"required" => "El campo es requerido",
		);
		$validate = Validator::make($inputs, $rules, $messages);
		if ($validate->fails()) {
			return Redirect::back()->withInput()->withErrors($validate);
		}  else {
			$row = new CatClaseGeneralInmueble;
			$row->clase_general_inmueble = $inputs["clase_general_inmueble"];
			$row->status_clase_general_inmueble = isset($inputs["status_clase_general_inmueble"]) ? $inputs["status_clase_general_inmueble"] : 0;
			$row->idemp = 1;
			$row->ip = $_SERVER['REMOTE_ADDR'];
			$row->host = isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : '';
			$row->creado_por = 1;
			$row->creado_el = date('Y-m-d H:i:s');
			$row->save();
			return Redirect::to('corevat/CatClaseGeneralInmueble/create')->with('success', '¡Se ha creado correctamente el registro!');
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
		$title_section = 'Catálogo Clase General Inmueble';
		$titleGrid = 'Catálogo Clase General Inmueble';
		$row = CatClaseGeneralInmueble::find($id);
		$rows = CatClaseGeneralInmueble::orderBy('clase_general_inmueble', 'asc')->get();
		$id = $row->idclasegeneralinmueble;
		return View::make('CorevatCatalogos.CatClaseGeneralInmueble.edit', compact('title', 'title_section', 'row', 'rows', 'id', 'titleGrid'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, $format = 'html') {
		$inputs = Input::All();
		$row = CatClaseGeneralInmueble::find($id);
		$rules = array(
			'clase_general_inmueble' => 'required',
		);
		$messages = array(
			'required' => 'El campo es requerido',
		);
		$validate = Validator::make($inputs, $rules, $messages);
		if ($validate->fails()) {
			return Redirect::back()->withInput()->withErrors($validate);
		} else {
			$row->clase_general_inmueble = $inputs["clase_general_inmueble"];
			$row->status_clase_general_inmueble = isset($inputs["status_clase_general_inmueble"]) ? $inputs["status_clase_general_inmueble"] : 0;
			$row->modi_por = 1;
			$row->modi_el = date('Y-m-d H:i:s');
			$row->save();
			return Redirect::to('corevat/CatClaseGeneralInmueble/' . $id . '/edit')->with('success', '¡La modificación se efectuo correctamente!');
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id = null) {
        $row = CatClaseGeneralInmueble::findOrFail($id);
		try {
			$row->delete($id);
	        return Redirect::to('corevat/CatClaseGeneralInmueble')->with('success', '¡La eliminación se efectuo correctamente!');
		} catch (\Illuminate\Database\QueryException $ex) {
			return Redirect::back()->with('error', $ex->getMessage());
		}
	}

}
