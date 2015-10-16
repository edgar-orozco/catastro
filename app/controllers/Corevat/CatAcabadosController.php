<?php

class corevat_CatAcabadosController extends \BaseController {

	protected $catalogo;

	/**
	 * Instancia del catalogo de aplanados [COREVAT]
	 * @var Catalogo de aplanados [COREVAT]
	 */
	public function __construct(CatAcabados $catalogo) {
		$this->catalogo = $catalogo;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {
		$title = 'COREVAT';
		$title_section = 'Catálogo de Acabados';
		$titleGrid = 'Catálogo de Acabados';
		$row = $this->catalogo;
		$rows = CatAcabados::orderBy('nombre')->get();
		return View::make('CorevatCatalogos.CatAcabados.index', compact('title', 'title_section', 'row', 'rows', 'titleGrid'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		$title = 'COREVAT';
		$title_section = 'Catálogo de Acabados';
		$titleGrid = 'Catálogo Acabados';
		$row = $this->catalogo;
		$row->status = true;
		$rows = CatAcabados::orderBy('nombre')->get();
		return View::make('CorevatCatalogos.CatAcabados.create', compact('title', 'title_section', 'row', 'rows', 'titleGrid'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store() {
		$id=Input::get('id');
		$inputs = Input::All();
		$rules = array(
			'nombre' => 'required',
		);
		$messages = array(
			'nombre.required' => '¡El campo "Nombre" es requerido!',
		);
		$validate = Validator::make($inputs, $rules, $messages);
		if ($validate->fails()) {
			return Redirect::back()->withInput()->withErrors($validate);
		}  else {
			$row = new CatAcabados;
			$row->nombre = $inputs["nombre"];
			$row->estatus = isset($inputs["estatus"]) ? $inputs["estatus"] : 0;
			$row->created_at = date('Y-m-d H:i:s');
			$row->save();
			return Redirect::to('corevat/CatAcabados/create')->with('success', '¡Se ha creado correctamente el registro!');
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
		$title_section = 'Catálogo Acabados';
		$titleGrid = 'Catálogo Acabados';
		$row = CatAcabados::find($id);
		$rows = CatAcabados::orderBy('nombre', 'asc')->get();
		$id = $row->id;
		return View::make('CorevatCatalogos.CatAcabados.edit', compact('title', 'title_section', 'row', 'rows', 'id', 'titleGrid'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id) {
		$inputs = Input::All();
		$row = CatAcabados::find($id);
		$rules = array(
			'nombre' => 'required',
		);
		$messages = array(
			'nombre.required' => '¡El campo "Nombre" es requerido!',
		);
		$validate = Validator::make($inputs, $rules, $messages);
		if ($validate->fails()) {
			return Redirect::back()->withInput()->withErrors($validate);
		} else {
			$row->nombre = $inputs["nombre"];
			$row->estatus= isset($inputs["estatus"]) ? $inputs["estatus"] : 0;
			$row->updated_at = date('Y-m-d H:i:s');
			$row->save();
			return Redirect::to('/corevat/CatAcabados/' . $id . '/edit')->with('success', '¡La modificación se efectuo correctamente!');
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id = null) {
		$row = CatAcabados::findOrFail($id);
		try {
			$row->delete($id);
			return Redirect::to('corevat/CatAcabados')->with('success', '¡La eliminación se efectuo correctamente!');
		} catch (\Illuminate\Database\QueryException $ex) {
			return Redirect::back()->with('error', '¡EL REGISTRO NO PUEDE SER ELIMINADO DEBIDO A QUE ESTA SIENDO UTILIZADO POR ALGUN AVALUO!');
		}
		
	}

}
