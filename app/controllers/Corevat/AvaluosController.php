<?php

use Carbon\Carbon;

class corevat_AvaluosController extends \BaseController {

	protected $avaluo;
	protected $idavaluo;
	protected $foliosComprados;

	public function __construct(Avaluos $avaluo, FoliosComprados $foliosComprados) {
		$this->avaluo = $avaluo;
		$this->idavaluo = $avaluo->idavaluo;
		$this->FoliosComprados =$foliosComprados;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {
		$title = 'COREVAT';
		if (Auth::user()->hasRole("Perito Valuador")) {
			$rows = Avaluos::orderBy('idavaluo', 'desc')->where('iduser', Auth::id())->get();
		} else {
			$rows = Avaluos::orderBy('idavaluo', 'desc')->get();
		}
		$row = $this->avaluo;
		return View::make('Corevat.Avaluos.index', compact('title', 'rows', 'row'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		$title = 'COREVAT';
		$row = $this->avaluo;

		$row['fecha_reporte'] = new Carbon();
		$row['fecha_reporte'] = $row['fecha_reporte']->format('d-m-Y');

		$row['fecha_avaluo'] = new Carbon('last day');
		$row['fecha_avaluo'] = $row['fecha_avaluo']->format('d-m-Y');

		$row['lon0'] = $row['lon1'] = $row['lat0'] = $row['lat1'] = 0;
		$row['lon2'] = $row['lat2'] = '0.00';

		$estados = Estados::select('idestado', 'clave', 'estado')->where('status', 1)->orderBy('estado')->get();

		$municipios = Municipios::select('municipio', 'clave', 'idmunicipio')
						->orderBy('municipio')
						->where('idestado', 1)
						->where('status', 1)->get();

		$cat_tipo_inmueble = CatTipoInmueble::comboList();
		$cat_regimen_propiedad = CatRegimenPropiedad::comboList();

		$cat_finalidad = CatFinalidad::comboList();
		$cat_titulo_persona = CatTituloPersona::comboList();

		$row["numero_cuenta"] = '0';
		$row["clave_zona"] = '0';
		$row["clave_manzana"] = '0';
		$row["clave_predio"] = '0';
		
		$idavaluo = 0;

		$lstCP = Asentamiento::where('municipio', '001')->distinct()->orderBy('codigo_postal')->lists('codigo_postal', 'codigo_postal');

		return View::make('Corevat.Avaluos.create', compact('title', 'row', 'estados', 'municipios', 'cat_tipo_inmueble', 'cat_regimen_propiedad', 'idavaluo', 'lstCP', 'cat_finalidad', 'cat_titulo_persona'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store() {
		$inputs = Input::All();
		//dd($inputs);
		//$inputs["cuenta_predial"] = trim($inputs["cuenta_predial"]);
		//$inputs["cuenta_catastral"] = trim($inputs["cuenta_catastral"]);
		$inputs["finalidad"] = '';
		//$inputs["clave_municipio"] = $inputs["idmunicipio"];
		
		$rules = array(
			'fecha_reporte' => 'required|date_format:"d-m-Y"',
			'fecha_avaluo' => 'required|date_format:"d-m-Y"|before:fecha_reporte',
			'proposito' => 'required',
			//'cuenta_predial' => 'required:regex:/^[0-9]{2}-[URur]{1}-[0-9]{6}$/',
			//'cuenta_catastral' => 'required:regex:/^[0-9]{3}-[0-9]{4}-[0-9]{6}$/',
			'foliocoretemp' => 'required',
		);
		$messages = array(
			'fecha_reporte.required' => '¡El campo "Fecha del reporte" es requerido!',
			'fecha_reporte.date_format' => '¡El formato del campo "Fecha del reporte" es: dd-mm-aaaa!',
			'fecha_avaluo.required' => '¡El campo "Fecha del Avalúo" es requerido!',
			'fecha_avaluo.date_format' => '¡El formato del campo "Fecha del Avalúo" es: dd-mm-aaaa!',
			'fecha_avaluo.before' => '¡La "Fecha del Avalúo" debe ser menor a la "Fecha del reporte"!',
			'proposito.required' => '!El campo "Propósito" es requerido!',
			//'cuenta_catastral.required' => '¡¡La "Clave Catastral" es requerida!!',
			//'cuenta_catastral.regex' => '¡El formato de la "Clave Catastral no es válido"!',
			//'cuenta_predial.regex' => '¡El formato de la "Cuenta Predial no es válido"!',
			//'cuenta_catastral.required' => '¡¡La "Cuenta Predial" es requerida!!',
			'foliocoretemp' => '¡El folio COREVAT es requerido!',
		);
		$validate = Validator::make($inputs, $rules, $messages);
		if ($validate->fails()) {
			return Redirect::back()->withInput()->withErrors($validate);
		} else {
			Avaluos::insAvaluo($inputs);
			//$inputs["idmunicipio"] = $inputs["clave_municipio"];
			return Redirect::to('/corevat/AvaluoGeneral/' . $inputs["idavaluo"])->with('success', '¡El Avalúo fue creado satisfactoriamente!');
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id) {
		// lo voy a utiliar para mostrar el avalúo sin posibilidad de modificar
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id) {
		$idavaluo = $id;
		$opt = 'general';

		if ($id > 2147483647) {
			return Redirect::to('/corevat/index')->with('error', '¡El avalúo no existe!');
		} else {
			$id = (int) $id;
			$row = Avaluos::find($id);
			if (is_null($row)) {
				return Redirect::to('/corevat/index')->with('error', '¡El avalúo no existe!');
			} else if ( $row->estatus ) {
				return Redirect::to('/corevat/Avaluos')->with('error', '¡El avalúo ya fue registrado!');

			} else if (( Auth::user()->hasRole("Perito Valuador") && $row->iduser == Auth::id()) || !Auth::user()->hasRole("Perito Valuador")) {
				
				$row->fecha_reporte = date("d-m-Y", strtotime($row->fecha_reporte));
				$row->fecha_avaluo = date("d-m-Y", strtotime($row->fecha_avaluo));
				$row->is_otro_servicio = 0;
				$row->is_otro_equipamiento = 0;
				$title = 'Editando el registro: ' . $row['foliocoretemp'];
				$estados = Estados::select('idestado', 'clave', 'estado')->where('status', 1)->orderBy('estado')->get();

				$municipios = Municipios::select('municipio', 'clave', 'idmunicipio')
								->orderBy('municipio')
								->where('idestado', $row->idestado)
								->where('status', 1)->get();

				$cat_tipo_inmueble = CatTipoInmueble::comboList();
				$cat_regimen_propiedad = CatRegimenPropiedad::comboList();

				$mun = Municipios::find($row->idmunicipio);
				$lstCP = Asentamiento::where('municipio', $mun->clave)->distinct()->orderBy('codigo_postal')->lists('codigo_postal', 'codigo_postal');

				$cat_finalidad = CatFinalidad::comboList();
				$cat_titulo_persona = CatTituloPersona::comboList();
				return View::make('Corevat.Avaluos.avaluos', compact('opt', 'idavaluo', 'title', 'row', 'estados', 'municipios', 'cat_tipo_inmueble', 'cat_regimen_propiedad', 'lstCP', 'cat_finalidad', 'cat_titulo_persona'));
			} else {
				return Redirect::to('/corevat/index')->with('error', '¡Permiso denegado a este avalúo!');
			}
		}
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id) {
		$inputs = Input::All();
		//dd($inputs);
		$inputs["cuenta_catastral"] = trim($inputs["cuenta_catastral"]);
		$inputs["finalidad"] = '';
		$rules = array(
			'fecha_reporte' => 'required|date_format:"d-m-Y"',
			'fecha_avaluo' => 'required|date_format:"d-m-Y"|before:fecha_reporte',
			'proposito' => 'required',
			'cuenta_predial' => 'required:regex:/^[0-9]{2}-[URur]{1}-[0-9]{6}$/',
			'cuenta_catastral' => 'required:regex:/^[0-9]{3}-[0-9]{4}-[0-9]{6}$/',
			'foliocoretemp' => 'required',
		);
		$messages = array(
			'fecha_reporte.required' => '¡El campo "Fecha del reporte" es requerido!',
			'fecha_reporte.date_format' => '¡El formato del campo "Fecha del reporte" es: dd-mm-aaaa!',
			'fecha_avaluo.required' => '¡El campo "Fecha del Avalúo" es requerido!',
			'fecha_avaluo.date_format' => '¡El formato del campo "Fecha del Avalúo" es: dd-mm-aaaa!',
			'fecha_avaluo.before' => '¡La "Fecha del Avalúo" debe ser menor a la "Fecha del reporte"!',
			'proposito.required' => '!El campo "Propósito" es requerido!',
			'cuenta_catastral.required' => '¡¡La "Clave Catastral" es requerida!!',
			'cuenta_catastral.regex' => '¡El formato de la "Clave Catastral no es válido"!',
			'cuenta_predial.regex' => '¡El formato de la "Cuenta Predial no es válido"!',
			'cuenta_catastral.required' => '¡¡La "Cuenta Predial" es requerida!!',
			'foliocoretemp' => '¡El folio COREVAT es requerido!',
		);
		$validate = Validator::make($inputs, $rules, $messages);
		if ($validate->fails()) {
			return Redirect::back()->withInput()->withErrors($validate);
		} else {
			$inputs["updated_at"] = Carbon::now()->format('Y-m-d H:i:s');
			Avaluos::updAvaluo($id, $inputs);
			return Redirect::to('/corevat/AvaluoGeneral/' . $id)->with('success', '¡La modificación se efectuo satisfactoriamente!');
		}
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id) {
		
		$row = Avaluos::find($id);
		if (is_null($row)) {
			return Redirect::to('/corevat/Avaluos')->with('error', '¡El avalúo no existe!');
		} else if ( $row->estatus ) {
			return Redirect::to('/corevat/Avaluos')->with('error', '¡El avalúo ya fue registrado!');
		}
		
		$message = '¡El Avalúo fue eliminado satisfactoriamente!';
		Avaluos::where('idavaluo', '=', $id)->delete();

		$dir = public_path() . '/corevat/files/';
		if (file_exists($dir . 'croquis-' . $id . '.jpg')) {
			if (!unlink($dir . 'croquis-' . $id . '.jpg')) {
				$message .= '<br />El archivo "croquis-' . $id . '.jpg" no se pudo eliminar';
			}
		}
		if (file_exists($dir . 'fachada-' . $id . '.jpg')) {
			if (!unlink($dir . 'fachada-' . $id . '.jpg')) {
				$message .= '<br />El archivo "fachada-' . $id . '.jpg" no se pudo eliminar';
			}
		}
		if (file_exists($dir . 'foto0-' . $id . '.jpg')) {
			if (!unlink($dir . 'foto0-' . $id . '.jpg')) {
				$message .= '<br />El archivo "foto0-' . $id . '.jpg" no se pudo eliminar';
			}
		}
		if (file_exists($dir . 'foto1-' . $id . '.jpg')) {
			if (!unlink($dir . 'foto1-' . $id . '.jpg')) {
				$message .= '<br />El archivo "foto1-' . $id . '.jpg" no se pudo eliminar';
			}
		}
		if (file_exists($dir . 'foto2-' . $id . '.jpg')) {
			if (!unlink($dir . 'foto2-' . $id . '.jpg')) {
				$message .= '<br />El archivo "foto2-' . $id . '.jpg" no se pudo eliminar';
			}
		}
		if (file_exists($dir . 'foto3-' . $id . '.jpg')) {
			if (!unlink($dir . 'foto3-' . $id . '.jpg')) {
				$message .= '<br />El archivo "foto3-' . $id . '.jpg" no se pudo eliminar';
			}
		}
		if (file_exists($dir . 'foto4-' . $id . '.jpg')) {
			if (!unlink($dir . 'foto4-' . $id . '.jpg')) {
				$message .= '<br />El archivo "foto4-' . $id . '.jpg" no se pudo eliminar';
			}
		}
		if (file_exists($dir . 'foto5-' . $id . '.jpg')) {
			if (!unlink($dir . 'foto5-' . $id . '.jpg')) {
				$message .= '<br />El archivo "foto5-' . $id . '.jpg" no se pudo eliminar';
			}
		}
		if (file_exists($dir . 'plano0-' . $id . '.jpg')) {
			if (!unlink($dir . 'plano0-' . $id . '.jpg')) {
				$message .= '<br />El archivo "plano0-' . $id . '.jpg" no se pudo eliminar';
			}
		}

		return Redirect::to('corevat/Avaluos')->with('success', $message);
	}

	
	public function clonar() {
		$response = array('success' => true, 'message' => '¡El avalúo fue duplicado satisfactoriamente!');
		$inputs = Input::All();
		$rows = Avaluos::select('idavaluo', 'foliocoretemp')->where('foliocoretemp', '=', $inputs["folio_corevat"])->first();
		if ( isset($rows) ) {
			$response['message'] = '<span style="color:red;">¡El folio ya esta asignado al<br />Avalúo: '.$rows["idavaluo"].'!</span>';
			$response['success'] = false;
		} else {
			$idavaluonew = Avaluos::clonarAvaluo($inputs["idavaluo_clonar"], $inputs["folio_corevat"]);
			$this->clonarInmuebleArchivos($inputs["idavaluo_clonar"], $idavaluonew);
			$this->clonarFotosArchivos($inputs["idavaluo_clonar"], $idavaluonew);
		}
		return $response;
	}

	private function clonarInmuebleArchivos($idavaluoold, $idavaluonew) {
		$rowInmuebleOld = Avaluos::find($idavaluoold)->AvaluosInmueble;
		$rowInmuebleNew = Avaluos::find($idavaluonew)->AvaluosInmueble;
		//$row->croquis = 'croquis-' . $row->idavaluo . '.' . Input::file('croquis')->guessExtension();
		// SI $rowInmuebleOld->croquis != ''
		//$croquis = 
		$rowInmuebleNew->croquis = '';
		$rowInmuebleNew->fachada = '';
	}
	
	private function clonarFotosArchivos($idavaluoold, $idavaluonew) {
		$rowFotosOld = Avaluos::find($idavaluoold)->AvaluosFotos;
		$rowFotosNew = Avaluos::find($idavaluonew)->AvaluosFotos;
	}
	
	
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 * corevat, cuenta , clave catastral,  y valor final en el avaluo.
	 */
	public function registrarAvaluo($idavaluo) {
		$rowAvaluo = Avaluos::find($idavaluo);
		$rowInmueble = Avaluos::find($idavaluo)->AvaluosInmueble;
		$rowConclusion = Avaluos::find($idavaluo)->AvaluosConclusiones;

		$opt = 'registrar';
		$title = 'Registro del avalúo: ' . $rowAvaluo['foliocoretemp'];

		$errors = array();
		if ( $rowInmueble->segun == '' || is_null($rowInmueble->segun) ) {
			$errors[] = '¡Que en los datos del "Inmueble" no esta capturado el campo "Segun"!';

		} else if ( $rowInmueble->superficie_total_terreno == 0 || is_null($rowInmueble->superficie_total_terreno) ) {
			$errors[] = '¡Que en los datos del "Inmueble" no esta capturado el campo "Superficie Total del Terreno M²"!';

		} else if (  $rowInmueble->superficie_terreno == 0 || is_null($rowInmueble->superficie_terreno) ) {
			$errors[] = '¡Que en los datos del "Inmueble" no esta capturado el campo "Superficie del Terreno M²"!';

		} else if ( $rowAvaluo->cuenta_predial == '' || is_null($rowAvaluo->cuenta_predial) ) {
			$errors[] = '¡No cuenta con la "Cuenta Predial"!';

		} else if ( $rowAvaluo->cuenta_catastral == '' || is_null($rowAvaluo->cuenta_catastral) ) {
			$errors[] = '¡No cuenta con la "Clave Catastral"!';

		} else if ( $rowConclusion->valor_concluido <= 0 ) {
			$errors[] = '¡No cuenta con el "Valor Concluido"!';

		} else if ( !AefConstrucciones::validSuperficie($idavaluo) ) {
			$errors[] = '¡La Superficie de Construcción esta incompleta!';
		}
		//Select de folio
		$folio = ['' => '--Seleccione una opcion--']+$this->FoliosComprados->where('perito_id',93)->where('num_avaluo',null)->lists('numero_folio','id');
		
		return View::make('Corevat.Avaluos.avaluos', compact('opt', 'idavaluo', 'title', 'rowAvaluo', 'errors', 'folio'));
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function registrarAvaluoExe($id) {
		$inputs = Input::All();

		$rowAvaluo = Avaluos::find($id);
		$rowAvaluo->estatus = true;
		$rowAvaluo->save();
		
		$folio=$rowAvaluo->foliocoretemp;
		$n = FoliosComprados::find($inputs["num_avaluo"]);
		$n->num_avaluo = $folio;
		$n->save();

		$response = array();
		$response['success'] = true;
		$response['message'] = '¡El avalúo quedo registrado!';
		return Response::json($response);
		
	}
	
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function registrarAvaluoPrint($id) {
		$avaluo = Avaluos::getAvaluo($id);
		$pdf = new Fpdf();
		$pdf->AliasNbPages();
		$pdf->AddPage();

		$pdf->Image(public_path() . "/css/images/corevat/crv-01.jpg", null, null, 130, 25);
		//$this->Image($this->logo_perito, 170, 10, 30, 25);
		$pdf->Ln(10);

		$pdf->SetFillColor(164, 164, 164);
		$pdf->SetFont('Arial', 'B', 12);
		$pdf->Cell(0, 8, utf8_decode('ACUSE DE REGISTRO'), 'TLBR', 1, 'C', 1);

		$pdf->Ln(3);

		$pdf->SetFont('Arial', 'B', 10);
		$pdf->Cell(50, 6, utf8_decode("Folio COREVAT: "), 'LTB', 0, 'R');
		$pdf->SetFont('Arial', '', 10);
		$pdf->Cell(140, 6, $avaluo->foliocoretemp, 'LTBR', 1, 'L', 0);

		$pdf->SetFont('Arial', 'B', 10);
		$pdf->Cell(50, 6, utf8_decode("Nombre del Valuador: "), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 10);
		$pdf->Cell(140, 6, utf8_decode($avaluo->apellidos) . ' ' . utf8_decode($avaluo->nombres), 'LRB', 1, 'L');
		
		$pdf->SetFont('Arial', 'B', 10);
		$pdf->Cell(50, 6, utf8_decode("Fecha del Registro: "), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 10);
		$pdf->Cell(140, 6, Carbon::now()->format('Y-m-d H:i:s'), 'LRB', 1, 'L');
		//$inputs["updated_at"] = Carbon::now()->format('Y-m-d H:i:s');

		$pdf->Ln(3);

		$pdf->SetFont('Arial', 'B', 6);
		$pdf->Cell(0, 6, utf8_decode("El presente avalúo pasa a formar parte del Padrón Catastral. Por lo tanto me sujeto a las condiciones de confidencialidad de la información catastral. "), '', 0, 'L');

		$pdf->Output();
		exit;
	}
	
}
