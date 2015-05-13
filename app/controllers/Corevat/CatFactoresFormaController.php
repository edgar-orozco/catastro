<?php

class corevat_CatFactoresFormaController extends \BaseController {

	protected $catalogo;

	/**
	 * Instancia del catalogo de aplanados [COREVAT]
	 * @var Catalogo de aplanados [COREVAT]
	 */
	public function __construct(CatFactoresForma $catalogo) {
		$this->catalogo = $catalogo;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($format = 'html') {
		$title = 'COREVAT';
		$title_section = 'Catálogo Factores Forma';
		$titleGrid = 'Catálogo Factores Forma';
		$row = $this->catalogo;
		$rows = CatFactoresForma::orderBy('factor_forma')->get();
		return ($format == 'json') ? $rows : View::make('CorevatCatalogos.CatFactoresForma.index', compact('title', 'title_section', 'row', 'rows', 'titleGrid'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		$title = 'COREVAT';
		$title_section = 'Catálogo Factores Forma';
		$titleGrid = 'Catálogo Factores Forma';
		$row = $this->catalogo;
		$row->status_factor_forma = 1;
		$rows = CatFactoresForma::orderBy('factor_forma')->get();
		return View::make('CorevatCatalogos.CatFactoresForma.create', compact('title', 'title_section', 'row', 'rows', 'titleGrid'));
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
			'factor_forma' => 'required',
			'valor_factor_forma' => 'required',
		);
		$messages = array(
			'required' => 'El campo es requerido',
		);
		$validate = Validator::make($inputs, $rules, $messages);
		if ($validate->fails()) {
			return Redirect::back()->withInput()->withErrors($validate);
		}  else {
			$row = new CatFactoresForma;
			$row->factor_forma = $inputs["factor_forma"];
			$row->valor_factor_forma = $inputs["valor_factor_forma"];
			$row->status_factor_forma = isset($inputs["status_factor_forma"]) ? $inputs["status_factor_forma"] : 0;
			$row->idemp = 1;
			$row->ip = $_SERVER['REMOTE_ADDR'];
			$row->host = isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : '';
			$row->creado_por = 1;
			$row->creado_el = date('Y-m-d H:i:s');
			$row->save();
			return Redirect::to('corevat/CatFactoresForma/create')->with('success', '¡Se ha creado correctamente el registro!');
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
		$title_section = 'Catálogo Factores Forma';
		$titleGrid = 'Catálogo Factores Forma';
		$row = CatFactoresForma::find($id);
		$rows = CatFactoresForma::orderBy('factor_forma')->get();
		$id = $row->idfactorforma;
		return View::make('CorevatCatalogos.CatFactoresForma.edit', compact('title', 'title_section', 'row', 'rows', 'id', 'titleGrid'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, $format = 'html') {
		$inputs = Input::All();
		$row = CatFactoresForma::find($id);
		$rules = array(
			'factor_forma' => 'required',
			'valor_factor_forma' => 'required',
		);
		$messages = array(
			'required' => 'El campo es requerido',
		);
		$validate = Validator::make($inputs, $rules, $messages);
		if ($validate->fails()) {
			return Redirect::back()->withInput()->withErrors($validate);
		} else {
			$row->factor_forma = $inputs["factor_forma"];
			$row->valor_factor_forma = $inputs["valor_factor_forma"];
			$row->status_factor_forma = isset($inputs["status_factor_forma"]) ? $inputs["status_factor_forma"] : 0;
			$row->modi_por = 1;
			$row->modi_el = date('Y-m-d H:i:s');
			$row->save();
			return Redirect::to('corevat/CatFactoresForma/' . $id . '/edit')->with('success', '¡La modificación se efectuo correctamente!');
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id = null) {
        $row = CatFactoresForma::findOrFail($id);
		try {
	        $row->delete($id);
			return Redirect::to('corevat/CatFactoresForma')->with('success', '¡La eliminación se efectuo correctamente!');
		} catch (\Illuminate\Database\QueryException $ex) {
			return Redirect::back()->with('error', $ex->getMessage());
		}
        
	}

}
