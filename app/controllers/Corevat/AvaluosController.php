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
	public function index($format = 'html') {
		$title = 'COREVAT';
		$row = $this->avaluo;
		$rows = Avaluos::orderBy('idavaluo','desc')->get();
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
		//$row['fecha_reporte'] = date("d-m-Y");
		//$row['fecha_avaluo'] = date("d-m-Y");
		
		$row['fecha_reporte'] =  new Carbon();
		$row['fecha_reporte'] = $row['fecha_reporte']->format('d-m-Y');
		
		$row['fecha_avaluo'] =  new Carbon('last day');
		$row['fecha_avaluo'] = $row['fecha_avaluo']->format('d-m-Y');
		
		$row['lon0'] = $row['lon1'] = $row['lat0'] = $row['lat1'] = 0;
		$row['lon2'] = $row['lat2'] = '0.00';
		
		// $estados = Estados::comboList();
		// $municipios = Municipios::comboList();

		$estados = Estados::orderBy('estado')->where('idestado', 1)->where('status', 1)->lists('estado', 'idestado');
		$municipios = Municipios::orderBy('municipio')->where('idestado', 1)->where('status', 1)->lists('municipio', 'clave','idmunicipio');

		$cat_tipo_inmueble = CatTipoInmueble::comboList();
		$cat_regimen_propiedad = CatRegimenPropiedad::comboList();
		$idavaluo = 0;

		$lstCP = Asentamiento::where('municipio','001')->distinct()->orderBy('codigo_postal')->lists('codigo_postal', 'codigo_postal');
//		$lstCP =  array('0' => '0',);
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
			'foliocoretemp' => 'required',
			
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
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($opt, $id) {
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function editGeneral($id) {
		$idavaluo = $id;
		$opt = 'general';
		$row = Avaluos::find($id);
		$row->fecha_reporte = date("d-m-Y", strtotime($row->fecha_reporte));
		$row->fecha_avaluo = date("d-m-Y", strtotime($row->fecha_avaluo));
		$row->is_otro_servicio = 0;
		$row->is_otro_equipamiento = 0;
		$title = 'Editando el registro: ' . $row['foliocoretemp'];
		// $municipios = Municipios::comboList();
		$estados = Estados::comboList();
		$municipios = Municipios::orderBy('municipio')->where('idestado', $row->idestado)->where('status', 1)->lists('municipio', 'clave','idmunicipio');
		$cat_tipo_inmueble = CatTipoInmueble::comboList();
		$cat_regimen_propiedad = CatRegimenPropiedad::comboList();

		$mun = Municipios::find($row->idmunicipio);
		$lstCP = Asentamiento::where('municipio',$mun->clave)->distinct()->orderBy('codigo_postal')->lists('codigo_postal', 'codigo_postal');

		return View::make('Corevat.Avaluos.avaluos', compact('opt', 'idavaluo', 'title', 'row', 'estados', 'municipios', 'cat_tipo_inmueble', 'cat_regimen_propiedad','lstCP'));
	
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function updateGeneral($id) {
		$inputs = Input::All();
		$inputs["cuenta_catastral"] = trim($inputs["cuenta_catastral"]);
		$rules = array(
			'fecha_reporte' => 'required|date_format:"d-m-Y"',
			'fecha_avaluo' => 'required|date_format:"d-m-Y"|before:fecha_reporte',
			'foliocoretemp' => 'required',
			
			'proposito' => 'required',
			'finalidad' => 'required',
			
			'lon0' => 'integer|min:0|max:60',
			'lon1' => 'integer|min:0|max:60',
			'lon2' => 'numeric|min:0|max:60',
			
			'lat0' => 'integer|min:0|max:360',
			'lat1' => 'integer|min:0|max:60',
			'lat2' => 'numeric|min:0|max:60',
			
			'cuenta_catastral' => 'regex:/^[0-9]{3}-[0-9]{4}-[0-9]{6}$/',
			'cuenta_predial' => 'regex:/^[0-9]{2}-[UR]{1}-[0-9]{6}$/',
			
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
			
		);
		$validate = Validator::make($inputs, $rules, $messages);
		if ($validate->fails()) {
			return Redirect::back()->withInput()->withErrors($validate);
		} else {
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
	public function editZona($id) {
		$idavaluo = $id;
		$opt = 'zona';
		$rowA = Avaluos::find($id);
		$title = 'Características de la Zona: ' . $rowA['foliocoretemp'];
		$row = Avaluos::find($id)->AvaluosZona;
		if (count($row) <= 0) {
			AvaluosZona::insAvaluoZona($id);
			$row = Avaluos::find($id)->AvaluosZona;
		}
		$cat_clasificacion_zona = CatClasificacionZona::comboList();
		$cat_proximidad_urbana = CatProximidadUrbana::comboList();

		return View::make('Corevat.Avaluos.avaluos', compact('opt', 'idavaluo', 'idavaluozona', 'title', 'row', 'cat_clasificacion_zona', 'cat_proximidad_urbana'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function updateZona($id) {
		$inputs = Input::All();
		$rules = array(
			'nivel_equipamiento' => 'integer|min:0|max:100',
		);
		$messages = array(
			'nivel_equipamiento.integer' => '¡El campo "Nivel de Equipamiento" debe ser un entero positivo!',
			'nivel_equipamiento.min' => '¡El valor mínimo del campo "Nivel de Equipamiento" debe ser cero!',
			'nivel_equipamiento.min' => '¡El valor máximo del campo "Nivel de Equipamiento" debe ser 100!',
		);
		$validate = Validator::make($inputs, $rules);
		if ($validate->fails()) {
			return Redirect::back()->withInput()->withErrors($validate);
		} else {
			AvaluosZona::updAvaluosZona($id, $inputs);
			return Redirect::to('/corevat/AvaluoZona/' . $id)->with('success', '¡El registro fue modificado satisfactoriamente!');
		}
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function editInmueble($id) {
		$idavaluo = $id;
		$opt = 'inmueble';
		$row = Avaluos::find($id);
		$title = 'Características del Inmueble: ' . $row['foliocoretemp'];
		$row = Avaluos::find($id)->AvaluosInmueble;
		if (count($row) <= 0) {
			AvaluosInmueble::insAvaluoInmueble($id);
			$row = Avaluos::find($id)->AvaluosInmueble;
		}
		$cat_cimentaciones = CatCimentaciones::comboList();
		$cat_estructuras = CatEstructuras::comboList();
		$cat_muros = CatMuros::comboList();
		$cat_entrepisos = CatEntrepisos::comboList();
		$cat_techos = CatTechos::comboList();
		$cat_bardas = CatBardas::comboList();
		$cat_usos_suelos = CatUsosSuelos::comboList();
		$cat_niveles = CatNiveles::comboList();
		
		$cat_pisos = CatPisos::comboList();
		$cat_aplanados = CatAplanados::comboList();
		$cat_plafones = CatPlafones::comboList();
		$cat_orientaciones = CatOrientaciones::comboList();
		//
		//$ai_medidas_colindancias = AiMedidasColindancias::AiMedidasColindanciasByFk($row->idavaluoinmueble);
		
		$croquis = $row->croquis != '' ? '/corevat/files/' . $row->croquis : '';
		$fachada = $row->fachada != '' ? '/corevat/files/' . $row->fachada : '';

		$arrMedCol = array('Metros'=>'Metros','Metros Cuadrados'=>'Metros Cuadrados','Metros Cúbicos'=>'Metros Cúbicos','Metros Lineales'=>'Metros Lineales','Kilometros'=>'Kilometros','Kilometros Cuadrados'=>'Kilometros Cuadrados','Hectareas'=>'Hectareas','Hectareas Cuadradas'=>'Hectareas Cuadradas');

		//return View::make('Corevat.Avaluos.avaluos', compact('opt', 'idavaluo', 'title', 'row', 'cat_cimentaciones', 'cat_estructuras', 'cat_muros', 'cat_entrepisos', 'cat_techos', 'cat_bardas', 'cat_usos_suelos', 'cat_niveles', 'cat_pisos', 'cat_aplanados', 'cat_plafones', 'cat_orientaciones', 'ai_medidas_colindancias', 'arrMedCol', 'croquis','fachada'));
		return View::make('Corevat.Avaluos.avaluos', compact('opt', 'idavaluo', 'title', 'row', 'cat_cimentaciones', 'cat_estructuras', 'cat_muros', 'cat_entrepisos', 'cat_techos', 'cat_bardas', 'cat_usos_suelos', 'cat_niveles', 'cat_pisos', 'cat_aplanados', 'cat_plafones', 'cat_orientaciones', 'arrMedCol', 'croquis','fachada'));
	}

	/**
	 * Update the specified resource in storage.
	 *achada
	 * @param  int  $id
	 * @return Response
	 **/
	public function updateInmueble($id) {
		$inputs = Input::All();
		$rules = array(
			'unidades_rentables_escritura' => 'integer|min:0|max:9999',
			'superficie_total_terreno' => 'numeric|min:0.0001|max:9999999999.9999',
			'indiviso_terreno' => 'numeric|min:0|max:100.0000',
			'superficie_terreno' => 'numeric|min:0.0001|max:9999999999.9999',
			'indiviso_areas_comunes' => 'numeric|min:0|max:100.0000',
			'superficie_construccion' => 'numeric|min:0|max:9999999999.9999',
			'indiviso_accesoria' => 'numeric|min:0|max:9999999999.9999',
			'superficie_escritura' => 'numeric|min:0|max:9999999999.9999',
			'superficie_vendible' => 'numeric|min:0|max:9999999999.9999',
		);
		$messages = array(
			'unidades_rentables_escritura.integer' => '¡El campo "Unidades Rentables en la misma Estructura" debe ser un entero positivo!',
			'unidades_rentables_escritura.min' => '¡El valor mínimo del campo "Unidades Rentables en la misma Estructura" debe ser cero!',
			'unidades_rentables_escritura.max' => '¡El valor máximo del campo "Unidades Rentables en la misma Estructura" debe ser 9999!',
			
			'superficie_total_terreno.numeric' => '¡El campo "Superficie Total del Terreno" debe ser un número!',
			'superficie_total_terreno.min' => '¡El valor mínimo del campo "Superficie Total del Terreno" debe ser mayor a cero!',
			'superficie_total_terreno.max' => '¡El valor máximo del campo "Superficie Total del Terreno" debe ser 9999999999.9999!',
			
			'indiviso_terreno.numeric' => '¡El campo "Indiviso del Terreno (%)" debe ser un número!',
			'indiviso_terreno.min' => '¡El valor mínimo del campo "Indiviso del Terreno (%)" debe ser mayor cero!',
			'indiviso_terreno.max' => '¡El valor máximo del campo "Indiviso del Terreno (%)" debe ser 100.0000!',
			
			'superficie_terreno.numeric' => '¡El campo "Superfice del Terreno" debe ser un número!',
			'superficie_terreno.min' => '¡El valor mínimo del campo "Superfice del Terreno" debe ser mayor cero!',
			'superficie_terreno.max' => '¡El valor máximo del campo "Superfice del Terreno" debe ser 9999999999.9999!',
			
			'indiviso_areas_comunes.numeric' => '¡El campo "Indiviso de Áreas Comunes (%)" debe ser un número!',
			'indiviso_areas_comunes.min' => '¡El valor mínimo del campo "Indiviso de Áreas Comunes (%)" debe ser mayor o igual a cero!',
			'indiviso_areas_comunes.max' => '¡El valor máximo del campo "Indiviso de Áreas Comunes (%)" debe ser 100.0000!',
			
			'superficie_construccion.numeric' => '¡El campo "Superficie de Construcción" debe ser un número!',
			'superficie_construccion.min' => '¡El valor mínimo del campo "Superficie de Construcción" debe ser mayor o igual cero!',
			'superficie_construccion.max' => '¡El valor máximo del campo "Superficie de Construcción" debe ser 9999999999.9999!',
			
			'indiviso_accesoria.numeric' => '¡El campo "Edad de la Construcción (años)" debe ser un número!',
			'indiviso_accesoria.min' => '¡El valor mínimo del campo "Edad de la Construcción (años)" debe ser mayor o igual cero!',
			'indiviso_accesoria.max' => '¡El valor máximo del campo "Edad de la Construcción (años)" debe ser 9999999999.9999!',
			
			'superficie_escritura.numeric' => '¡El campo "Superficie Asentada en Escritura" debe ser un número!',
			'superficie_escritura.min' => '¡El valor mínimo del campo "Superficie Asentada en Escritura" debe ser mayor o igual cero!',
			'superficie_escritura.max' => '¡El valor máximo del campo "Superficie Asentada en Escritura" debe ser 9999999999.9999!',
			
			'superficie_vendible.numeric' => '¡El campo "Superficie Vendible" debe ser un número!',
			'superficie_vendible.min' => '¡El valor mínimo del campo "Superficie Vendible" debe ser mayor o igual cero!',
			'superficie_vendible.max' => '¡El valor máximo del campo "Superficie Vendible" debe ser 9999999999.9999!',
			'superficie_vendible.regex' => '¡El formato del campo "Superficie Vendible" debe ser 9999999999.9999!',
			
		);
		$validate = Validator::make($inputs, $rules, $messages);
		if ($validate->fails()) {
			return Redirect::back()->withInput()->withErrors($validate);
		} else {
			AvaluosInmueble::updAvaluosInmueble($id, $inputs);
			$message = '¡El registro fue modificado satisfactoriamente!';
			if (Input::hasFile('croquis') || Input::hasFile('fachada')) {
				$row = Avaluos::find($id)->AvaluosInmueble;
				if (Input::hasFile('croquis')) {
					// $fl = Input::file('croquis');
					// $c0 = explode('.',$fl->getClientOriginalName());
					$row->croquis = 'croquis-' . $row->idavaluo . '.' . Input::file('croquis')->guessExtension();
					Input::file('croquis')->move(public_path() . '/corevat/files/', $row->croquis);
					$message .= '<br />¡El croquis fue actualizado satisfactoriamente!';
				}
				if (Input::hasFile('fachada')) {
					// $fl = Input::file('fachada');
					// $c0 = explode('.',$fl->getClientOriginalName());		
					$row->fachada = 'fachada-' . $row->idavaluo  . '.' .  Input::file('fachada')->guessExtension();
					Input::file('fachada')->move(public_path() . '/corevat/files/', $row->fachada);
					$message .= '<br />¡La imagen de la fachada fue actualizada satisfactoriamente!';
				}
				$row->save();
			}
			return Redirect::to('/corevat/AvaluoInmueble/' . $id)->with('success', $message);
		}
	}

	/**
	 * Retorna los registros de la tabla ai_medidas_colindancias para cargar el dataTablY
	 *
	 * @param  int  $id [idavaluoinmueble]
	 * @return Response
	 */
	public function getAjaxAiMedidasColindancias($id) {
		return AiMedidasColindancias::AiMedidasColindanciasByFk($id);
	}
	
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function editMercado($id) {
		$idavaluo = $id;
		$opt = 'mercado';
		$rowAvaluos = Avaluos::find($id);
		$title = 'Enfoque de Mercado: ' . $rowAvaluos['foliocoretemp'];
		$row = Avaluos::find($id)->AvaluosMercado;
		if (count($row) <= 0) {
			AvaluosMercado::insAvaluoMercado($id);
			$row = Avaluos::find($id)->AvaluosMercado;
		}
		$aem_comp_terrenos = AvaluosMercado::find($row->idavaluoenfoquemercado)->AemCompTerrenos;
		$aem_homologacion = AvaluosMercado::find($row->idavaluoenfoquemercado)->AemHomologacion;
		$aem_informacion = AvaluosMercado::find($row->idavaluoenfoquemercado)->AemInformacion;
		$aem_analisis = AvaluosMercado::find($row->idavaluoenfoquemercado)->AemAnalisis;
		return View::make('Corevat.Avaluos.avaluos', compact('opt', 'idavaluo', 'title', 'row', 'aem_comp_terrenos', 'aem_homologacion', 'aem_informacion', 'aem_analisis'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function updateMercado() {
		$inputs = Input::All();
		if ($inputs['ctrl'] == 'btnNewAemComp' || $inputs['ctrl'] == 'btnEditAemComp') {
			$response = $this->setAemCompTerrenos($inputs);
		} else if ($inputs['ctrl'] == 'btnEditAemHom') {
			$response = $this->setAemHomologacion($inputs);
		} else if ($inputs['ctrl'] == 'btnNewAemInf' || $inputs['ctrl'] == 'btnEditAemInf') {
			$response = $this->setAemInformacion($inputs);
		} else if ($inputs['ctrl'] == 'btnEditAemAna') {
			$response = $this->setAemAnalisis($inputs);
		}

		return $response;
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function editFisico($id) {
		$idavaluo = $id;
		$opt = 'fisico';
		$rowAvaluos = Avaluos::find($id);
		$title = 'Enfoque de Físico: ' . $rowAvaluos['foliocoretemp'];
		$row = Avaluos::find($id)->AvaluosFisico;
		if (count($row) <= 0) {
			AvaluosFisico::insAvaluoFisico($id);
			$row = Avaluos::find($id)->AvaluosFisico;
		}
		
		$this->idavaluo = $idavaluo;

		$aef_terrenos = AefTerrenos::AefTerrenosByFk($row->idavaluoenfoquefisico);
		$aef_construcciones = AefConstrucciones::AefConstruccionesByFk($row->idavaluoenfoquefisico);
		$aef_condominios = AefCondominios::AefCondominiosByFk($row->idavaluoenfoquefisico);
		$aef_comp_construcciones = AefCompConstrucciones::AefCompConstruccionesByFk($row->idavaluoenfoquefisico);
		$aef_instalaciones = AefInstalaciones::AefInstalacionesByFk($row->idavaluoenfoquefisico);

		$cat_clase_general_inmueble = CatClaseGeneralInmueble::comboList();
		$cat_tipo_inmueble = CatTipoInmueble::comboList();
		$cat_estado_conservacion = CatEstadoConservacion::comboList();
		$cat_calidad_proyecto = CatCalidadProyecto::comboList();
		$cat_tipo = CatTipo::comboList();
		$cat_obras_complementarias = CatObrasComplementarias::comboList();

		return View::make('Corevat.Avaluos.avaluos', compact('opt', 'idavaluo', 'title', 'row', 'aef_terrenos', 'aef_construcciones', 'aef_condominios', 'aef_comp_construcciones', 'aef_instalaciones', 'cat_clase_general_inmueble', 'cat_tipo_inmueble', 'cat_estado_conservacion', 'cat_calidad_proyecto', 'cat_tipo', 'cat_obras_complementarias'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function updateFisico($id) {
		$inputs = Input::All();
		if (isset($inputs['idclasegeneralinmueble'])) {
			$rules = array(
				'edad_construccion' => 'numeric|min:0|max:999999999.9999|regex:/^[0-9]{1,3}$/',
				'vida_util' => 'numeric|min:0|max:999999999.9999|regex:/^[0-9]{1,3}$/',
			);
			$messages = array(
				'edad_construccion.numeric' => '¡El campo "Edad de la Construcción (Años)" debe ser un número!',
				'edad_construccion.min' => '¡El valor mínimo del campo "Edad de la Construcción (Años)" debe ser cero!',
				'edad_construccion.max' => '¡El valor máximo del campo "Edad de la Construcción (Años)" debe ser 999.99!',
				'edad_construccion.regex' => '¡El formato del campo "Edad de la Construcción (Años)" debe ser 999.99!',
				'vida_util.numeric' => '¡El campo "Vida Útil Remanente" debe ser un número!',
				'vida_util.min' => '¡El valor mínimo del campo "Vida Útil Remanente" debe ser cero!',
				'vida_util.max' => '¡El valor máximo del campo "Vida Útil Remanente" debe ser 999.99!',
				'vida_util.regex' => '¡El formato del campo "Vida Útil Remanente" debe ser 999.99!',
			);
			$validate = Validator::make($inputs, $rules, $messages);
			if ($validate->fails()) {
				return Redirect::back()->withInput()->withErrors($validate);
			} else {
				AvaluosFisico::updAvaluoFisico($id, $inputs);
				return Redirect::to('/corevat/AvaluoEnfoqueFisico/' . $id)->with('success', '¡El registro fue modificado satisfactoriamente!');
			}
		} else {
			if ($inputs['ctrl'] == 'btnNewAefTerrenos' || $inputs['ctrl'] == 'btnEditAefTerrenos') {
				$response = $this->setAefTerrenos($inputs);
			} else if ($inputs['ctrl'] == 'btnNewAefInstalaciones' || $inputs['ctrl'] == 'btnEditAefInstalaciones') {
				$response = $this->setAefInstalaciones($inputs);
			} else if ($inputs['ctrl'] == 'btnNewAefConstrucciones' || $inputs['ctrl'] == 'btnEditAefConstrucciones') {
				$response = $this->setAefConstrucciones($inputs);
			} else if ($inputs['ctrl'] == 'btnNewAefCondominios' || $inputs['ctrl'] == 'btnEditAefCondominios') {
				$response = $this->setAefCondominios($inputs);
			} else if ($inputs['ctrl'] == 'btnNewAefCompConstrucciones' || $inputs['ctrl'] == 'btnEditAefCompConstrucciones') {
				$response = $this->setAefCompConstrucciones($inputs);
			}
			return $response;
		}
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function editConclusiones($id) {
		$idavaluo = $id;
		$opt = 'conclusiones';
		$row = Avaluos::find($id);
		$title = 'Conclusiones: ' . $row['foliocoretemp'];
		$row = Avaluos::find($id)->AvaluosConclusiones;
		if (count($row) <= 0) {
			AvaluosConclusiones::insAvaluoConclusiones($id);
			$row = Avaluos::find($id)->AvaluosConclusiones;
		}

		return View::make('Corevat.Avaluos.avaluos', compact('opt', 'idavaluo', 'title', 'row'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function editFotos($id) {
		$idavaluo = $id;
		$opt = 'fotos';
		$row = Avaluos::find($id);
		$title = 'Fotos y Plano: ' . $row['foliocoretemp'];
		$row = Avaluos::find($id)->AvaluosFotos;
		if (count($row) <= 0) {
			AvaluosFotos::insAvaluoFotos($id);
			$row = Avaluos::find($id)->AvaluosFotos;
		}
		$foto0 = $row->foto0 != '' ? '/corevat/files/' . $row->foto0 : '';
		$foto1 = $row->foto1 != '' ? '/corevat/files/' . $row->foto1 : '';
		$foto2 = $row->foto2 != '' ? '/corevat/files/' . $row->foto2 : '';
		$foto3 = $row->foto3 != '' ? '/corevat/files/' . $row->foto3 : '';
		$foto4 = $row->foto4 != '' ? '/corevat/files/' . $row->foto4 : '';
		$foto5 = $row->foto5 != '' ? '/corevat/files/' . $row->foto5 : '';
		$plano0 = $row->plano0 != '' ? '/corevat/files/' . $row->plano0 : '';

		return View::make('Corevat.Avaluos.avaluos', compact('opt', 'idavaluo', 'title', 'row', 'foto0', 'foto1', 'foto2', 'foto3', 'foto4', 'foto5','plano0'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function updateConclusiones($id) {
		$inputs = Input::All();
		$row = Avaluos::find($id)->AvaluosConclusiones;
		//$row->valor_fisico = $row->valor_fisico;
		//$row->valor_mercado = $row->valor_mercado;
		$row->factor_seleccion_valor = $inputs["factor_seleccion_valor"];
		if ($inputs["factor_seleccion_valor"] == '1') {
			$row->valor_concluido = $row->valor_fisico;
		} else {
			$row->valor_concluido = $row->valor_mercado;
		}
		$row->leyenda = $inputs["leyenda"];
		//$row->sello = '';
		//$row->firma = '';
		$row->idemp = 1;
		$row->ip = $_SERVER['REMOTE_ADDR'];
		$row->host = isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : '';
		$row->modi_por = 1;
		$row->modi_el = date('Y-m-d H:i:s');
		$row->save();
		return Redirect::to('/corevat/AvaluoConclusiones/' . $id)->with('success', '¡La modificación se efectuo correctamente!');
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function updateFotos($id) {
		$inputs = Input::All();
		$row = Avaluos::find($id)->AvaluosFotos;

		$row->ftitulo0 = $inputs["ftitulo0"];
		$row->ftitulo1 = $inputs["ftitulo1"];
		$row->ftitulo2 = $inputs["ftitulo2"];
		$row->ftitulo3 = $inputs["ftitulo3"];
		$row->ftitulo4 = $inputs["ftitulo4"];
		$row->ftitulo5 = $inputs["ftitulo5"];
		$row->ptitulo0 = $inputs["ptitulo0"];

		$row->ip = $_SERVER['REMOTE_ADDR'];
		$row->host = isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : '';
		$row->modi_por = 1;
		$row->modi_el = date('Y-m-d H:i:s');

		if (Input::hasFile('foto0')) {
			$row->foto0 = 'foto0-' . $row->idavaluo  . '.' .  Input::file('foto0')->guessExtension();
			Input::file('foto0')->move(public_path() . '/corevat/files/', $row->foto0);
		}
		if (Input::hasFile('foto1')) {
			$row->foto1 = 'foto1-' . $row->idavaluo  . '.' .  Input::file('foto1')->guessExtension();
			Input::file('foto1')->move(public_path() . '/corevat/files/', $row->foto1);
		}
		if (Input::hasFile('foto2')) {
			$row->foto2 = 'foto2-' . $row->idavaluo  . '.' .  Input::file('foto2')->guessExtension();
			Input::file('foto2')->move(public_path() . '/corevat/files/', $row->foto2);
		}
		if (Input::hasFile('foto3')) {
			$row->foto3 = 'foto3-' . $row->idavaluo  . '.' .  Input::file('foto3')->guessExtension();
			Input::file('foto3')->move(public_path() . '/corevat/files/', $row->foto3);
		}
		if (Input::hasFile('foto4')) {
			$row->foto4 = 'foto4-' . $row->idavaluo  . '.' .  Input::file('foto4')->guessExtension();
			Input::file('foto4')->move(public_path() . '/corevat/files/', $row->foto4);
		}
		if (Input::hasFile('foto5')) {
			$row->foto5 = 'foto5-' . $row->idavaluo  . '.' .  Input::file('foto5')->guessExtension();
			Input::file('foto5')->move(public_path() . '/corevat/files/', $row->foto5);
		}
		if (Input::hasFile('plano0')) {
			$row->plano0 = 'plano0-' . $row->idavaluo  . '.' .  Input::file('plano0')->guessExtension();
			Input::file('plano0')->move(public_path() . '/corevat/files/', $row->plano0);
		}
		$row->save();

		return Redirect::to('/corevat/AvaluoFotos/' . $id)->with('success', '¡La modificación se efectuo correctamente!');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function setAiMedidasColindancias() {
		$inputs = Input::All();
		$response = array('success' => true, 'message' => '', 'errors' => '', 'idTable' => '');
		$rules = array(
			'medidas' => 'required|numeric|min:0.0001|max:9999999999.9999',
			'unidad_medida' => 'required',
			'colindancia' => 'required',
		);
		$messages = array(
			'medidas.required' => '¡El campo "Medidas" es requerido!',
			'medidas.min' => '¡El valor mínimo del campo "Medidas" es "0.0001"!',
			'medidas.max' => '¡El valor máximo del campo "Medidas" es "9999999999.9999"!',
			'unidad_medida.required' => '¡El campo "Unidad de Medida" es requerido!',
			'colindancia.required' => '¡El campo "Colindancias" es requerido!',
		);
		$validate = Validator::make($inputs, $rules, $messages);
		if ($validate->fails()) {
			$response['success'] = false;
			$response['errors'] = $validate->getMessageBag()->toArray();
		} else {
			if ($inputs['ctrl'] == 'ins') {
				$response['idTable'] = AiMedidasColindancias::insAiMedidasColindancias($inputs);
				$response['message'] = '¡El registro fue ingresado satisfactoriamente!';
			} else {
				$response['idTable'] = AiMedidasColindancias::updAiMedidasColindancias($inputs);
				$response['message'] = '¡El registro fue modificado satisfactoriamente!';
			}
			$response['success'] = true;
		}
		return Response::json($response);
	}

	/*
	 * 
	 */

	private function setAemCompTerrenos($inputs) {
		$idaemcompterreno = 0;
		$rules = array(
			'ubicacion' => 'required',
			'precio' => array('required', 'numeric', 'min:0.00', 'max:99999999.99', 'regex:/^[0-9]{1,8}(\.?)[0-9]{1,2}$/'),
			'superficie_terreno' => array('required', 'numeric', 'min:0.00', 'max:99999999.99', 'regex:/^[0-9]{1,8}(\.?)[0-9]{1,2}$/'),
			'observaciones' => 'required',
		);
		$messages = array(
			'ubicacion.required' => '¡El campo "Ubicación" es requerido!',
			'precio.required' => '¡El campo "Precio" es requerido!',
			'precio.numeric' => '¡El valor del campo "Precio" debe ser numérico!',
			'precio.min' => '¡El valor mínimo del campo "Precio" debe ser cero!',
			'precio.max' => '¡El valor máximo del campo "Precio" debe ser 99999999.99!',
			'precio.regex' => '¡El formato del campo "Precio" debe ser 99999999.99!',
			'superficie_terreno.required' => '¡El campo "Superficie del Terreno" es requerido!',
			'superficie_terreno.numeric' => '¡El valor del campo "Superficie del Terreno" debe ser numérico!',
			'superficie_terreno.min' => '¡El valor del campo "Superficie del Terreno" debe ser cero!',
			'superficie_terreno.max' => '¡El valor del campo "Superficie del Terreno" debe ser 99999999.99!',
			'superficie_terreno.regex' => '¡El formato del campo "Superficie del Terreno" debe ser 99999999.99!',
			'observaciones.required' => '¡El campo "Observaciones" es requerido!',
		);
		$validate = Validator::make($inputs, $rules, $messages);
		if ($validate->fails()) {
			$response = array('success' => false, 'errors' => $validate->getMessageBag()->toArray());
		} else {
			if ($inputs['ctrl'] == 'btnNewAemComp') {
				AemCompTerrenos::insAemCompTerrenos($inputs, $idaemcompterreno);
				$response = array('success' => true, 'message' => '¡El registro fue ingresado satisfactoriamente!', 'ctrl' => 'btnEditAemComp', 'idTable' => $idaemcompterreno);
			} else {
				AemCompTerrenos::updAemCompTerrenos($inputs);
				$response = array('success' => true, 'message' => '¡El registro fue modificado satisfactoriamente!', 'ctrl' => 'btnEditAemComp', 'idTable' => $inputs["idTable"]);
			}
		}
		return $response;
	}

	/*
	 * 
	 */

	private function setAemHomologacion($inputs) {
		$rules = array(
			'valor_unitario_negociable' => array('required', 'numeric', 'min:0.00', 'max:0.99', 'regex:/^[0]{1}(\.?)[0-9]{1,2}$/'),
		);
		$messages = array(
			'valor_unitario_negociable.required' => '¡El campo "Negociable" es requerido!',
			'valor_unitario_negociable.numeric' => '¡El valor del campo "Negociable" debe ser numérico!',
			'valor_unitario_negociable.min' => '¡El valor del campo "Negociable" debe ser cero!',
			'valor_unitario_negociable.max' => '¡El valor del campo "Negociable" debe ser 0.99!',
			'valor_unitario_negociable.regex' => '¡El formato del campo "Negociable" debe ser 0.99!',
		);
		$validate = Validator::make($inputs, $rules, $messages);
		if ($validate->fails()) {
			$response = array('success' => false, 'errors' => $validate->getMessageBag()->toArray());
		} else {
			AemHomologacion::updAemHomologacion($inputs);
			$response = array('success' => true, 'message' => '¡El registro fue modificado satisfactoriamente!', 'ctrl' => 'btnEditAemHom', 'idTable' => $inputs["idTable"]);
		}
		return $response;
	}

	/*
	 * 
	 */

	private function setAemInformacion($inputs) {
		$idaeminformacion = 0;
		$rules = array(
			'ubicacion' => 'required',
			'edad' => array('required', 'numeric', 'min:0.00', 'max:99999999.99', 'regex:/^[0-9]{1,8}(\.?)[0-9]{1,2}$/'),
			'telefono' => array('required'),
			'observaciones' => array('required'),
		);
		$messages = array(
			'ubicacion.required' => '¡El campo "Ubicación" es requerido!',
			'edad.required' => '¡El campo "Edad" es requerido!',
			'edad.numeric' => '¡El valor del campo "Edad" debe ser numérico!',
			'edad.min' => '¡El valor mínimo del campo "Edad" debe ser cero!',
			'edad.max' => '¡El valor máximo del campo "Edad" debe ser 99999999.99!',
			'edad.regex' => '¡El formato del campo "Edad" debe ser 99999999.99!',
			'telefono.required' => '¡El campo "Telefóno" es requerido!',
			'observaciones.required' => '¡El campo "Observaciones" es requerido!',
		);
		$validate = Validator::make($inputs, $rules, $messages);
		if ($validate->fails()) {
			$response = array('success' => false, 'errors' => $validate->getMessageBag()->toArray());
		} else {
			if ($inputs['ctrl'] == 'btnNewAemInf') {
				AemInformacion::insAemInformacion($inputs, $idaeminformacion);
				$response = array('success' => true, 'message' => '¡El registro fue ingresado satisfactoriamente!', 'ctrl' => 'btnEditAemInf', 'idTable' => $idaeminformacion);
			} else {
				AemInformacion::updInformacion($inputs);
				$response = array('success' => true, 'message' => '¡El registro fue modificado satisfactoriamente!', 'ctrl' => 'btnEditAemInf', 'idTable' => $inputs["idTable"]);
			}
		}
		return $response;
	}

	/*
	 * 
	 */

	private function setAemAnalisis($inputs) {
		$rules = array(
			'precio_venta' => array('required', 'numeric', 'min:0.00', 'max:9999999999999.99', 'regex:/^[0-9]{1,13}(\.?)[0-9]{1,2}$/'),
			'superficie_terreno' => array('required', 'numeric', 'min:0.00', 'max:9999999999999.99', 'regex:/^[0-9]{1,13}(\.?)[0-9]{1,2}$/'),
			'superficie_construccion' => array('required', 'numeric', 'min:0.00', 'max:9999999999999.99', 'regex:/^[0-9]{1,13}(\.?)[0-9]{1,2}$/'),
			'factor_superficie' => array('required', 'numeric', 'min:0.00', 'max:100.00', 'regex:/^[0-9]{1,3}(\.?)[0-9]{1,2}$/'),
			'factor_edad' => array('required', 'numeric', 'min:0.00', 'max:99999999.99', 'regex:/^[0-9]{1,8}(\.?)[0-9]{1,2}$/'),
			'factor_negociacion' => array('required', 'numeric', 'min:0.00', 'max:100.00', 'regex:/^[0-9]{1,3}(\.?)[0-9]{1,2}$/'),
		);
		$messages = array(
			'precio_venta.required' => '¡El campo "Precio de Venta" es requerido!',
			'precio_venta.numeric' => '¡El valor del campo "Precio de Venta" debe ser numérico!',
			'precio_venta.min' => '¡El valor del campo "Precio de Venta" debe ser cero!',
			'precio_venta.max' => '¡El valor del campo "Precio de Venta" debe ser 9999999999999.99!',
			'precio_venta.regex' => '¡El formato del campo "Precio de Venta" debe ser 9999999999999.99!',
			'superficie_terreno.required' => '¡El campo "Superficie del Terreno" es requerido!',
			'superficie_terreno.numeric' => '¡El valor del campo "Superficie del Terreno" debe ser numérico!',
			'superficie_terreno.min' => '¡El valor del campo "Superficie del Terreno" debe ser cero!',
			'superficie_terreno.max' => '¡El valor del campo "Superficie del Terreno" debe ser 9999999999999.99!',
			'superficie_terreno.regex' => '¡El formato del campo "Superficie del Terreno" debe ser 9999999999999.99!',
			'superficie_construccion.required' => '¡El campo "Superficie de la Construcción" es requerido!',
			'superficie_construccion.numeric' => '¡El valor del campo "Superficie de la Construcción" debe ser numérico!',
			'superficie_construccion.min' => '¡El valor del campo "Superficie de la Construcción" debe ser cero!',
			'superficie_construccion.max' => '¡El valor del campo "Superficie de la Construcción" debe ser 9999999999999.99!',
			'superficie_construccion.regex' => '¡El formato del campo "Superficie de la Construcción" debe ser 9999999999999.99!',
			'factor_superficie.required' => '¡El campo "Factor Superficie" es requerido!',
			'factor_superficie.numeric' => '¡El valor del campo "Factor Superficie" debe ser numérico!',
			'factor_superficie.min' => '¡El valor del campo "Factor Superficie" debe ser cero!',
			'factor_superficie.max' => '¡El valor del campo "Factor Superficie" debe ser 100.00!',
			'factor_superficie.regex' => '¡El formato del campo "Factor Superficie" debe ser 100.00!',
			'factor_edad.required' => '¡El campo "Factor Edad" es requerido!',
			'factor_edad.numeric' => '¡El valor del campo "Factor Edad" debe ser numérico!',
			'factor_edad.min' => '¡El valor del campo "Factor Edad" debe ser cero!',
			'factor_edad.max' => '¡El valor del campo "Factor Edad" debe ser 99999999.99!',
			'factor_edad.regex' => '¡El formato del campo "Factor Edad" debe ser 99999999.99!',
			'factor_negociacion.required' => '¡El campo "Negociación" es requerido!',
			'factor_negociacion.numeric' => '¡El valor del campo "Negociación" debe ser numérico!',
			'factor_negociacion.min' => '¡El valor del campo "Negociación" debe ser cero!',
			'factor_negociacion.max' => '¡El valor del campo "Negociación" debe ser 100.00!',
			'factor_negociacion.regex' => '¡El formato del campo "Negociación" debe ser 100.00!',
		);
		$validate = Validator::make($inputs, $rules, $messages);
		if ($validate->fails()) {
			$response = array('success' => false, 'errors' => $validate->getMessageBag()->toArray());
		} else {
			AemAnalisis::updAemAnalisis($inputs);
			$response = array('success' => true, 'message' => '¡El registro fue modificado satisfactoriamente!', 'ctrl' => 'btnEditAemHom', 'idTable' => $inputs["idTable"]);
		}
		return $response;
	}

	/*
	 * 
	 */

	private function setAefCompConstrucciones($inputs) {
		$response = array('success' => false, 'errors' => array('PENDIENTE'));
		return $response;
	}

	/*
	 * 
	 */

	private function setAefTerrenos($inputs) {
		$idaefterreno = 0;
		$rules = array(
			'fraccion' => 'required',
			'irregular' => array('required', 'numeric', 'min:0.00', 'max:99999999.99', 'regex:/^[0-9]{1,8}(\.?){1}[0-9]{1,2}$/'),
			'indiviso' => array('required', 'numeric', 'min:0.00', 'max:100.00', 'regex:/^[0-9]{1,3}(\.?)[0-9]{1,2}$/'),
		);
		$messages = array(
			'fraccion.required' => '¡El campo "Fracción" es requerido!',
			'irregular.required' => '¡El campo "Irregular" es requerido!',
			'irregular.numeric' => '¡El valor del campo "Irregular" debe ser numérico!',
			'irregular.min' => '¡El valor mínimo del campo "Irregular" debe ser cero!',
			'irregular.max' => '¡El valor máximo del campo "Irregular" debe ser 99999999.99!',
			'irregular.regex' => '¡El formato del campo "Irregular" debe ser 99999999.99!',
			'indiviso.required' => '¡El campo "Indiviso (%)" es requerido!',
			'indiviso.numeric' => '¡El valor del campo "Indiviso (%)" debe ser numérico!',
			'indiviso.min' => '¡El valor mínimo del campo "Indiviso (%)" debe ser cero!',
			'indiviso.max' => '¡El valor máximo del campo "Indiviso (%)" debe ser 100.00!',
			'indiviso.regex' => '¡El formato del campo "Indiviso (%)" debe ser 999.99!',
		);
		$validate = Validator::make($inputs, $rules, $messages);
		if ($validate->fails()) {
			$response = array('success' => false, 'errors' => $validate->getMessageBag()->toArray());
		} else {
			if ($inputs["idTable"] == '0') {
				AefTerrenos::insAefTerrenos($inputs, $idaefterreno);
				$response = array('success' => true, 'message' => '¡El registro fue ingresado satisfactoriamente!', 'ctrl' => 'btnEditAefTerrenos', 'idTable' => $idaefterreno);
			} else {
				AefTerrenos::updAefTerrenos($inputs);
				$response = array('success' => true, 'message' => '¡El registro fue modificado satisfactoriamente!', 'ctrl' => 'btnEditAefTerrenos', 'idTable' => $inputs["idTable"]);
			}
		}
		return $response;
	}

	/*
	 * 
	 */

	private function setAefInstalaciones($inputs) {
		$idaefinstalacion = 0;
		$rules = array(
			'cantidad' => array('required', 'numeric', 'min:0.00', 'max:99999999.99', 'regex:/^[0-9]{1,8}(\.?)[0-9]{1,2}$/'),
			'unidad' => array('required'),
			'valor_nuevo' => array('required', 'numeric', 'min:0.00', 'max:99999999.99', 'regex:/^[0-9]{1,8}(\.?)[0-9]{1,2}$/'),
			'eaf_Instalacion_vida_util' => array('required', 'numeric', 'min:0.00', 'max:99999999.99', 'regex:/^[0-9]{1,8}(\.?)[0-9]{1,2}$/'),
			'edad' => array('required', 'numeric', 'min:0.00', 'max:99999999.99', 'regex:/^[0-9]{1,8}(\.?)[0-9]{1,2}$/'),
			'edad' => array('required', 'numeric', 'min:0.00', 'max:99999999.99', 'regex:/^[0-9]{1,8}(\.?)[0-9]{1,2}$/'),
		);
		$messages = array(
			'cantidad.required' => '¡El campo "Cantidad" es requerido!',
			'cantidad.numeric' => '¡El valor del campo "Cantidad" debe ser numérico!',
			'cantidad.min' => '¡El valor mínimo del campo "Cantidad" debe ser cero!',
			'cantidad.max' => '¡El valor máximo del campo "Cantidad" debe ser 99999999.99!',
			'cantidad.regex' => '¡El formato del campo "Cantidad" debe ser 99999999.99!',
			'unidad.required' => '¡El campo "Unidad" es requerido!',
			'valor_nuevo.required' => '¡El campo "V.R. Nuevo" es requerido!',
			'valor_nuevo.numeric' => '¡El valor del campo "V.R. Nuevo" debe ser numérico!',
			'valor_nuevo.min' => '¡El valor mínimo del campo "V.R. Nuevo" debe ser cero!',
			'valor_nuevo.max' => '¡El valor máximo del campo "V.R. Nuevo" debe ser 99999999.99!',
			'valor_nuevo.regex' => '¡El formato del campo "V.R. Nuevo" debe ser 99999999.99!',
			'eaf_Instalacion_vida_util.required' => '¡El campo "Vida Útil " es requerido!',
			'eaf_Instalacion_vida_util.numeric' => '¡El valor del campo "Vida Útil " debe ser numérico!',
			'eaf_Instalacion_vida_util.min' => '¡El valor mínimo del campo "Vida Útil " debe ser cero!',
			'eaf_Instalacion_vida_util.max' => '¡El valor máximo del campo "Vida Útil " debe ser 99999999.99!',
			'eaf_Instalacion_vida_util.regex' => '¡El formato del campo "Vida Útil " debe ser 99999999.99!',
			'edad.required' => '¡El campo "Edad" es requerido!',
			'edad.numeric' => '¡El valor del campo "Edad" debe ser numérico!',
			'edad.min' => '¡El valor mínimo del campo "Edad" debe ser cero!',
			'edad.max' => '¡El valor máximo del campo "Edad" debe ser 99999999.99!',
			'edad.regex' => '¡El formato del campo "Edad" debe ser 99999999.99!',
			'factor_conservacion.required' => '¡El campo "Factor Conservación" es requerido!',
			'factor_conservacion.numeric' => '¡El valor del campo "Factor Conservación" debe ser numérico!',
			'factor_conservacion.min' => '¡El valor mínimo del campo "Factor Conservación" debe ser cero!',
			'factor_conservacion.max' => '¡El valor máximo del campo "Factor Conservación" debe ser 99999999.99!',
			'factor_conservacion.regex' => '¡El formato del campo "Factor Conservación" debe ser 99999999.99!',
		);
		$validate = Validator::make($inputs, $rules, $messages);
		if ($validate->fails()) {
			$response = array('success' => false, 'errors' => $validate->getMessageBag()->toArray());
		} else {
			if ($inputs["idTable"] == '0') {
				AefInstalaciones::insAefInstalaciones($inputs, $idaefinstalacion);
				$response = array('success' => true, 'message' => '¡El registro fue ingresado satisfactoriamente!', 'ctrl' => 'btnEditAefInstalaciones', 'idTable' => $idaefinstalacion);
			} else {
				AefInstalaciones::updAefInstalaciones($inputs);
				$response = array('success' => true, 'message' => '¡El registro fue modificado satisfactoriamente!', 'ctrl' => 'btnEditAefInstalaciones', 'idTable' => $inputs["idTable"]);
			}
		}
		return $response;
	}

	/*
	 * 
	 */

	private function setAefConstrucciones($inputs) {
		$idaefconstruccion = 0;
		$rules = array(
			'valor_nuevo' => array('required', 'numeric', 'min:0.00', 'max:99999999.99', 'regex:/^[0-9]{1,8}(\.?)[0-9]{1,2}$/'),
		);
		$messages = array(
			'valor_nuevo.required' => '¡El campo "V.R. Nuevo" es requerido!',
			'valor_nuevo.numeric' => '¡El valor del campo "V.R. Nuevo" debe ser numérico!',
			'valor_nuevo.min' => '¡El valor mínimo del campo "V.R. Nuevo" debe ser cero!',
			'valor_nuevo.max' => '¡El valor máximo del campo "V.R. Nuevo" debe ser 99999999.99!',
			'valor_nuevo.regex' => '¡El formato del campo "V.R. Nuevo" debe ser 99999999.99!',
		);
		$validate = Validator::make($inputs, $rules, $messages);
		if ($validate->fails()) {
			$response = array('success' => false, 'errors' => $validate->getMessageBag()->toArray());
		} else {
			if ($inputs["idTable"] == '0') {
				AefConstrucciones::insAefConstrucciones($inputs, $idaefconstruccion);
				$response = array('success' => true, 'message' => '¡El registro fue ingresado satisfactoriamente!', 'ctrl' => 'btnEditAefConstrucciones', 'idTable' => $idaefconstruccion);
			} else {
				AefConstrucciones::updAefConstrucciones($inputs);
				$response = array('success' => true, 'message' => '¡El registro fue modificado satisfactoriamente!', 'ctrl' => 'btnEditAefConstrucciones', 'idTable' => $inputs["idTable"]);
			}
		}
		return $response;
	}

	/*
	 * 
	 */

	private function setAefCondominios($inputs) {
		$idaefcondominio = 0;
		$rules = array(
			'descripcion' => 'required',
			'unidad' => 'required',
			'cantidad' => array('required', 'numeric', 'min:0.00', 'max:99999999.99', 'regex:/^[0-9]{1,8}(\.?)[0-9]{1,2}$/'),
			'valor_nuevo' => array('required', 'numeric', 'min:0.00', 'max:99999999.99', 'regex:/^[0-9]{1,8}(\.?)[0-9]{1,2}$/'),
			'vida_remanente' => array('required', 'numeric', 'min:0.00', 'max:99999999.99', 'regex:/^[0-9]{1,8}(\.?)[0-9]{1,2}$/'),
			'edad' => array('required', 'numeric', 'min:0.00', 'max:99999999.99', 'regex:/^[0-9]{1,8}(\.?)[0-9]{1,2}$/'),
			'factor_conservacion' => array('required', 'numeric', 'min:0.00', 'max:99999999.99', 'regex:/^[0-9]{1,8}(\.?)[0-9]{1,2}$/'),
			'indiviso' => array('required', 'numeric', 'min:0.00', 'max:99999999.99', 'regex:/^[0-9]{1,8}(\.?)[0-9]{1,2}$/'),
		);
		$messages = array(
			'descripcion.required' => '¡El campo "Descripción" es requerido!',
			'unidad.required' => '¡El campo "Unidad" es requerido!',
			'cantidad.required' => '¡El campo "Cantidad" es requerido!',
			'cantidad.numeric' => '¡El valor del campo "Cantidad" debe ser numérico!',
			'cantidad.min' => '¡El valor mínimo del campo "Cantidad" debe ser cero!',
			'cantidad.max' => '¡El valor máximo del campo "Cantidad" debe ser 99999999.99!',
			'cantidad.regex' => '¡El formato del campo "Cantidad" debe ser 99999999.99!',
			'valor_nuevo.required' => '¡El campo "V.R. Nuevo" es requerido!',
			'valor_nuevo.numeric' => '¡El valor del campo "V.R. Nuevo" debe ser numérico!',
			'valor_nuevo.min' => '¡El valor mínimo del campo "V.R. Nuevo" debe ser cero!',
			'valor_nuevo.max' => '¡El valor máximo del campo "V.R. Nuevo" debe ser 99999999.99!',
			'valor_nuevo.regex' => '¡El formato del campo "V.R. Nuevo" debe ser 99999999.99!',
			'vida_remanente.required' => '¡El campo "Vida Remanente" es requerido!',
			'vida_remanente.numeric' => '¡El valor del campo "Vida Remanente" debe ser numérico!',
			'vida_remanente.min' => '¡El valor mínimo del campo "Vida Remanente" debe ser cero!',
			'vida_remanente.max' => '¡El valor máximo del campo "Vida Remanente" debe ser 99999999.99!',
			'vida_remanente.regex' => '¡El formato del campo "Vida Remanente" debe ser 99999999.99!',
			'edad.required' => '¡El campo "Edad" es requerido!',
			'edad.numeric' => '¡El valor del campo "Edad" debe ser numérico!',
			'edad.min' => '¡El valor mínimo del campo "Edad" debe ser cero!',
			'edad.max' => '¡El valor máximo del campo "Edad" debe ser 99999999.99!',
			'edad.regex' => '¡El formato del campo "Edad" debe ser 99999999.99!',
			'factor_conservacion.required' => '¡El campo "Factor Conservación" es requerido!',
			'factor_conservacion.numeric' => '¡El valor del campo "Factor Conservación" debe ser numérico!',
			'factor_conservacion.min' => '¡El valor mínimo del campo "Factor Conservación" debe ser cero!',
			'factor_conservacion.max' => '¡El valor máximo del campo "Factor Conservación" debe ser 99999999.99!',
			'factor_conservacion.regex' => '¡El formato del campo "Factor Conservación" debe ser 99999999.99!',
			'indiviso.required' => '¡El campo "Indiviso (%)" es requerido!',
			'indiviso.numeric' => '¡El valor del campo "Indiviso (%)" debe ser numérico!',
			'indiviso.min' => '¡El valor mínimo del campo "Indiviso (%)" debe ser cero!',
			'indiviso.max' => '¡El valor máximo del campo "Indiviso (%)" debe ser 100.00!',
			'indiviso.regex' => '¡El formato del campo "Indiviso (%)" debe ser 100.00!',
		);
		$validate = Validator::make($inputs, $rules, $messages);
		if ($validate->fails()) {
			$response = array('success' => false, 'errors' => $validate->getMessageBag()->toArray());
		} else {
			if ($inputs["idTable"] == '0') {
				AefCondominios::insAefCondominios($inputs, $idaefcondominio);
				$response = array('success' => true, 'message' => '¡El registro fue ingresado satisfactoriamente!', 'ctrl' => 'btnEditAefCondominios', 'idTable' => $idaefcondominio);
			} else {
				AefCondominios::updAefCondominios($inputs);
				$response = array('success' => true, 'message' => '¡El registro fue modificado satisfactoriamente!', 'ctrl' => 'btnEditAefCondominios', 'idTable' => $inputs["idTable"]);
			}
		}
		return $response;
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getAiMedidasColindancias($id) {
		return AiMedidasColindancias::find($id);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getAemCompTerrenos($id) {
		return AemCompTerrenos::find($id);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getAemHomologacion($id) {
		$row = AemHomologacion::find($id);
		$row->idfactorzona = CatFactoresZonas::getIdByValue($row->zona);
		$row->idfactorubicacion = CatFactoresUbicacion::getIdByValue($row->ubicacion);
		$row->idfactorfrente = CatFactoresFrente::getIdByValue($row->frente);
		$row->idfactorforma = CatFactoresForma::getIdByValue($row->forma);
		$row->cat_factores_zonas = CatFactoresZonas::orderBy('valor_factor_zona')->get();
		$row->cat_factores_ubicacion = CatFactoresUbicacion::orderBy('valor_factor_ubicacion')->get();
		$row->cat_factores_frente = CatFactoresFrente::orderBy('valor_factor_frente')->get();
		$row->cat_factores_forma = CatFactoresForma::orderBy('valor_factor_forma')->get();
		return $row;
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getAemInformacion($id){
		// $row =  AemInformacion::find($id);
		// $row->idfactorzona = CatFactoresZonas::getIdByValue($row->factor_zona);
		return AemInformacion::find($id);

	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getAemAnalisis($id) {
		$row = AemAnalisis::find($id);
		$row->idfactorzona = CatFactoresZonas::getIdByValue($row->factor_zona);
		$row->idfactorubicacion = CatFactoresUbicacion::getIdByValue($row->factor_ubicacion);
		$row->idfactorconservacion = CatFactoresConservacion::getIdByValue($row->factor_conservacion);

		$row->cat_factores_zonas = CatFactoresZonas::orderBy('valor_factor_zona')->get();
		$row->cat_factores_ubicacion = CatFactoresUbicacion::orderBy('valor_factor_ubicacion')->get();
		$row->cat_factores_conservacion = CatFactoresConservacion::orderBy('valor_factor_conservacion')->get();
		return $row;
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getAefTerrenos($id,$idaef) {
		

		if ($id == '0') {
			$row = new AefTerrenos();
			$row->idfactorfrente = 1;
			$row->idfactorforma = 1;
			$row->idfactorconservacion = 1;
			$row->irregular = 0;
			$row->indiviso = 0;
			$row->idfactortop = 0;
			$af = AvaluosFisico::select('idavaluo')->where('idavaluoenfoquefisico', '=', $idaef)->first();
			$ai =AvaluosInmueble::select('superficie_construccion')->where('idavaluo', '=', $af->idavaluo)->first();
			$row->superficie = $ai->superficie_construccion;
		} else {
			$row = AefTerrenos::find($id);
			$row->idfactortop = CatFactoresConservacion::getIdByValue($row->top);
			$row->idfactorfrente = CatFactoresFrente::getIdByValue($row->frente);
			$row->idfactorforma = CatFactoresForma::getIdByValue($row->forma);
			$row->idfactorconservacion = CatFactoresConservacion::getIdByValue($row->otros);
		}
		$row->cat_factores_frente = CatFactoresFrente::orderBy('valor_factor_frente')->get();
		$row->cat_factores_forma = CatFactoresForma::orderBy('valor_factor_forma')->get();
		$row->cat_factores_conservacion = CatFactoresConservacion::orderBy('valor_factor_conservacion')->get();
		$row->cat_factores_top = CatFactoresConservacion::orderBy('valor_factor_conservacion')->get();
		return $row;

	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getAefCompConstrucciones($id) {
		
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getAefConstrucciones($id) {
		if ($id == '0') {
			$row = new AefConstrucciones();
			$row->idtipo = 1;
			$row->idfactorconservacion = 1;
		} else {
			$row = AefConstrucciones::find($id);
			$row->idfactorconservacion = CatFactoresConservacion::getIdByValue($row->factor_conservacion);
		}
		$row->cat_tipo = CatTipo::orderBy('tipo')->get();
		$row->cat_factores_conservacion = CatFactoresConservacion::orderBy('valor_factor_conservacion')->get();
		return $row;
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getAefCondominios($id) {
		if ($id == '0') {
			$row = new AefCondominios();
		} else {
			$row = AefCondominios::find($id);
		}
		return $row;
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getAefInstalaciones($id) {
		if ($id == '0') {
			$row = new AefInstalaciones();
			$row->idobracomplementaria = 1;
		} else {
			$row = AefInstalaciones::find($id);
		}
		$row->cat_obras_complementarias = CatObrasComplementarias::orderBy('obra_complementaria')->get();
		return $row;
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function delAvaluo($id) {
		$message = '¡El Avalúo fue eliminado satisfactoriamente!';
		AvaluosMercado::delAvaluoEnfoqueMercado($id);
		AvaluosFisico::delAvaluosFisico($id);

		$rowInmueble = Avaluos::findOrFail($id)->AvaluosInmueble;
		if (count($rowInmueble) > 0) {
			AiMedidasColindancias::where('idavaluoinmueble', '=', $rowInmueble->idavaluoinmueble)->delete();
		}
		AvaluosInmueble::where('idavaluo', '=', $id)->delete();

		AvaluosConclusiones::where('idavaluo', '=', $id)->delete();
		AvaluosFotos::where('idavaluo', '=', $id)->delete();
		AvaluosZona::where('idavaluo', '=', $id)->delete();

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

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function delAiMedidasColindancias($id) {
		$row = AiMedidasColindancias::findOrFail($id);
		$row->delete($id);
		return Response::json(array('success' => true, 'message' => '!El registro fue eliminado satisfactoriamente!'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function delAvaluoEnfoqueMercado() {
		$inputs = Input::All();
		if ($inputs['ctrlDel'] == 'btnDelAemComp') {
			$response = $this->delAemCompTerrenos($inputs['idTableDel']);
		} else if ($inputs['ctrlDel'] == 'btnDelAemInf') {
			$response = $this->delAemInformacion($inputs['idTableDel']);
		}

		return $response;
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	private function delAemCompTerrenos($id) {
		$response = array('success' => true, 'message' => '!El registro fue eliminado satisfactoriamente!');
		AemHomologacion::where('idaemcompterreno', '=', $id)->delete();
		AemCompTerrenos::where('idaemcompterreno', '=', $id)->delete();
		return $response;
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	private function delAemInformacion($id) {
		// LOCALIZAMOS EL REGISTRO DE AemAnalisis
		$rowAemAnalisis = AemInformacion::find($id)->AemAnalisis;
		// GUARDAMOS LOS VALORES A TILIZAR EN EL TRIGGER
		if (isset($rowAemAnalisis->idavaluoenfoquemercado)) {
			$idavaluoenfoquemercado = $rowAemAnalisis->idavaluoenfoquemercado;
			$in_promedio = $rowAemAnalisis->in_promedio;
			$superficie_construida = $rowAemAnalisis->superficie_construida;
			AemAnalisis::aemAnalisisAfterUpdate($idavaluoenfoquemercado, $in_promedio, $superficie_construida);
			AemAnalisis::where('idaeminformacion', '=', $id)->delete();
		}
		AemInformacion::where('idaeminformacion', '=', $id)->delete();
		return array('success' => true, 'message' => '!El registro fue eliminado satisfactoriamente!');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function delAvaluoEnfoqueFisico() {
		$inputs = Input::All();
		if ($inputs['ctrlDel'] == 'btnDelAefTerreno') {
			$response = $this->delAefTerrenos($inputs['idTableDel']);
		} else if ($inputs['ctrlDel'] == 'btnDelAefInstalaciones') {
			$response = $this->delAefInstalaciones($inputs['idTableDel']);
		} else if ($inputs['ctrlDel'] == 'btnDelAefConstrucciones') {
			$response = $this->delAefConstrucciones($inputs['idTableDel']);
		} else if ($inputs['ctrlDel'] == 'btnDelAefCondominios') {
			$response = $this->delAefCondominios($inputs['idTableDel']);
		} else if ($inputs['ctrlDel'] == 'btnDelAefCompConstrucciones') {
			$response = $this->delAefCompConstrucciones($inputs['idTableDel']);
		}

		return $response;
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function delAefCompConstrucciones($id) {
		$row = AefCompConstrucciones::findOrFail($id);
		$row->delete($id);
		return Response::json(array('success' => true, 'message' => '!El registro fue eliminado satisfactoriamente!'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function delAefCondominios($id) {
		$row = AefCondominios::findOrFail($id);
		if ($row) {
			$idavaluoenfoquefisico = $row->idavaluoenfoquefisico;
			$row->delete($id);

			$Total = AefCondominios::select(DB::raw('sum(valor_parcial) AS nsuma'))->where('idavaluoenfoquefisico', '=', $idavaluoenfoquefisico)->first();

			$rowEnfoqueFisico = AvaluosFisico::find($idavaluoenfoquefisico);
			$rowEnfoqueFisico->subtotal_area_condominio = $Total->nsuma;
			$rowEnfoqueFisico->total_valor_fisico = AvaluosFisico::updBeforeAvaluoEnfoqueFisico($rowEnfoqueFisico);
			$rowEnfoqueFisico->save();
			AvaluosFisico::updAfterAvaluoEnfoqueFisico($rowEnfoqueFisico->idavaluo, $rowEnfoqueFisico->total_valor_fisico);
			return Response::json(array('success' => true, 'message' => '!El registro fue eliminado satisfactoriamente!'));
		} else {
			return Response::json(array('success' => false, 'message' => '!El registro no existe!'));
		}
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function delAefConstrucciones($id) {
		$row = AefConstrucciones::find($id);
		if ($row) {
			$idavaluoenfoquefisico = $row->idavaluoenfoquefisico;
			$row->delete($id);

			//Set @VPC = (Select sum(valor_parcial_construccion) as nsuma from aef_construcciones where idavaluoenfoquefisico = old.idavaluoenfoquefisico);
			$VPC = AefConstrucciones::select(DB::raw('sum(valor_parcial_construccion) AS nsuma'))->where('idavaluoenfoquefisico', '=', $idavaluoenfoquefisico)->first();

			// Set @TMC = (Select sum(superficie_m2) as msuma from aef_construcciones where idavaluoenfoquefisico = old.idavaluoenfoquefisico);
			$TMC = AefConstrucciones::select(DB::raw('sum(superficie_m2) AS msuma'))->where('idavaluoenfoquefisico', '=', $idavaluoenfoquefisico)->first();

			//update avaluo_enfoque_fisico set valor_construccion = @VPC, total_metros_construccion = @TMC where idavaluoenfoquefisico = old.idavaluoenfoquefisico;
			$rowEnfoqueFisico = AvaluosFisico::find($idavaluoenfoquefisico);
			$rowEnfoqueFisico->valor_construccion = $VPC->nsuma;
			$rowEnfoqueFisico->total_metros_construccion = $TMC->msuma;
			$rowEnfoqueFisico->total_valor_fisico = AvaluosFisico::updBeforeAvaluoEnfoqueFisico($rowEnfoqueFisico);
			$rowEnfoqueFisico->save();
			AvaluosFisico::updAfterAvaluoEnfoqueFisico($rowEnfoqueFisico->idavaluo, $rowEnfoqueFisico->total_valor_fisico);
			return Response::json(array('success' => true, 'message' => '!El registro fue eliminado satisfactoriamente!'));
		} else {
			return Response::json(array('success' => false, 'message' => '!El registro no existe!'));
		}
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function delAefInstalaciones($id) {
		$row = AefInstalaciones::findOrFail($id);
		if ($row) {
			$idavaluoenfoquefisico = $row->idavaluoenfoquefisico;
			$row->delete($id);
			$Total = AefInstalaciones::select(DB::raw('sum(valor_parcial) AS nsuma'))->where('idavaluoenfoquefisico', '=', $idavaluoenfoquefisico)->first();
			$rowEnfoqueFisico = AvaluosFisico::find($idavaluoenfoquefisico);
			$rowEnfoqueFisico->valor_construccion = $Total->nsuma;
			$rowEnfoqueFisico->total_valor_fisico = AvaluosFisico::updBeforeAvaluoEnfoqueFisico($rowEnfoqueFisico);
			$rowEnfoqueFisico->save();
			AvaluosFisico::updAfterAvaluoEnfoqueFisico($rowEnfoqueFisico->idavaluo, $rowEnfoqueFisico->total_valor_fisico);
			return Response::json(array('success' => true, 'message' => '!El registro fue eliminado satisfactoriamente!'));
		} else {
			return Response::json(array('success' => false, 'message' => '!El registro no existe!'));
		}
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function delAefTerrenos($id) {
		$row = AefTerrenos::find($id);
		if ($row) {
			$idavaluoenfoquefisico = $row->idavaluoenfoquefisico;
			$row->delete($id);
			$Val = AefTerrenos::select(DB::raw('sum(valor_parcial) AS valorpar'))->where('idavaluoenfoquefisico', '=', $idavaluoenfoquefisico)->first();
			$rowEnfoqueFisico = AvaluosFisico::find($idavaluoenfoquefisico);
			$rowEnfoqueFisico->valor_terreno = $Val->valorpar;
			$rowEnfoqueFisico->total_valor_fisico = AvaluosFisico::updBeforeAvaluoEnfoqueFisico($rowEnfoqueFisico);
			$rowEnfoqueFisico->save();
			AvaluosFisico::updAfterAvaluoEnfoqueFisico($rowEnfoqueFisico->idavaluo, $rowEnfoqueFisico->total_valor_fisico);
			return Response::json(array('success' => true, 'message' => '!El registro fue eliminado satisfactoriamente!'));
		} else {
			return Response::json(array('success' => false, 'message' => '!El registro no existe!'));
		}
	}


}
