<?php

class corevat_MunicipiosController extends \BaseController {

	protected $table;
	private $ip;
	private $host;
	private $rows;

	/**
	 * Instancia del catalogo de empresas [COREVAT]
	 * @var Catalogo de empresas [COREVAT]
	 */
	public function __construct(Municipios $table) {
		$this->table = $table;
		$this->ip          = $_SERVER["REMOTE_ADDR"];
		$this->host        = gethostbyaddr($_SERVER['REMOTE_ADDR']);
	}

	private function getListMunicipios(){
		$this->rows = Municipios::select(
									'municipios.municipio', 
									'municipios.idmunicipio', 
									'municipios.clave', 
									'municipios.status as statusmun', 
									'estados.estado',
									'estados.status'
									)
							->leftJoin('estados', 'municipios.idestado', '=', 'estados.idestado')
							->orderBy('idmunicipio', 'desc')
							->get();
	}

	/**
	 * 
	 */
	public function index($format = 'html') {
		$title = 'COREVAT';
		$title_section = 'Catálogo de Municipios';
		$subtitle_section = '';
		$titleGrid = 'Municipios';
		$row = $this->table;
		$this->getListMunicipios();
		$rows = $this->rows;
		return ($format == 'json') ? $rows : View::make('CorevatCatalogos.Municipios.index', compact('title', 'title_section', 'row', 'rows', 'titleGrid','subtitle_section'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		$title = 'COREVAT';
		$title_section = 'Catálogo de Municipios';
		$titleGrid = 'Catálogo de Municipios';
		$subtitle_section = '';
		$row = $this->table;
		$row->status = 1;		
		$this->getListMunicipios();
		$rows = $this->rows;
		$lstEstados = Estados::comboList();
		return View::make('CorevatCatalogos.Municipios.create', compact('title', 'title_section', 'row', 'rows', 'titleGrid','subtitle_section','lstEstados'));
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
			'municipio' => 'required',
		);
		$validar = Validator::make($inputs, $rules);
		if ($validar->fails()) {
			return Redirect::back()->withInput()->withErrors($validar);
		}  else {
			$row = new Municipios;
			$row->idestado = $inputs["idestado"];
			$row->municipio = strtoupper($inputs["municipio"]);
			$row->clave = strtoupper($inputs["clave"]);
			$row->status = isset($inputs["status"]) ? $inputs["status"] : 0;
			$row->ip = $this->ip;
			$row->host = $this->host;
			$row->creado_por = $user->id;
			$row->creado_el = date('Y-m-d H:i:s');
			$row->save();
			return Redirect::to('corevat/Municipios/create')->with('success', '¡El registro fue creado satisfactoriamente!');
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
		$row = Municipios::find($id);
		$this->table = $row;
		$title = 'COREVAT';
		$title_section = 'Catálogo de Municipios';
		$subtitle_section = ' ';
		$titleGrid = 'Catálogo de Municipios';
		$id = $row->idmunicipio;
		$this->getListMunicipios();
		$lstEstados = Estados::comboList();
		$rows = $this->rows;
		return View::make('CorevatCatalogos.Municipios.edit', compact('title', 'title_section', 'row', 'rows', 'id', 'titleGrid', 'subtitle_section','lstEstados'));
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
		$row = Municipios::find($id);
		$inputs = Input::All();
		$rules = array(
			'municipio' => 'required',
		);
		$messages = array(
			"unique" => "¡Ya existe este Municipios!",
		);

		$validate = Validator::make($inputs, $rules, $messages);
		if ($validate->fails()) {
			return Redirect::back()->withInput()->withErrors($validate);
		}  else {
			$row->idestado = $inputs["idestado"];
			$row->municipio = strtoupper($inputs["municipio"]);
			$row->clave = strtoupper($inputs["clave"]);
			$row->status = isset($inputs["status"]) ? $inputs["status"] : 0;
			$row->ip = $this->ip;
			$row->host = $this->host;
			$row->modi_por = $user->id;
			$row->modi_el = date('Y-m-d H:i:s');
			$row->save();
			return Redirect::to('corevat/Municipios/' . $id . '/edit')->with('success', '¡La modificación se efectuo correctamente!');
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id = null) {
        $row = Municipios::findOrFail($id);
		try {
	        $row->delete($id);
			return Redirect::to('corevat/Municipios')->with('success', '¡La eliminación se efectuo correctamente!');
		} catch (\Illuminate\Database\QueryException $ex) {
			return Redirect::back()->with('error', $ex->getMessage());
		}
	}

}
