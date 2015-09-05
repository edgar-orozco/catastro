<?php

use Carbon\Carbon;

class corevat_AvaluosController extends \BaseController {

	protected $avaluo;
	protected $idavaluo;

	public function __construct(Avaluos $avaluo) {
		$this->avaluo = $avaluo;
		$this->idavaluo = $avaluo->idavaluo;
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

		$estados = Estados::orderBy('estado')->where('idestado', 1)->where('status', 1)->lists('estado', 'idestado');
		$municipios = Municipios::orderBy('municipio')->where('idestado', 1)->where('status', 1)->lists('municipio', 'clave', 'idmunicipio');

		$cat_tipo_inmueble = CatTipoInmueble::comboList();
		$cat_regimen_propiedad = CatRegimenPropiedad::comboList();
		$idavaluo = 0;

		$lstCP = Asentamiento::where('municipio', '001')->distinct()->orderBy('codigo_postal')->lists('codigo_postal', 'codigo_postal');

		return View::make('Corevat.Avaluos.create', compact('title', 'row', 'estados', 'municipios', 'cat_tipo_inmueble', 'cat_regimen_propiedad', 'idavaluo', 'lstCP'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store() {
		$inputs = Input::All();
		$rules = array(
			'fecha_reporte' => 'required|date_format:"d-m-Y"',
			'fecha_avaluo' => 'required|date_format:"d-m-Y"|before:fecha_reporte',
			'proposito' => 'required',
			'finalidad' => 'required',
			'lon0' => 'integer|min:0|max:360',
			'lon1' => 'integer|min:0|max:60',
			'lon2' => 'numeric|min:0|max:60',
			'lat0' => 'integer|min:0|max:360',
			'lat1' => 'integer|min:0|max:60',
			'lat2' => 'numeric|min:0|max:60',
			'cuenta_predial' => 'regex:/^[0-9]{2}-[UR]{1}-[0-9]{6}$/',
			'cuenta_catastral' => 'regex:/^[0-9]{3}-[0-9]{4}-[0-9]{6}$/',
			'foliocoretemp' => 'required',
		);
		$messages = array(
			'fecha_reporte.required' => '¡El campo "Fecha del reporte" es requerido!',
			'fecha_reporte.date_format' => '¡El formato del campo "Fecha del reporte" es: dd-mm-aaaa!',
			'fecha_avaluo.required' => '¡El campo "Fecha del Avalúo" es requerido!',
			'fecha_avaluo.date_format' => '¡El formato del campo "Fecha del Avalúo" es: dd-mm-aaaa!',
			'fecha_avaluo.before' => '¡La "Fecha del Avalúo" debe ser menor a la "Fecha del reporte"!',
			'proposito.required' => '!El campo "Propósito" es requerido!',
			'finalidad.required' => '!El campo "Finalidad" es requerido!',
			'lon0.integer' => '!El valor correspondiente a los grados de la longitud debe ser un número entero positivo!',
			'lon0.min' => '!El valor mínimo correspondiente a los grados de la longitud debe ser cero!',
			'lon0.max' => '!El valor máximo correspondiente a los grados de la longitud debe ser 360!',
			'lon1.integer' => '¡El valor correspondiente a los minutos de la longitud debe ser un número entero positivo!',
			'lon1.min' => '!El valor mínimo correspondiente a los minutos de la longitud debe ser cero!',
			'lon1.max' => '!El valor máximo correspondiente a los minutos de la longitud debe ser 60!',
			'lon2.numeric' => '¡El valor correspondiente a los segundos de la longitud debe ser un número entero positivo!',
			'lon2.min' => '¡El valor mínimo correspondiente a los segundos de la longitud debe ser cero!',
			'lon2.max' => '¡El valor máximo correspondiente a los segundos de la longitud debe ser 60!',
			'lat0.integer' => 'El valor correspondiente a los grados de la latitud debe ser un número entero positivo!',
			'lat0.min' => 'El valor mínimo correspondiente a los grados de la latitud debe ser cero!',
			'lat0.max' => 'El valor mínimo correspondiente a los grados de la latitud debe ser 360!',
			'lat1.integer' => 'El valor correspondiente a los minutos de la latitud debe ser un número entero positivo!',
			'lat1.min' => 'El valor mínimo correspondiente a los minutos de la latitud debe ser cero!',
			'lat1.max' => 'El valor máximo correspondiente a los minutos de la latitud debe ser 60!',
			'lat2.numeric' => '¡El valor correspondiente a los minutos de la latitud debe ser un número entero positivo!',
			'lat2.min' => '¡El valor mínimo correspondiente a los segundos de la latitud debe ser cero!',
			'lat2.max' => '¡El valor máximo correspondiente a los segundos de la latitud debe ser 60!',
			'cuenta_catastral.regex' => '¡El formato de la "Clave Catastral no es válido"!',
			'cuenta_predial.regex' => '¡El formato de la "Cuenta Predial no es válido"!',
			'foliocoretemp' => '¡El folio COREVAT es requerido!',
		);
		$validate = Validator::make($inputs, $rules, $messages);
		if ($validate->fails()) {
			return Redirect::back()->withInput()->withErrors($validate);
		} else {
			Avaluos::insAvaluo($inputs);
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
			;
		} else {
			$id = (int) $id;
			$row = Avaluos::find($id);
			if (is_null($row)) {
				return Redirect::to('/corevat/index')->with('error', '¡El avalúo no existe!');
				;
			} else if (( Auth::user()->hasRole("Perito Valuador") && $row->iduser == Auth::id()) || !Auth::user()->hasRole("Perito Valuador")) {
				$row->fecha_reporte = date("d-m-Y", strtotime($row->fecha_reporte));
				$row->fecha_avaluo = date("d-m-Y", strtotime($row->fecha_avaluo));
				$row->is_otro_servicio = 0;
				$row->is_otro_equipamiento = 0;
				$title = 'Editando el registro: ' . $row['foliocoretemp'];
				// $municipios = Municipios::comboList();
				$estados = Estados::comboList();
				$municipios = Municipios::orderBy('municipio')->where('idestado', $row->idestado)->where('status', 1)->lists('municipio', 'clave', 'idmunicipio');
				$cat_tipo_inmueble = CatTipoInmueble::comboList();
				$cat_regimen_propiedad = CatRegimenPropiedad::comboList();

				$mun = Municipios::find($row->idmunicipio);
				$lstCP = Asentamiento::where('municipio', $mun->clave)->distinct()->orderBy('codigo_postal')->lists('codigo_postal', 'codigo_postal');
				//$folios_corevat = Avaluos::getFoliosDisponibles(Auth::id());
				return View::make('Corevat.Avaluos.avaluos', compact('opt', 'idavaluo', 'title', 'row', 'estados', 'municipios', 'cat_tipo_inmueble', 'cat_regimen_propiedad', 'lstCP'));
			} else {
				return Redirect::to('/corevat/index')->with('error', '¡Permiso denegado a este avalúo!');
				;
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
		$inputs["cuenta_catastral"] = trim($inputs["cuenta_catastral"]);
		$rules = array(
			'fecha_reporte' => 'required|date_format:"d-m-Y"',
			'fecha_avaluo' => 'required|date_format:"d-m-Y"|before:fecha_reporte',
			'proposito' => 'required',
			'finalidad' => 'required',
			'lon0' => 'integer|min:0|max:360',
			'lon1' => 'integer|min:0|max:60',
			'lon2' => 'numeric|min:0|max:60',
			'lat0' => 'integer|min:0|max:360',
			'lat1' => 'integer|min:0|max:60',
			'lat2' => 'numeric|min:0|max:60',
			'cuenta_predial' => 'regex:/^[0-9]{2}-[URur]{1}-[0-9]{6}$/',
			'cuenta_catastral' => 'regex:/^[0-9]{3}-[0-9]{4}-[0-9]{6}$/',
			'foliocoretemp' => 'required',
		);
		$messages = array(
			'fecha_reporte.required' => '¡El campo "Fecha del reporte" es requerido!',
			'fecha_reporte.date_format' => '¡El formato del campo "Fecha del reporte" es: dd-mm-aaaa!',
			'fecha_avaluo.required' => '¡El campo "Fecha del Avalúo" es requerido!',
			'fecha_avaluo.date_format' => '¡El formato del campo "Fecha del Avalúo" es: dd-mm-aaaa!',
			'fecha_avaluo.before' => '¡La "Fecha del Avalúo" debe ser menor a la "Fecha del reporte"!',
			'proposito.required' => '!El campo "Propósito" es requerido!',
			'finalidad.required' => '!El campo "Finalidad" es requerido!',
			'lon0.integer' => '!El valor correspondiente a los grados de la longitud debe ser un número entero positivo!',
			'lon0.min' => '!El valor mínimo correspondiente a los grados de la longitud debe ser cero!',
			'lon0.max' => '!El valor máximo correspondiente a los grados de la longitud debe ser 360!',
			'lon1.integer' => '¡El valor correspondiente a los minutos de la longitud debe ser un número entero positivo!',
			'lon1.min' => '!El valor mínimo correspondiente a los minutos de la longitud debe ser cero!',
			'lon1.max' => '!El valor máximo correspondiente a los minutos de la longitud debe ser 60!',
			'lon2.numeric' => '¡El valor correspondiente a los segundos de la longitud debe ser un número entero positivo!',
			'lon2.min' => '¡El valor mínimo correspondiente a los segundos de la longitud debe ser cero!',
			'lon2.max' => '¡El valor máximo correspondiente a los segundos de la longitud debe ser 60!',
			//'lon2.regex' => '¡El formato de los segundos no es válido!',
			'lat0.integer' => 'El valor correspondiente a los grados de la latitud debe ser un número entero positivo!',
			'lat0.min' => 'El valor mínimo correspondiente a los grados de la latitud debe ser cero!',
			'lat0.max' => 'El valor mínimo correspondiente a los grados de la latitud debe ser 360!',
			'lat1.integer' => 'El valor correspondiente a los minutos de la latitud debe ser un número entero positivo!',
			'lat1.min' => 'El valor mínimo correspondiente a los minutos de la latitud debe ser cero!',
			'lat1.max' => 'El valor máximo correspondiente a los minutos de la latitud debe ser 60!',
			'lat2.numeric' => '¡El valor correspondiente a los minutos de la latitud debe ser un número entero positivo!',
			'lat2.min' => '¡El valor mínimo correspondiente a los segundos de la latitud debe ser cero!',
			'lat2.max' => '¡El valor máximo correspondiente a los segundos de la latitud debe ser 60!',
			//'lat2.regex' => 'El formato de los segundos no es válido!',
			'cuenta_catastral.regex' => '¡El formato de la "Clave Catastral no es válido"!',
			'cuenta_predial.regex' => '¡El formato de la "Cuenta Predial no es válido"!',
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

}
