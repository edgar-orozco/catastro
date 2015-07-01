<?php

class corevat_EstadosController extends \BaseController {

	protected $table;
	private $ip;
	private $host;

	/**
	 * Instancia del catalogo de empresas [COREVAT]
	 * @var Catalogo de empresas [COREVAT]
	 */
	public function __construct(Estados $table) {
		$this->table = $table;
		$this->ip          = $_SERVER["REMOTE_ADDR"];
		$this->host        = gethostbyaddr($_SERVER['REMOTE_ADDR']);
	}

	/**
	 * 
	 */
	public function index($format = 'html') {
		$title = 'COREVAT';
		$title_section = 'Catálogo de Estados';
		$subtitle_section = '';
		$titleGrid = 'Estados';
		$row = $this->table;
		$rows = Estados::orderBy('idestado', 'desc')->get();
		return ($format == 'json') ? $rows : View::make('CorevatCatalogos.Estados.index', compact('title', 'title_section', 'row', 'rows', 'titleGrid','subtitle_section'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		$title = 'COREVAT';
		$title_section = 'Catálogo de Estados';
		$titleGrid = 'Catálogo de Estados';
		$subtitle_section = ' ';
		$row = $this->table;
		$row->status = 1;		
		$rows = Estados::orderBy('idestado', 'desc')->get();
		return View::make('CorevatCatalogos.Estados.create', compact('title', 'title_section', 'row', 'rows', 'titleGrid','subtitle_section'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store($format = 'html') {
		$user = Confide::user();
		$id = Input::get('id');
		$inputs = Input::All();
		$rules = array(
			'estado' => 'required',
		);
		$validar = Validator::make($inputs, $rules);
		if ($validar->fails()) {
			return Redirect::back()->withInput()->withErrors($validar);
		}  else {
			$row = new Estados;
			$row->estado = $inputs["estado"];
			$row->clave = $inputs["clave"];
			$row->status = isset($inputs["status"]) ? $inputs["status"] : 0;
			$row->ip = $this->ip;
			$row->host = $this->host;
			$row->creado_por = $user->id;
			$row->creado_el = date('Y-m-d H:i:s');
			$row->save();
			return Redirect::to('corevat/Estados/create')->with('success', '¡El registro fue creado satisfactoriamente!');
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
		$row = Estados::find($id);
		$this->table = $row;
		$title = 'COREVAT';
		$title_section = 'Catálogo de Estados';
		$subtitle_section = ' ';
		$titleGrid = 'Catálogo de Estados';
		// $rows = $this->table->all();
		$rows = Estados::orderBy('idestado', 'desc')->get();
		$id = $row->idestado;
		return View::make('CorevatCatalogos.Estados.edit', compact('title', 'title_section', 'row', 'rows', 'id', 'titleGrid', 'subtitle_section'));
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
		$user = Confide::user();
		$row = Estados::find($id);
		$inputs = Input::All();
		$rules = array(
			'estado' => 'required',
		);
		$messages = array(
			"unique" => "¡Ya existe este Estado!",
		);

		$validate = Validator::make($inputs, $rules, $messages);
		if ($validate->fails()) {
			return Redirect::back()->withInput()->withErrors($validate);
		}  else {
			$row->estado = strtoupper( $inputs["estado"] );
			$row->clave = $inputs["clave"];
			$row->status = isset($inputs["status"]) ? $inputs["status"] : 0;
			$row->ip = $this->ip;
			$row->host = $this->host;
			$row->modi_por = $user->id;
			$row->modi_el = date('Y-m-d H:i:s');
			$row->save();
			return Redirect::to('corevat/Estados/' . $id . '/edit')->with('success', '¡La modificación se efectuo correctamente!');
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id = null) {
        $row = Estados::findOrFail($id);
		try {
	        $row->delete($id);
			return Redirect::to('corevat/Estados')->with('success', '¡La eliminación se efectuo correctamente!');
		} catch (\Illuminate\Database\QueryException $ex) {
			return Redirect::back()->with('error', $ex->getMessage());
		}
	}

}
