<?php

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
		$row['fecha_reporte'] = date("d-m-Y");
		$row['fecha_avaluo'] = date("d-m-Y");
		$row['lon0'] = $row['lon1'] = $row['lat0'] = $row['lat1'] = 0;
		
		// $estados = Estados::comboList();
		// $municipios = Municipios::comboList();

		$estados = Estados::orderBy('estado')->where('idestado', 1)->where('status', 1)->lists('estado', 'idestado');
		$municipios = Municipios::orderBy('municipio')->where('idestado', 1)->where('status', 1)->lists('municipio', 'clave','idmunicipio');

		$cat_tipo_inmueble = CatTipoInmueble::comboList();
		$cat_regimen_propiedad = CatRegimenPropiedad::comboList();
		$idavaluo = 0;

//		$lstCP = Asentamiento::where('municipio','000')->distinct()->lists('codigo_postal', 'codigo_postal');
		$lstCP =  array('0' => '0',);
		return View::make('Corevat.Avaluos.create', compact('title', 'row', 'estados', 'municipios', 'cat_tipo_inmueble', 'cat_regimen_propiedad', 'idavaluo','lstCP'));
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
			'fecha_avaluo' => 'required|date_format:"d-m-Y"',
			'foliocoretemp' => 'required',
			'proposito' => 'required',
			'finalidad' => 'required',
			'lon0' => 'integer|min:0|max:360',
			'lon1' => 'integer|min:0|max:60',
			'lon2' => 'integer|min:0|max:60',
			'lat0' => 'integer|min:0|max:360',
			'lat1' => 'integer|min:0|max:60',
			'lat2' => 'integer|min:0|max:60',
		);
		$messages = array(
			'fecha_reporte.required' => '¡El campo "Fecha del reporte" es requerido!',
			'fecha_reporte.date_format' => '¡El formato del campo "Fecha del reporte" es: dd-mm-aaaa!',
			'fecha_avaluo.required' => '¡El campo "Fecha del avalúo" es requerido!',
			'fecha_avaluo.date_format' => '¡El formato del campo "Fecha del avalúo" es: dd-mm-aaaa!',
			'proposito.required' => 'El campo "Propósito" es requerido!',
			'finalidad.required' => 'El campo "Finalidad" es requerido!',
			'lon0.integer' => 'El valor correspondiente a los grados de la longitud debe ser un número entero positivo!',
			'lon0.min' => 'El valor mínimo correspondiente a los grados de la longitud debe ser cero!',
			'lon0.max' => 'El valor máximo correspondiente a los grados de la longitud debe ser 360!',
			'lon1.integer' => 'El valor correspondiente a los minutos de la longitud debe ser un número entero positivo!',
			'lon1.min' => 'El valor mínimo correspondiente a los minutos de la longitud debe ser cero!',
			'lon1.max' => 'El valor máximo correspondiente a los minutos de la longitud debe ser 60!',
			'lon2.integer' => 'El valor correspondiente a los segundos de la longitud debe ser un número entero positivo!',
			'lon2.min' => 'El valor mínimo correspondiente a los segundos de la longitud debe ser cero!',
			'lon2.max' => 'El valor máximo correspondiente a los segundos de la longitud debe ser 60!',
			'lat0.integer' => 'El valor correspondiente a los grados de la latitud debe ser un número entero positivo!',
			'lat0.min' => 'El valor mínimo correspondiente a los grados de la latitud debe ser cero!',
			'lat0.max' => 'El valor mínimo correspondiente a los grados de la latitud debe ser 360!',
			'lat1.integer' => 'El valor correspondiente a los minutos de la latitud debe ser un número entero positivo!',
			'lat1.min' => 'El valor mínimo correspondiente a los minutos de la latitud debe ser cero!',
			'lat1.max' => 'El valor máximo correspondiente a los minutos de la latitud debe ser 60!',
			'lat2.integer' => 'El valor correspondiente a los minutos de la latitud debe ser un número entero positivo!',
			'lat2.min' => 'El valor mínimo correspondiente a los segundos de la latitud debe ser cero!',
			'lat2.max' => 'El valor máximo correspondiente a los segundos de la latitud debe ser 60!',
		);
		$validate = Validator::make($inputs, $rules, $messages);
		if ($validate->fails()) {
			return Redirect::back()->withInput()->withErrors($validate);
		} else {
			Avaluos::insAvaluo($inputs);
			return Redirect::to('corevat/Avaluos/create')->with('success', '¡El Avalúo fue creado satisfactoriamente!');
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
		$lstCP = Asentamiento::where('municipio',$mun->clave)->distinct()->lists('codigo_postal', 'codigo_postal');

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
		$rules = array(
			'fecha_reporte' => 'required|date_format:"d-m-Y"',
			'fecha_avaluo' => 'required|date_format:"d-m-Y"',
			'foliocoretemp' => 'required',
			'proposito' => 'required',
			'finalidad' => 'required',
			'lon0' => 'integer|min:0|max:360',
			'lon1' => 'integer|min:0|max:60',
			'lon2' => 'integer|min:0|max:60',
			'lat0' => 'integer|min:0|max:360',
			'lat1' => 'integer|min:0|max:60',
			'lat2' => 'integer|min:0|max:60',
		);
		$messages = array(
			'fecha_reporte.required' => '¡El campo "Fecha del reporte" es requerido!',
			'fecha_reporte.date_format' => '¡El formato del campo "Fecha del reporte" es: dd-mm-aaaa!',
			'fecha_avaluo.required' => '¡El campo "Fecha del avalúo" es requerido!',
			'fecha_avaluo.date_format' => '¡El formato del campo "Fecha del avalúo" es: dd-mm-aaaa!',
			'proposito.required' => 'El campo "Propósito" es requerido!',
			'finalidad.required' => 'El campo "Finalidad" es requerido!',
			'lon0.integer' => 'El valor correspondiente a los grados de la longitud debe ser un número entero positivo!',
			'lon0.min' => 'El valor mínimo correspondiente a los grados de la longitud debe ser cero!',
			'lon0.max' => 'El valor máximo correspondiente a los grados de la longitud debe ser 360!',
			'lon1.integer' => 'El valor correspondiente a los minutos de la longitud debe ser un número entero positivo!',
			'lon1.min' => 'El valor mínimo correspondiente a los minutos de la longitud debe ser cero!',
			'lon1.max' => 'El valor máximo correspondiente a los minutos de la longitud debe ser 60!',
			'lon2.integer' => 'El valor correspondiente a los segundos de la longitud debe ser un número entero positivo!',
			'lon2.min' => 'El valor mínimo correspondiente a los segundos de la longitud debe ser cero!',
			'lon2.max' => 'El valor máximo correspondiente a los segundos de la longitud debe ser 60!',
			'lat0.integer' => 'El valor correspondiente a los grados de la latitud debe ser un número entero positivo!',
			'lat0.min' => 'El valor mínimo correspondiente a los grados de la latitud debe ser cero!',
			'lat0.max' => 'El valor mínimo correspondiente a los grados de la latitud debe ser 360!',
			'lat1.integer' => 'El valor correspondiente a los minutos de la latitud debe ser un número entero positivo!',
			'lat1.min' => 'El valor mínimo correspondiente a los minutos de la latitud debe ser cero!',
			'lat1.max' => 'El valor máximo correspondiente a los minutos de la latitud debe ser 60!',
			'lat2.integer' => 'El valor correspondiente a los minutos de la latitud debe ser un número entero positivo!',
			'lat2.min' => 'El valor mínimo correspondiente a los segundos de la latitud debe ser cero!',
			'lat2.max' => 'El valor máximo correspondiente a los segundos de la latitud debe ser 60!',
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
		$ai_medidas_colindancias = AiMedidasColindancias::AiMedidasColindanciasByFk($row->idavaluoinmueble);

    	$arrMedCol = array('Metros'=>'Metros','Metros Cuadrados'=>'Metros Cuadrados','Metros Cúbicos'=>'Metros Cúbicos','Metros Lineales'=>'Metros Lineales','Kilometros'=>'Kilometros','Kilometros Cuadrados'=>'Kilometros Cuadrados','Hectareas'=>'Hectareas','Hectareas Cuadradas'=>'Hectareas Cuadradas');

		return View::make('Corevat.Avaluos.avaluos', compact('opt', 'idavaluo', 'title', 'row', 'cat_cimentaciones', 'cat_estructuras', 'cat_muros', 'cat_entrepisos', 'cat_techos', 'cat_bardas', 'cat_usos_suelos', 'cat_niveles', 'cat_pisos', 'cat_aplanados', 'cat_plafones', 'cat_orientaciones', 'ai_medidas_colindancias', 'arrMedCol'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function updateInmueble($id) {
		$inputs = Input::All();
			// 'indiviso_accesoria' => 'numeric|min:0|max:999999999.9999|regex:/^[0-9]{1,9}(\.?)[0-9]{1,4}$/',
	
		$rules = array(
			'unidades_rentables_escritura' => 'integer|min:0|max:9999',
			'superficie_total_terreno' => 'numeric|min:0|max:999999999.9999|regex:/^[0-9]{1,9}(\.?)[0-9]{1,4}$/',
			'indiviso_terreno' => 'numeric|min:0|max:999999999.9999|regex:/^[0-9]{1,9}(\.?)[0-9]{1,4}$/',
			'superficie_terreno' => 'numeric|min:0|max:999999999.9999|regex:/^[0-9]{1,9}(\.?)[0-9]{1,4}$/',
			'indiviso_areas_comunes' => 'numeric|min:0|max:999999999.9999|regex:/^[0-9]{1,9}(\.?)[0-9]{1,4}$/',
			'superficie_construccion' => 'numeric|min:0|max:999999999.9999|regex:/^[0-9]{1,9}(\.?)[0-9]{1,4}$/',
			'superficie_escritura' => 'numeric|min:0|max:999999999.9999|regex:/^[0-9]{1,9}(\.?)[0-9]{1,4}$/',
			'superficie_vendible' => 'numeric|min:0|max:999999999.9999|regex:/^[0-9]{1,9}(\.?)[0-9]{1,4}$/',
		);
		$messages = array(
			'unidades_rentables_escritura.integer' => '¡El campo "Unidades Rentables en la misma Estructura" debe ser un entero positivo!',
			'unidades_rentables_escritura.min' => '¡El valor mínimo del campo "Unidades Rentables en la misma Estructura" debe ser cero!',
			'unidades_rentables_escritura.max' => '¡El valor máximo del campo "Unidades Rentables en la misma Estructura" debe ser 9999!',
			'superficie_total_terreno.numeric' => '¡El campo "Superficie Total del Terreno" debe ser un número!',
			'superficie_total_terreno.min' => '¡El valor mínimo del campo "Superficie Total del Terreno" debe ser cero!',
			'superficie_total_terreno.max' => '¡El valor máximo del campo "Superficie Total del Terreno" debe ser 999999999.999!',
			'superficie_total_terreno.regex' => '¡El formato del campo "Superficie Total del Terreno" debe ser 999999999.999!',
			'indiviso_terreno.numeric' => '¡El campo "Indiviso del Terreno (%)" debe ser un número!',
			'indiviso_terreno.min' => '¡El valor mínimo del campo "Indiviso del Terreno (%)" debe ser cero!',
			'indiviso_terreno.max' => '¡El valor máximo del campo "Indiviso del Terreno (%)" debe ser 999999999.999!',
			'indiviso_terreno.regex' => '¡El formato del campo "Indiviso del Terreno (%)" debe ser 999999999.999!',
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
					$row->croquis = 'croquis-' . $row->idavaluo . '.jpg';
					Input::file('croquis')->move(public_path() . '/corevat/files/', $row->croquis);
					$message .= '<br />¡El croquis fue actualizado satisfactoriamente!';
				}
				if (Input::hasFile('fachada')) {
					$row->fachada = 'fachada-' . $row->idavaluo . '.jpg';
					Input::file('fachada')->move(public_path() . '/corevat/files/', $row->fachada);
					$message .= '<br />¡La imagen de la fachada fue actualizada satisfactoriamente!';
				}
				$row->save();
			}
			return Redirect::to('/corevat/AvaluoInmueble/' . $id)->with('success', $message);
		}
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

		return View::make('Corevat.Avaluos.avaluos', compact('opt', 'idavaluo', 'title', 'row'));
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
			$row->foto0 = 'foto0-' . $row->idavaluo . '.jpg';
			Input::file('foto0')->move(public_path() . '/corevat/files/', $row->foto0);
		}
		if (Input::hasFile('foto1')) {
			$row->foto1 = 'foto1-' . $row->idavaluo . '.jpg';
			Input::file('foto1')->move(public_path() . '/corevat/files/', $row->foto1);
		}
		if (Input::hasFile('foto2')) {
			$row->foto2 = 'foto2-' . $row->idavaluo . '.jpg';
			Input::file('foto2')->move(public_path() . '/corevat/files/', $row->foto2);
		}
		if (Input::hasFile('foto3')) {
			$row->foto3 = 'foto3-' . $row->idavaluo . '.jpg';
			Input::file('foto3')->move(public_path() . '/corevat/files/', $row->foto3);
		}
		if (Input::hasFile('foto4')) {
			$row->foto4 = 'foto4-' . $row->idavaluo . '.jpg';
			Input::file('foto4')->move(public_path() . '/corevat/files/', $row->foto4);
		}
		if (Input::hasFile('foto5')) {
			$row->foto5 = 'foto5-' . $row->idavaluo . '.jpg';
			Input::file('foto5')->move(public_path() . '/corevat/files/', $row->foto5);
		}
		if (Input::hasFile('plano0')) {
			$row->plano0 = 'plano0-' . $row->idavaluo . '.jpg';
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
			'medidas' => 'required',
			'unidad_medida' => 'required',
			'colindancia' => 'required',
		);
		$messages = array(
			'medidas.required' => '¡El campo "Medidas" es requerido!',
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

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function printAvaluosByValuador($id) {
		
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 * 
	 */
	public function printAvaluo($id) {
		require 'NumberToLetterConverter.php';
		$nFont = 6;

		$rs = Avaluos::getAvaluo($id);
		$pdf = new Fpdf('P', 'mm', 'Letter');
		$pdf->AliasNbPages();
		$pdf->SetFillColor(64, 64, 64);

		$pdf->AddPage();
		$pdf->Image(public_path() . "/css/images/corevat/crv-01.jpg", 5, 5, 139.57, 26.20);

		if ( $rs->foto != "" ) {
			$userfoto = explode(".", $rs->foto);
			$foto = public_path() . '/corevat/files/' . $userfoto[0] . '-big.' . $userfoto[1];
			if ( !file_exists($foto) ) {
				$foto = public_path() . "/css/images/corevat/user-big.jpg";
			}
		} else {
			$foto = public_path() . "/css/images/corevat/user-big.jpg";
		}
		$pdf->Image($foto, 180, 5, 30.50, 26.56);
		$pdf->Ln(25);

		$pdf->setX(5);

		//*********************************************************
		//ENCABEZADO
		//*********************************************************
		$pdf->SetTextColor(0, 0, 0);
		$pdf->SetFont('Arial', '', 14);
		$pdf->Cell(57, $nFont, utf8_decode("H. AYUNTAMIENTO DE: "), '', 0, 'L');
		$pdf->SetFont('Arial', 'B', 14);
		$pdf->Cell(70, $nFont, utf8_decode(strtoupper($rs->municipio)), '', 1, 'L');
		$pdf->setX(5);
		$pdf->SetFont('Arial', '', 14);
		$pdf->Cell(57, $nFont, utf8_decode("DIRECCION DE FINANZAS"), '', 1, 'L');
		$pdf->SetFont('Arial', 'B', 14);
		$pdf->Ln(2.5);
		$pdf->setX(5);
		$pdf->Cell(206, 8, utf8_decode('A V A L Ú O'), 'TLBR', 1, 'C', 0);

		//*********************************************************
		//DATOS DEL VALUADOR
		//*********************************************************
		$pdf->Ln(10);

		$pdf->SetFont('Arial', 'B', 12);
		$pdf->SetFillColor(164, 164, 164);
		$pdf->Ln(2);
		$pdf->setX(5);
		$pdf->Cell(206, $nFont, 'DATOS DEL VALUADOR', 'TLBR', 1, 'C', 1);

		// Línea 1
		$pdf->setX(5);
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(40, $nFont, utf8_decode("Fecha del Avalúo: "), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(40, $nFont, $rs->fecha_avaluo, 'LB', 0, 'L');
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(86, $nFont, utf8_decode("Avalúo Número: "), 'B', 0, 'R');
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(40, $nFont, $rs->foliocoretemp, 'LBR', 1, 'L'); // folio_format
		// Línea 2
		$pdf->setX(5);
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(40, $nFont, utf8_decode("Nombre del Valuador: "), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(40, $nFont, utf8_decode($rs->apellidos) . ' ' . utf8_decode($rs->nombres), 'LB', 0, 'L');
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(86, $nFont, utf8_decode("Cédula Profesional del Valuador: "), 'B', 0, 'R');
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(40, $nFont, $rs->cedulaprofesional, 'LBR', 1, 'L');
		// Línea 3
		$pdf->setX(5);
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(40, $nFont, utf8_decode("Rgistro Estatal: "), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(40, $nFont, $rs->registro, 'LB', 0, 'L');
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(86, $nFont, utf8_decode("Registro Colegio: "), 'B', 0, 'R');
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(40, $nFont, $rs->registro_colegio, 'LBR', 1, 'L');

		// /* *********************************************************
		// ** INFORMACION GENERAL DEL INMUEBLE
		// ** ********************************************************* */
		$pdf->Ln(10);

		$pdf->SetFont('Arial', 'B', 12);
		$pdf->SetFillColor(164, 164, 164);
		$pdf->Ln(2);
		$pdf->setX(5);
		$pdf->Cell(206, $nFont, 'INFORMACION GENERAL DEL INMUEBLE', 'TLBR', 1, 'C', 1);

		// Línea 1
		$pdf->setX(5);
		$pdf->SetFont('Arial', 'B', 6);
		$pdf->Cell(26, $nFont, utf8_decode("Propósito: "), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 6);
		$pdf->Cell(63, $nFont, utf8_decode($rs->proposito), 'LB', 0, 'L');
		$pdf->SetFont('Arial', 'B', 6);
		$pdf->Cell(15, $nFont, utf8_decode("Finalidad: "), 'B', 0, 'L');
		$pdf->SetFont('Arial', '', 6);
		$pdf->Cell(102, $nFont, utf8_decode($rs->finalidad), 'LBR', 1, 'L');

		// Línea 2
		$pdf->setX(5);
		$pdf->SetFont('Arial', 'B', 6);
		$pdf->Cell(26, $nFont, utf8_decode("Tipo de Inmueble: "), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 6);
		$pdf->Cell(36, $nFont, utf8_decode($rs->tipo_inmueble), 'LB', 0, 'L');
		$pdf->SetFont('Arial', 'B', 6);
		$pdf->Cell(15, $nFont, utf8_decode("Ubicación: "), 'B', 0, 'R');
		$pdf->SetFont('Arial', '', 6);
		$pdf->Cell(129, $nFont, utf8_decode($rs->ubicacion), 'LBR', 1, 'L');

		// Línea 3
		$pdf->setX(5);
		$pdf->SetFont('Arial', 'B', 6);
		$pdf->Cell(26, $nFont, utf8_decode("Nombre del Conjunto: "), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 6);
		$pdf->Cell(26, $nFont, utf8_decode($rs->conjunto), 'LB', 0, 'L');
		$pdf->SetFont('Arial', 'B', 6);
		$pdf->Cell(15, $nFont, utf8_decode("Colonia: "), 'B', 0, 'R');
		$pdf->SetFont('Arial', '', 6);
		$pdf->Cell(114, $nFont, utf8_decode($rs->colonia), 'LBR', 0, 'L');
		$pdf->SetFont('Arial', 'B', 6);
		$pdf->Cell(10, $nFont, utf8_decode("CP: "), 'B', 0, 'R');
		$pdf->SetFont('Arial', '', 6);
		$pdf->Cell(15, $nFont, utf8_decode($rs->cp), 'LBR', 1, 'L');

		// Línea 4
		$pdf->setX(5);
		$pdf->SetFont('Arial', 'B', 6);
		$pdf->Cell(26, $nFont, utf8_decode("Municipio: "), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 6);
		$pdf->Cell(83, $nFont, utf8_decode($rs->municipio), 'LB', 0, 'L');
		$pdf->SetFont('Arial', 'B', 6);
		$pdf->Cell(26, $nFont, utf8_decode("Entidad Federativo: "), 'B', 0, 'R');
		$pdf->SetFont('Arial', '', 6);
		$pdf->Cell(71, $nFont, utf8_decode($rs->estado), 'LBR', 1, 'L');

		// Línea 4
		$pdf->setX(5);
		$pdf->SetFont('Arial', 'B', 6);
		$pdf->Cell(26, $nFont, utf8_decode("Coordenads Geo: "), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 6);
		$pdf->Cell(6, $nFont, '', 'LB', 0, 'L');
		$pdf->SetFont('Arial', 'B', 6);
		$pdf->Cell(31.666666667, $nFont, utf8_decode("Longitud: "), 'B', 0, 'R');
		$pdf->SetFont('Arial', '', 6);
		$pdf->Cell(26.666666667, $nFont, utf8_decode($rs->longitud), 'LBR', 0, 'L');
		$pdf->SetFont('Arial', 'B', 6);
		$pdf->Cell(31.666666667, $nFont, utf8_decode("Latitud: "), 'B', 0, 'R');
		$pdf->SetFont('Arial', '', 6);
		$pdf->Cell(26.666666667, $nFont, utf8_decode($rs->latitud), 'LBR', 0, 'L');
		$pdf->SetFont('Arial', 'B', 6);
		$pdf->Cell(30.666666667, $nFont, utf8_decode("Altitud: "), 'B', 0, 'R');
		$pdf->SetFont('Arial', '', 6);
		$pdf->Cell(26.666666667, $nFont, utf8_decode($rs->altitud), 'LBR', 1, 'L');

		// Línea 5
		$pdf->setX(5);
		$pdf->SetFont('Arial', 'B', 6);
		$pdf->Cell(26, $nFont, utf8_decode("Regimen de Propiedad: "), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 6);
		$pdf->Cell(74, $nFont, utf8_decode($rs->regimen_propiedad), 'LB', 0, 'L');
		$pdf->SetFont('Arial', 'B', 6);
		$pdf->Cell(26, $nFont, utf8_decode("Cuenta Predial: "), 'B', 0, 'R');
		$pdf->SetFont('Arial', '', 6);
		$pdf->Cell(20, $nFont, utf8_decode($rs->cuenta_predial), 'LBR', 0, 'L');
		$pdf->SetFont('Arial', 'B', 6);
		$pdf->Cell(33.3, $nFont, utf8_decode("Cuenta Catastral: "), 'B', 0, 'R');
		$pdf->SetFont('Arial', '', 6);
		$pdf->Cell(26.7, $nFont, utf8_decode($rs->cuenta_catastral), 'LBR', 1, 'L');

		// Línea 6
		$pdf->setX(5);
		$pdf->SetFont('Arial', 'B', 6);
		$pdf->Cell(26, $nFont, utf8_decode("Nombre del Solicitante: "), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 6);
		$pdf->Cell(53, $nFont, utf8_decode($rs->nombre_solicitante), 'LB', 0, 'L');
		$pdf->SetFont('Arial', 'B', 6);
		$pdf->Cell(20, $nFont, utf8_decode("Propietario: "), 'B', 0, 'R');
		$pdf->SetFont('Arial', '', 6);
		$pdf->Cell(107, $nFont, utf8_decode($rs->nombre_propietario), 'LBR', 1, 'L');

		// /* *********************************************************
		// ** 3. CARACTERÍSTICAS  DE LA ZON7
		// ** ********************************************************* */
		$pdf->Ln(10);

		$zn = AvaluosZona::getAvaluosZonaByFk($id);

		$pdf->SetFont('Arial', 'B', 12);
		$pdf->SetFillColor(164, 164, 164);
		$pdf->Ln(2);
		$pdf->setX(5);
		$pdf->Cell(206, $nFont, utf8_decode('CARACTERÍSTICAS  DE LA ZONA'), 'TLBR', 1, 'C', 1);

		// Línea 1
		$pdf->setX(5);
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(40, $nFont * 2, utf8_decode("Servicios municipales: "), 'LBR', 0, 'R');
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(30, $nFont, utf8_decode("Agua Potable: "), 'B', 0, 'R');
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(3.2, $nFont, $zn->is_agua_potable == 1 ? 'X' : '', 'LBR', 0, 'L');
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(30, $nFont, utf8_decode("Drenaje: "), 'B', 0, 'R');
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(3.2, $nFont, $zn->is_drenaje == 1 ? 'X' : '', 'LBR', 0, 'L');
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(30, $nFont, utf8_decode("Electrificación: "), 'B', 0, 'R');
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(3.2, $nFont, $zn->is_electricidad == 1 ? 'X' : '', 'LBR', 0, 'L');
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(30, $nFont, utf8_decode("Pavimientación: "), 'B', 0, 'R');
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(3.2, $nFont, $zn->is_pavimentacion == 1 ? 'X' : '', 'LBR', 0, 'L');
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(30, $nFont, utf8_decode("Alumbrado Público: "), 'B', 0, 'R');
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(3.2, $nFont, $zn->is_alumbrado_publico == 1 ? 'X' : '', 'LBR', 1, 'L');

		// Línea 2
		$pdf->setX(45);
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(30, $nFont, utf8_decode("Guarniciones: "), 'B', 0, 'R');
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(3.2, $nFont, $zn->is_guarniciones == 1 ? 'X' : '', 'LBR', 0, 'L');
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(30, $nFont, utf8_decode("Banqueta: "), 'B', 0, 'R');
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(3.2, $nFont, $zn->is_banqueta == 1 ? 'X' : '', 'LBR', 0, 'L');
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(30, $nFont, utf8_decode("Teléfono: "), 'B', 0, 'R');
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(3.2, $nFont, $zn->is_telefono == 1 ? 'X' : '', 'LBR', 0, 'L');
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(30, $nFont, utf8_decode("Transporte Urbano: "), 'B', 0, 'R');
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(3.2, $nFont, $zn->is_transporte_publico == 1 ? 'X' : '', 'LBR', 0, 'L');
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(30, $nFont, utf8_decode("Otros: "), 'B', 0, 'R');
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(3.2, $nFont, $zn->is_otro_servicio == 1 ? 'X' : '', 'LBR', 1, 'L');

		// Línea 3
		$pdf->setX(5);
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(40, $nFont * 3, utf8_decode("Equipamiento urbano: "), 'LBR', 0, 'R');

		$pdf->setX(45);
		$pdf->SetFont('Arial', '', 6);
		$pdf->Cell(166, $nFont, utf8_decode($zn->cobertura), 'BR', 1, 'L');

		$pdf->setX(45);
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(30, $nFont, utf8_decode("Escuela: "), 'B', 0, 'R');
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(3.2, $nFont, $zn->is_escuela == 1 ? 'X' : '', 'LBR', 0, 'L');
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(30, $nFont, utf8_decode("Banco: "), 'B', 0, 'R');
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(3.2, $nFont, $zn->is_banco == 1 ? 'X' : '', 'LBR', 0, 'L');
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(30, $nFont, utf8_decode("Hospital: "), 'B', 0, 'R');
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(3.2, $nFont, $zn->is_hospital == 1 ? 'X' : '', 'LBR', 0, 'L');
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(30, $nFont, utf8_decode("Transporte: "), 'B', 0, 'R');
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(3.2, $nFont, $zn->is_transporte == 1 ? 'X' : '', 'LBR', 0, 'L');
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(30, $nFont, utf8_decode("Mercado: "), 'B', 0, 'R');
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(3.2, $nFont, $zn->is_mercado == 1 ? 'X' : '', 'LBR', 1, 'L');

		$pdf->setX(45);
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(30, $nFont, utf8_decode("Iglesia: "), 'B', 0, 'R');
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(3.2, $nFont, $zn->is_iglesia == 1 ? 'X' : '', 'LBR', 0, 'L');
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(30, $nFont, utf8_decode("Comercio: "), 'B', 0, 'R');
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(3.2, $nFont, $zn->is_comercio == 1 ? 'X' : '', 'LBR', 0, 'L');
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(30, $nFont, utf8_decode("Parques: "), 'B', 0, 'R');
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(3.2, $nFont, $zn->is_parque == 1 ? 'X' : '', 'LBR', 0, 'L');
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(30, $nFont, utf8_decode("Gasolinera: "), 'B', 0, 'R');
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(3.2, $nFont, $zn->is_gasolinera == 1 ? 'X' : '', 'LBR', 0, 'L');
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(30, $nFont, utf8_decode("Otros: "), 'B', 0, 'R');
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(3.2, $nFont, $zn->is_otro_equipamiento = 1 ? 'X' : '', 'LBR', 1, 'L');

		// Línea 4
		$pdf->setX(5);
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(40, $nFont, utf8_decode("Nivel de Equiamiento: "), 'LBR', 0, 'R');

		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(10, $nFont, utf8_decode($zn->nivel_equipamiento) . '%', 'BR', 0, 'R');
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(40, $nFont, utf8_decode("Clasificacion de la Zona: "), 'B', 0, 'R');
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(49.6, $nFont, $zn->clasificacion_zona, 'LBR', 0, 'L');
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(50, $nFont, utf8_decode("Referencia proximidad urbana: "), 'B', 0, 'R');
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(16.4, $nFont, $zn->proximidad_urbana, 'LBR', 1, 'L');

		// Línea 4
		$pdf->setX(5);
		$xL = $pdf->GetX();
		$yL = $pdf->GetY();
		$pdf->Rect($xL, $yL, 40, $nFont * 3, false);

		$pdf->SetFont('Arial', 'B', 8);
		$pdf->MultiCell(40, 3.60, utf8_decode("\nConstrucciones Predominantes:"), '', 'R');

		$pdf->setY($yL);
		$pdf->Rect(45, $yL, 166, $nFont * 3, false);

		$pdf->setX(45);
		$pdf->SetFont('Arial', '', 7);
		$pdf->MultiCell(166, 3.60, utf8_decode($zn->construc_predominante), '', 'L');

		$pdf->setX(5);
		$pdf->setY($yL + $nFont * 3);

		// Línea 4
		$pdf->setX(5);
		$xL = $pdf->GetX();
		$yL = $pdf->GetY();
		$pdf->Rect($xL, $yL, 40, $nFont * 3, false);

		$pdf->SetFont('Arial', 'B', 8);
		$pdf->MultiCell(40, 3.60, utf8_decode("\nVías de acceso e importancia:"), '', 'R');

		$pdf->setY($yL);
		$pdf->Rect(45, $yL, 166, $nFont * 3, false);

		$pdf->setX(45);
		$pdf->SetFont('Arial', '', 7);
		$pdf->MultiCell(166, 3.60, utf8_decode($zn->vias_acceso_importante), '', 'L');

		$pdf->setX(5);

		// /* *********************************************************
		// ** 4. CARACTERISTICAS DEL INMUEBLE
		// ** ********************************************************* */
		$in = AvaluosInmueble::getAvaluoInmuebleByIdForPdf($id);
		$pdf->AddPage();

		$pdf->SetFont('Arial', 'B', 12);
		$pdf->SetFillColor(164, 164, 164);
		$pdf->setX(5);
		$pdf->Cell(206, $nFont, utf8_decode('CARACTERISTÍCAS DEL INMUEBLE (1 de 2)'), 'TLBR', 1, 'C', 1);

		$pdf->Ln(10);
		$pdf->setX(5);
		$pdf->Cell(89, $nFont, utf8_decode('C R O Q U I S'), 'TLBR', 0, 'C', 0);
		$pdf->Cell(28, $nFont, '', '', 0, 'C', 0);
		$pdf->Cell(89, $nFont, utf8_decode('F A C H A D A'), 'TLBR', 1, 'C', 0);

		if ($in->croquis != "") {
			$fc = explode('.', $in->croquis);
			$archivo = public_path() . '/css/images/corevat/' . $fc[0] . '.' . $fc[1];
			if ( file_exists($archivo) ) {
				$pdf->Image($archivo, 5, 32, 89.0, 65.40);
			} else {
				$archivo = public_path() . '/corevat/files/' . $fc[0] . '-big.' . $fc[1];
				if ( file_exists($archivo) ) {
					$pdf->Image($archivo, 5, 32, 89.0, 65.40);
				} else {
					$pdf->Image(public_path() . '/css/images/corevat/blank.gif', 5, 32, 89.0, 65.40);
				}
			}
		} else {
			$pdf->Image(public_path() . '/css/images/corevat/blank.gif', 5, 32, 89.0, 65.40);
		}

		if ($in->fachada != "") {
			$fc = explode('.', $in->fachada);
			$archivo = public_path() . '/corevat/files/' . $fc[0] . '.' . $fc[1];
			if ( file_exists($archivo) ) {
				$pdf->Image($archivo, 122, 32, 89.0, 65.40);
			} else {
				$archivo = public_path() . '/corevat/files/' . $fc[0] . '-big.' . $fc[1];
				if ( file_exists($archivo) ) {
					$pdf->Image($archivo, 122, 32, 89.0, 65.40);
				} else {
					$pdf->Image(public_path() . '/css/images/corevat/blank.gif', 122, 32, 89.0, 65.40);
				}
			}
		} else {
			$pdf->Image(public_path() . '/css/images/corevat/blank.gif', 122, 32, 89.0, 65.40);
		}

		// Línea 1
		$pdf->Ln(80);
		$pdf->setX(5);
		$pdf->Cell(206, $nFont, utf8_decode('A) MEDIDAS Y COLINDANCIAS'), 'TLBR', 1, 'L', 0);
		$pdf->setX(5);
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->SetFont('Arial', '', 6);
		$rstMedCol = AiMedidasColindancias::AiMedidasColindanciasByFk($in->idavaluoinmueble);
		foreach ($rstMedCol as $medcol) {
			$pdf->setX(5);
			$pdf->SetFont('Arial', 'B', 6);
			$pdf->Cell(20, $nFont, utf8_decode($medcol->orientacion), 'BL', 0, 'L', 0);
			$pdf->SetFont('Arial', '', 6);
			$pdf->Cell(56, $nFont, utf8_decode($medcol->medida), 'BL', 0, 'L', 0);
			$pdf->Cell(130, $nFont, utf8_decode($medcol->colindancia), 'BLR', 1, 'L', 0);
		}

		// Línea 2
		$pdf->SetFont('Arial', 'B', 12);
		$pdf->Ln(10);
		$pdf->setX(5);

		if ($pdf->GetY() > 194) {
			$pdf->AddPage();
		}

		$pdf->Cell(206, $nFont, utf8_decode('B) CARACTERÍSTICAS DE LA CONSTRUCCIÓN ' . $pdf->GetY()), 'TBLR', 1, 'L', 0);
		$pdf->setX(5);
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(30, $nFont, utf8_decode("Cimentación: "), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(176, $nFont, utf8_decode($in->cimentacion), 'LBR', 1, 'L');
		$pdf->setX(5);
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(30, $nFont, utf8_decode("Estructuras: "), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(176, $nFont, utf8_decode($in->estructura), 'LBR', 1, 'L');
		$pdf->setX(5);
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(30, $nFont, utf8_decode("Muros: "), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(176, $nFont, utf8_decode($in->muros), 'LBR', 1, 'L');
		$pdf->setX(5);
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(30, $nFont, utf8_decode("Entrepisos: "), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(176, $nFont, utf8_decode($in->entrepisos), 'LBR', 1, 'L');
		$pdf->setX(5);
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(30, $nFont, utf8_decode("Techos: "), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(176, $nFont, utf8_decode($in->techos), 'LBR', 1, 'L');
		$pdf->setX(5);
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(30, $nFont, utf8_decode("Bardas: "), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(176, $nFont, utf8_decode($in->bardas), 'LBR', 1, 'L');

		// Línea 3
		$pdf->Ln(10);
		$pdf->setX(5);
		$pdf->SetFont('Arial', 'B', 6);
		$pdf->Cell(30, $nFont, utf8_decode("Uso de suelo: "), 'TLB', 0, 'R');
		$pdf->SetFont('Arial', '', 6);
		$pdf->Cell(53, $nFont, utf8_decode($in->usos_suelos), 'TLB', 0, 'L');
		$pdf->SetFont('Arial', 'B', 6);
		$pdf->Cell(25, $nFont, utf8_decode("Serv. y Restric.: "), 'TB', 0, 'R');
		$pdf->SetFont('Arial', '', 6);
		$pdf->Cell(98, $nFont, substr(utf8_decode($in->servidumbre_restricciones), 0, 81), 'TLBR', 1, 'L');
		$pdf->setX(5);
		$pdf->SetFont('Arial', 'B', 6);
		$pdf->Cell(30, $nFont, utf8_decode("Núm niveles de la Unidad: "), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 6);
		$pdf->Cell(63, $nFont, utf8_decode($in->nivel), 'LB', 0, 'L');
		$pdf->SetFont('Arial', 'B', 6);
		$pdf->Cell(30, $nFont, utf8_decode("Unidades rentables en la misma estructura: "), 'B', 0, 'R');
		$pdf->SetFont('Arial', '', 6);
		$pdf->Cell(83, $nFont, utf8_decode($in->unidades_rentables_escritura), 'LBR', 1, 'L');

		// Línea 4
		$pdf->setX(5);
		$xL = $pdf->GetX();
		$yL = $pdf->GetY();
		$pdf->Rect($xL, $yL, 30, $nFont * 3, false);

		$pdf->SetFont('Arial', 'B', 6);
		$pdf->MultiCell(30, 3.60, utf8_decode("\nDescripcion General del Inmueble:"), '', 'R');

		$pdf->setY($yL);
		$pdf->Rect(35, $yL, 176, $nFont * 3, false);

		$pdf->setX(45);
		$pdf->SetFont('Arial', '', 6);
		$pdf->MultiCell(166, 3.60, utf8_decode($in->descripcion_inmueble), '', 'L');

		// Línea 5
		$pdf->AddPage();
		$pdf->SetFont('Arial', 'B', 12);
		$pdf->SetFillColor(164, 164, 164);
		$pdf->setX(5);
		$pdf->Cell(206, $nFont, utf8_decode('CARACTERÍSTICAS DEL INMUEBLE (2 de 2)'), 'TLBR', 1, 'C', 1);

		$pdf->Ln(10);

		$pdf->SetFont('Arial', 'B', 12);
		$pdf->setX(5);
		$pdf->Cell(206, $nFont, utf8_decode('C) ACABADOS'), 'TBLR', 1, 'L', 0);
		$pdf->setX(5);
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(40, $nFont, utf8_decode(""), 'LB', 0, 'R');
		$pdf->Cell(55.3333333333333333333, $nFont, utf8_decode("PISOS"), 'LB', 0, 'C');
		$pdf->Cell(55.3333333333333333333, $nFont, utf8_decode("MUROS"), 'LB', 0, 'C');
		$pdf->Cell(55.3333333333333333333, $nFont, utf8_decode("PLAFONES"), 'LBR', 1, 'C');
		$pdf->setX(5);
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(40, $nFont, utf8_decode("Recámaras"), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 6);
		$pdf->Cell(55.3333333333333333333, $nFont, utf8_decode(substr($in->recamaras0, 0, 42)), 'LB', 0, 'L');
		$pdf->Cell(55.3333333333333333333, $nFont, utf8_decode(substr($in->recamaras1, 0, 42)), 'LB', 0, 'L');
		$pdf->Cell(55.3333333333333333333, $nFont, utf8_decode(substr($in->recamaras2, 0, 42)), 'LBR', 1, 'L');
		$pdf->setX(5);
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(40, $nFont, utf8_decode("Estancia Comedor"), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 6);
		$pdf->Cell(55.3333333333333333333, $nFont, utf8_decode(substr($in->estancia_comedor0, 0, 42)), 'LB', 0, 'L');
		$pdf->Cell(55.3333333333333333333, $nFont, utf8_decode(substr($in->estancia_comedor1, 0, 42)), 'LB', 0, 'L');
		$pdf->Cell(55.3333333333333333333, $nFont, utf8_decode(substr($in->estancia_comedor2, 0, 42)), 'LBR', 1, 'L');
		$pdf->setX(5);
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(40, $nFont, utf8_decode("Baños"), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 6);
		$pdf->Cell(55.3333333333333333333, $nFont, utf8_decode(substr($in->banos0, 0, 42)), 'LB', 0, 'L');
		$pdf->Cell(55.3333333333333333333, $nFont, utf8_decode(substr($in->banos1, 0, 42)), 'LB', 0, 'L');
		$pdf->Cell(55.3333333333333333333, $nFont, utf8_decode(substr($in->banos2, 0, 42)), 'LBR', 1, 'L');
		$pdf->setX(5);
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(40, $nFont, utf8_decode("Escaleras"), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 6);
		$pdf->Cell(55.3333333333333333333, $nFont, utf8_decode(substr($in->escaleras0, 0, 42)), 'LB', 0, 'L');
		$pdf->Cell(55.3333333333333333333, $nFont, utf8_decode(substr($in->escaleras1, 0, 42)), 'LB', 0, 'L');
		$pdf->Cell(55.3333333333333333333, $nFont, utf8_decode(substr($in->escaleras2, 0, 42)), 'LBR', 1, 'L');
		$pdf->setX(5);
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(40, $nFont, utf8_decode("Cocina"), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 6);
		$pdf->Cell(55.3333333333333333333, $nFont, utf8_decode(substr($in->cocina0, 0, 42)), 'LB', 0, 'L');
		$pdf->Cell(55.3333333333333333333, $nFont, utf8_decode(substr($in->cocina1, 0, 42)), 'LB', 0, 'L');
		$pdf->Cell(55.3333333333333333333, $nFont, utf8_decode(substr($in->cocina2, 0, 42)), 'LBR', 1, 'L');
		$pdf->setX(5);
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(40, $nFont, utf8_decode("Patio de Servicio"), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 6);
		$pdf->Cell(55.3333333333333333333, $nFont, utf8_decode(substr($in->patio_servicio0, 0, 42)), 'LB', 0, 'L');
		$pdf->Cell(55.3333333333333333333, $nFont, utf8_decode(substr($in->patio_servicio1, 0, 42)), 'LB', 0, 'L');
		$pdf->Cell(55.3333333333333333333, $nFont, utf8_decode(substr($in->patio_servicio2, 0, 42)), 'LBR', 1, 'L');
		$pdf->setX(5);
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(40, $nFont, utf8_decode("Estacionamiento"), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 6);
		$pdf->Cell(55.3333333333333333333, $nFont, utf8_decode(substr($in->estacionamiento0, 0, 42)), 'LB', 0, 'L');
		$pdf->Cell(55.3333333333333333333, $nFont, utf8_decode(substr($in->estacionamiento1, 0, 42)), 'LB', 0, 'L');
		$pdf->Cell(55.3333333333333333333, $nFont, utf8_decode(substr($in->estacionamiento2, 0, 42)), 'LBR', 1, 'L');
		$pdf->setX(5);
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(40, $nFont, utf8_decode("Fachada"), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 6);
		$pdf->Cell(55.3333333333333333333, $nFont, utf8_decode(substr($in->fachada0, 0, 42)), 'LB', 0, 'L');
		$pdf->Cell(55.3333333333333333333, $nFont, utf8_decode(substr($in->fachada1, 0, 42)), 'LB', 0, 'L');
		$pdf->Cell(55.3333333333333333333, $nFont, utf8_decode(substr($in->fachada2, 0, 42)), 'LBR', 1, 'L');
		$pdf->setX(5);
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(40, $nFont, utf8_decode("Hidráulico Sanitarias"), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 6);
		$pdf->Cell(55.3333333333333333333, $nFont, utf8_decode(substr($in->hidraulico_sanitarias, 0, 42)), 'LB', 0, 'L');
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(55.3333333333333333333, $nFont, utf8_decode("Eléctricas"), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 6);
		$pdf->Cell(55.3333333333333333333, $nFont, utf8_decode(substr($in->electricas, 0, 42)), 'LBR', 1, 'L');
		$pdf->setX(5);
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(40, $nFont, utf8_decode("Carpintería: "), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(166, $nFont, utf8_decode($in->carpinteria), 'LBR', 1, 'L');
		$pdf->setX(5);
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(40, $nFont, utf8_decode("Herrería: "), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(166, $nFont, utf8_decode($in->herreria), 'LBR', 1, 'L');

		$pdf->ln(10);
		$pdf->SetFont('Arial', 'B', 12);
		$pdf->setX(5);
		$pdf->Cell(206, $nFont, utf8_decode('D) SUPERFICIES'), 'TBLR', 1, 'L', 0);
		$pdf->setX(5);
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(60, $nFont, utf8_decode("Superficie Total del Terreno"), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(35.3333333333333333333, $nFont, utf8_decode($in->superficie_total_terreno) . ' m2', 'LB', 0, 'C');
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(75.3333333333333333333, $nFont, utf8_decode("Individo del Terreno"), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(35.3333333333333333333, $nFont, utf8_decode($in->indiviso_terreno) . ' %', 'LBR', 1, 'C');
		$pdf->setX(5);
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(60, $nFont, utf8_decode("Superficie del Terreno"), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(35.3333333333333333333, $nFont, utf8_decode($in->superficie_terreno) . ' m2', 'LB', 0, 'C');
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(75.3333333333333333333, $nFont, utf8_decode("Individo de Áreas Comunes"), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(35.3333333333333333333, $nFont, utf8_decode($in->indiviso_areas_comunes) . ' %', 'LBR', 1, 'C');
		$pdf->setX(5);
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(60, $nFont, utf8_decode("Superficie de Construcción"), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(35.3333333333333333333, $nFont, utf8_decode($in->superficie_construccion) . ' m2', 'LB', 0, 'C');
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(75.3333333333333333333, $nFont, utf8_decode("Individo Accesoría"), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(35.3333333333333333333, $nFont, utf8_decode($in->indiviso_accesoria) . ' %', 'LBR', 1, 'C');
		$pdf->setX(5);
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(60, $nFont, utf8_decode("Superficie Asentada en Escritura"), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(35.3333333333333333333, $nFont, utf8_decode($in->superficie_escritura) . ' m2', 'LB', 0, 'C');
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(75.3333333333333333333, $nFont, utf8_decode("Superficie Vendible"), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(35.3333333333333333333, $nFont, utf8_decode($in->superficie_vendible) . ' m2', 'LBR', 1, 'C');

		// ** *******************************************************
		// ** 5. ENFOQUE DE MERCADO
		// ** *******************************************************
		$fm = Avaluos::find($id)->AvaluosMercado;

		$pdf->AddPage();

		$pdf->SetFont('Arial', 'B', 12);
		$pdf->SetFillColor(164, 164, 164);
		$pdf->setX(5);
		$pdf->Cell(206, $nFont, utf8_decode('ENFOQUE DE MERCADO'), 'TLBR', 1, 'C', 1);

		//Comparables de terrenos (aem_comp_terrenos)
		$pdf->setX(5);
		$pdf->Cell(206, $nFont, utf8_decode('A) VENTA DE TERRENOS'), 'BLR', 1, 'L', 0);
		$pdf->setX(5);
		$pdf->SetFont('Arial', 'B', 7);
		$pdf->SetFillColor(208, 208, 208);
		$pdf->Cell(6, $nFont, utf8_decode('No.'), 'BLR', 0, 'L', 1);
		$pdf->Cell(90, $nFont, utf8_decode('Ubicación de la oferta (comparables)'), 'BL', 0, 'L', 1);
		$pdf->Cell(20, $nFont, utf8_decode('Precio Oferta'), 'BL', 0, 'R', 1);
		$pdf->Cell(15, $nFont, utf8_decode('Sup. Terr.'), 'BL', 0, 'R', 1);
		$pdf->Cell(15, $nFont, utf8_decode('Sup. Const.'), 'BL', 0, 'L', 1);
		$pdf->Cell(15, $nFont, utf8_decode('P. U./m2'), 'BL', 0, 'L', 1);
		$pdf->Cell(45, $nFont, utf8_decode('Fuente/ Antecedente/ Teléfono'), 'BLR', 1, 'L', 1);
		
		$rst = AemCompTerrenos::getAemCompTerrenosByFk($fm->idavaluoenfoquemercado);
		$lID = 0;
		$pdf->SetFont('Arial', '', 6);
		foreach ($rst as $fila) {
			$pdf->setX(5);
			$pdf->Cell(6, $nFont, ++$lID, 'BLR', 0, 'C', 0);
			$pdf->Cell(90, $nFont, utf8_decode(substr($fila->ubicacion, 0, 80)), 'BL', 0, 'L', 0);
			$pdf->Cell(20, $nFont, number_format($fila->precio, 2, '.', ','), 'BL', 0, 'R', 0);
			$pdf->Cell(15, $nFont, number_format($fila->superficie_terreno, 2, '.', ','), 'BL', 0, 'R', 0);
			$pdf->Cell(15, $nFont, number_format($fila->superficie_construida, 2, '.', ','), 'BL', 0, 'R', 0);
			$pdf->Cell(15, $nFont, number_format($fila->precio_unitario_m2_terreno, 2, '.', ','), 'BL', 0, 'R', 0);
			$pdf->Cell(45, $nFont, utf8_decode(substr($fila->observaciones, 0, 29)), 'BLR', 1, 'L', 0);
		}

		$pdf->ln(10);

		//Homologación (aem_homologacion)
		$pdf->setX(5);
		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(206, $nFont, utf8_decode(strtoupper('Homologación del Terreno en función del lote tipo o predominante en la zona, en caso de no existir este, en función del lote valuado')), 'TBLR', 1, 'L', 0);

		$pdf->setX(5);
		$pdf->SetFillColor(208, 208, 208);
		$pdf->Cell(6, $nFont * 2, utf8_decode('No.'), 'BLR', 0, 'L', 1);
		$pdf->Cell(102, $nFont * 2, utf8_decode('Comparable:'), 'BL', 0, 'C', 1);
		$pdf->Cell(6, $nFont * 2, utf8_decode('Sup'), 'BL', 0, 'C', 1);
		$pdf->Cell(20, $nFont * 2, utf8_decode('Valor unit'), 'BL', 0, 'C', 1);

		$pdf->setX(139);
		$pdf->Cell(50, $nFont, utf8_decode('Factores de Eficiencia'), 'BL', 0, 'C', 1);
		$pdf->Cell(22, $nFont, utf8_decode('Valor Unitario'), 'BLR', 1, 'C', 1);

		$pdf->setX(139);
		$pdf->Cell(10, $nFont, utf8_decode('Zona'), 'BL', 0, 'C', 1);
		$pdf->Cell(10, $nFont, utf8_decode('Ubic.'), 'BLR', 0, 'C', 1);
		$pdf->Cell(10, $nFont, utf8_decode('Fte.'), 'BLR', 0, 'C', 1);
		$pdf->Cell(10, $nFont, utf8_decode('Fma.'), 'BLR', 0, 'C', 1);
		$pdf->Cell(10, $nFont, utf8_decode('Sup.'), 'BLR', 0, 'C', 1);
		$pdf->Cell(11, $nFont, utf8_decode('Neg.'), 'BLR', 0, 'C', 1);
		$pdf->Cell(11, $nFont, utf8_decode('Rte. m2'), 'BLR', 1, 'R', 1);

		$rowsAemCompTerrenos = AemCompTerrenos::getAemHomologacionByFk($fm->idavaluoenfoquemercado);
		$lID = 0;
		$pdf->SetFont('Arial', '', 6);
		foreach ($rowsAemCompTerrenos as $fila) {
			$pdf->setX(5);
			$pdf->Cell(6, $nFont, ++$lID, 'BLR', 0, 'C', 0);
			$pdf->Cell(102, $nFont, utf8_decode($fila->comparable), 'BL', 0, 'L', 0);
			$pdf->Cell(6, $nFont, '', 'BL', 0, 'R', 0);
			$pdf->Cell(20, $nFont, number_format($fila->valor_unitario, 2, '.', ','), 'BL', 0, 'R', 0);

			$pdf->Cell(10, $nFont, number_format($fila->zona, 2, '.', ','), 'BL', 0, 'R', 0);
			$pdf->Cell(10, $nFont, number_format($fila->ubicacion, 2, '.', ','), 'BL', 0, 'R', 0);
			$pdf->Cell(10, $nFont, number_format($fila->frente, 2, '.', ','), 'BL', 0, 'R', 0);

			$pdf->Cell(10, $nFont, number_format($fila->forma, 2, '.', ','), 'BL', 0, 'R', 0);
			$pdf->Cell(10, $nFont, number_format($fila->superficie, 2, '.', ','), 'BL', 0, 'R', 0);
			$pdf->Cell(11, $nFont, number_format($fila->valor_unitario_negociable, 2, '.', ','), 'BL', 0, 'R', 0);
			$pdf->Cell(11, $nFont, number_format($fila->valor_unitario_resultante_m2, 2, '.', ','), 'BLR', 1, 'R', 0);
		}
		$pdf->setX(5);
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(184, $nFont, utf8_decode('Valor Unitario Promedio ($/m²)'), 'L', 0, 'R', 0);
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(22, $nFont, number_format($fm->valor_unitario_promedio, 2, '.', ','), 'BLR', 1, 'R', 0);
		$pdf->setX(5);
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(184, $nFont, utf8_decode('Valor aplicado por m²'), 'BL', 0, 'R', 0);
		$pdf->Cell(22, $nFont, number_format($fm->valor_aplicado_m2, 2, '.', ','), 'BLR', 1, 'R', 0);

		//Información (aem_informacion)
		$pdf->ln(10);
		$pdf->setX(5);
		$pdf->SetFont('Arial', 'B', 12);
		$pdf->Cell(206, $nFont, utf8_decode('B) VENTA DE INMUEBLES SIMILARES EN USO AL QUE SE VALUA (sujeto)'), 'TBLR', 1, 'L', 0);
		$pdf->setX(5);
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->SetFillColor(208, 208, 208);
		$pdf->Cell(6, $nFont, utf8_decode('No.'), 'BLR', 0, 'L', 1);
		$pdf->Cell(130, $nFont, utf8_decode('Ubicación de la oferta (comparables)'), 'BL', 0, 'L', 1);
		$pdf->Cell(10, $nFont, utf8_decode('Edad'), 'BL', 0, 'C', 1);
		$pdf->Cell(17, $nFont, utf8_decode('Teléfono'), 'BL', 0, 'L', 1);
		$pdf->Cell(43, $nFont, utf8_decode('Fuente/ Antecedentes'), 'BLR', 1, 'L', 1);

		$rowsAemInformacion = AemInformacion::getAemInformacionByFk($fm->idavaluoenfoquemercado);
		$lID = 0;
		$pdf->SetFont('Arial', '', 6);
		foreach ($rowsAemInformacion as $fila) {
			$pdf->setX(5);
			$pdf->Cell(6, $nFont, ++$lID, 'BLR', 0, 'C', 0);
			$pdf->Cell(130, $nFont, utf8_decode($fila->ubicacion), 'BL', 0, 'L', 0);
			$pdf->Cell(10, $nFont, utf8_decode($fila->edad), 'BL', 0, 'C', 0);
			$pdf->Cell(17, $nFont, utf8_decode($fila->telefono), 'BL', 0, 'L', 0);
			$pdf->Cell(43, $nFont, utf8_decode($fila->observaciones), 'BLR', 1, 'L', 0);
		}

		//Analisis (aem_analisis)
		$pdf->ln(10);
		$pdf->setX(5);
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(206, $nFont, utf8_decode('Análisis por homologación'), 'TBLR', 1, 'L', 0);
		$pdf->setX(5);
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->SetFillColor(208, 208, 208);

		$pdf->Cell(6, $nFont, utf8_decode(''), 'LR', 0, 'L', 1);
		$pdf->Cell(25, $nFont, utf8_decode('Precio de Venta'), 'BL', 0, 'C', 1);
		$pdf->Cell(29, $nFont, utf8_decode('Superficie m²'), 'BL', 0, 'C', 1);
		$pdf->Cell(23, $nFont, utf8_decode('Valor unitario'), 'BL', 0, 'C', 1);
		$pdf->Cell(98, $nFont, utf8_decode('Factores de Homologación'), 'BL', 0, 'C', 1);
		$pdf->Cell(25, $nFont, utf8_decode('Valor unitario'), 'BLR', 1, 'C', 1);
		$pdf->setX(5);
		$pdf->Cell(6, $nFont, utf8_decode('No'), 'BLR', 0, 'C', 1);
		$pdf->Cell(25, $nFont, utf8_decode('Inmuebles Sim'), 'BL', 0, 'C', 1);
		$pdf->Cell(14.5, $nFont, utf8_decode('Terreno'), 'BL', 0, 'C', 1);
		$pdf->Cell(14.5, $nFont, utf8_decode('Construc.'), 'BL', 0, 'C', 1);
		$pdf->Cell(23, $nFont, utf8_decode('$/m²'), 'BL', 0, 'C', 1);
		$pdf->Cell(14, $nFont, utf8_decode('Zona'), 'BL', 0, 'C', 1);
		$pdf->Cell(14, $nFont, utf8_decode('Ubic'), 'BL', 0, 'C', 1);
		$pdf->Cell(14, $nFont, utf8_decode('Sup'), 'BL', 0, 'C', 1);
		$pdf->Cell(14, $nFont, utf8_decode('Edad'), 'BL', 0, 'C', 1);
		$pdf->Cell(14, $nFont, utf8_decode('Cons'), 'BL', 0, 'C', 1);
		$pdf->Cell(14, $nFont, utf8_decode('Neg'), 'BL', 0, 'C', 1);
		$pdf->Cell(14, $nFont, utf8_decode('Fr'), 'BL', 0, 'C', 1);
		$pdf->Cell(25, $nFont, utf8_decode('Resultante ($/m²)'), 'BLR', 1, 'C', 1);

		$rowsAemInformacion = AemInformacion::getAemAnalisisByFk($fm->idavaluoenfoquemercado);
		$lID = 0;
		$pdf->SetFont('Arial', '', 7);
		foreach ($rowsAemInformacion as $fila) {
			$pdf->setX(5);
			$pdf->Cell(6, $nFont, ++$lID, 'BLR', 0, 'C', 0);
			$pdf->Cell(25, $nFont, number_format($fila->precio_venta, 2, '.', ','), 'BL', 0, 'R', 0);
			$pdf->Cell(14.5, $nFont, number_format($fila->superficie_terreno, 2, '.', ','), 'BL', 0, 'R', 0);
			$pdf->Cell(14.5, $nFont, number_format($fila->superficie_construccion, 2, '.', ','), 'BL', 0, 'R', 0);
			$pdf->Cell(23, $nFont, number_format($fila->valor_unitario_m2, 2, '.', ','), 'BL', 0, 'R', 0);
			$pdf->Cell(14, $nFont, number_format($fila->factor_zona, 2, '.', ','), 'BL', 0, 'C', 0);
			$pdf->Cell(14, $nFont, number_format($fila->factor_ubicacion, 2, '.', ','), 'BL', 0, 'C', 0);
			$pdf->Cell(14, $nFont, number_format($fila->factor_superficie, 2, '.', ','), 'BL', 0, 'C', 0);
			$pdf->Cell(14, $nFont, number_format($fila->factor_edad, 2, '.', ','), 'BL', 0, 'C', 0);
			$pdf->Cell(14, $nFont, number_format($fila->factor_conservacion, 2, '.', ','), 'BL', 0, 'C', 0);
			$pdf->Cell(14, $nFont, number_format($fila->factor_negociacion, 2, '.', ','), 'BL', 0, 'C', 0);
			$pdf->Cell(14, $nFont, number_format($fila->factor_resultante, 2, '.', ','), 'BL', 0, 'C', 0);
			$pdf->Cell(25, $nFont, number_format($fila->valor_unitario_resultante_m2, 2, '.', ','), 'BLR', 1, 'R', 0);
		}
		$pdf->setX(5);
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(181, $nFont, utf8_decode('Valor promedio:'), 'L', 0, 'R', 0);
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(25, $nFont, number_format($fm->promedio_analisis, 2, '.', ','), 'BLR', 1, 'R', 0);
		$pdf->setX(5);
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(181, $nFont, utf8_decode('Superficie Construida del Sujeto:'), 'BL', 0, 'R', 0);
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(25, $nFont, number_format($fm->superficie_construida, 2, '.', ','), 'BLR', 1, 'R', 0);
		$pdf->Ln(10);
		$pdf->setX(5);
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(181, $nFont, utf8_decode('Valor comparativo de mercado:'), 'TBL', 0, 'R', 0);
		$pdf->SetFillColor(246, 229, 115);
		$pdf->Cell(25, $nFont, number_format($fm->valor_comparativo_mercado, 2, '.', ','), 'TBLR', 1, 'R', 1);

		//*********************************************************
		// ** 6. ANALISIS FISICO
		//*********************************************************
		$ff = AvaluosFisico::getAvaluoFisicoByFk($id);
		$pdf->AddPage();

		$pdf->SetFont('Arial', 'B', 12);
		$pdf->SetFillColor(164, 164, 164);
		$pdf->setX(5);
		$pdf->Cell(206, $nFont, utf8_decode('ENFOQUE DE FÍSICO'), 'TLBR', 1, 'C', 1);
		$pdf->setX(5);
		$pdf->Cell(206, $nFont, utf8_decode('A) TERRENO'), 'BLR', 1, 'L', 0);
		$pdf->setX(5);
		$pdf->SetFont('Arial', 'B', 8);

		// Analisis (aef_terrenos)
		$pdf->Cell(29, $nFont * 2, utf8_decode('Fracción'), 'LB', 0, 'L', 1);
		$pdf->Cell(29, $nFont * 2, utf8_decode('Superficie m²'), 'BL', 0, 'C', 1);
		$pdf->Cell(84, $nFont, utf8_decode('Factores de Eficiencia'), 'BL', 0, 'C', 1);
		$pdf->Cell(25, $nFont * 2, utf8_decode('V. U. Neto'), 'BL', 0, 'C', 1);
		$pdf->Cell(14, $nFont * 2, utf8_decode('Indiviso'), 'BL', 0, 'C', 1);
		$pdf->Cell(25, $nFont, utf8_decode('Valor'), 'LR', 1, 'C', 1);
		$pdf->setX(63);
		$pdf->Cell(14, $nFont, utf8_decode('Irre'), 'BL', 0, 'C', 1);
		$pdf->Cell(14, $nFont, utf8_decode('Top'), 'BL', 0, 'C', 1);
		$pdf->Cell(14, $nFont, utf8_decode('Frente'), 'BL', 0, 'C', 1);
		$pdf->Cell(14, $nFont, utf8_decode('Forma'), 'BL', 0, 'C', 1);
		$pdf->Cell(14, $nFont, utf8_decode('Otros'), 'BL', 0, 'C', 1);
		$pdf->Cell(14, $nFont, utf8_decode('Fr'), 'BL', 0, 'C', 1);
		$pdf->setX(186);
		$pdf->Cell(25, $nFont, utf8_decode('Resultante ($/m²)'), 'BLR', 1, 'C', 1);

		$rowsAefTerrenos = AefTerrenos::AefTerrenosByFk($ff->idavaluoenfoquefisico);
		$lID = 0;
		$pdf->SetFont('Arial', '', 7);
		foreach ($rowsAefTerrenos as $fila) {
			$pdf->setX(5);
			$pdf->Cell(29, $nFont, utf8_decode($fila->fraccion), 'LB', 0, 'L', 0);
			$pdf->Cell(29, $nFont, number_format($fila->superficie, 2, '.', ','), 'BL', 0, 'R', 0);
			$pdf->Cell(14, $nFont, number_format($fila->irregular, 2, '.', ','), 'BL', 0, 'C', 0);
			$pdf->Cell(14, $nFont, number_format($fila->top, 2, '.', ','), 'BL', 0, 'C', 0);
			$pdf->Cell(14, $nFont, number_format($fila->frente, 2, '.', ','), 'BL', 0, 'C', 0);
			$pdf->Cell(14, $nFont, number_format($fila->forma, 2, '.', ','), 'BL', 0, 'C', 0);
			$pdf->Cell(14, $nFont, number_format($fila->otros, 2, '.', ','), 'BL', 0, 'C', 0);
			$pdf->Cell(14, $nFont, number_format($fila->factor_resultante, 2, '.', ','), 'BL', 0, 'R', 0);
			$pdf->Cell(25, $nFont, number_format($fila->valor_unitario_neto, 2, '.', ','), 'BL', 0, 'R', 0);
			$pdf->Cell(14, $nFont, number_format($fila->indiviso, 2, '.', ','), 'BL', 0, 'R', 0);
			$pdf->Cell(25, $nFont, number_format($fila->valor_parcial, 2, '.', ','), 'BLR', 1, 'R', 0);
		}
		$pdf->setX(5);
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(181, $nFont, utf8_decode('Valor del Terreno:'), 'LB', 0, 'R', 0);
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(25, $nFont, number_format($ff->valor_terreno, 2, '.', ','), 'BLR', 1, 'R', 0);

		$pdf->ln(10);
		$pdf->setX(5);
		$pdf->SetFont('Arial', 'B', 12);
		$pdf->Cell(206, $nFont, utf8_decode('B) CONSTRUCCIONES'), 'TBLR', 1, 'L', 0);
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->setX(5);
		$pdf->Cell(206, $nFont, utf8_decode('CLASIFICACIÓN DE LAS CONSTRUCCIONES'), 'BLR', 1, 'C', 0);

		//Línea 1
		$pdf->setX(5);
		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(20, $nFont, utf8_decode("Clase General: "), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 6);
		$pdf->Cell(20, $nFont, utf8_decode($ff->clase_general_inmueble), 'LB', 0, 'L');
		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(10, $nFont, utf8_decode("Tipo "), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 6);
		$pdf->Cell(30, $nFont, utf8_decode($ff->tipo_inmueble), 'LB', 0, 'L');
		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(30, $nFont, utf8_decode("Estado Conservación "), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 6);
		$pdf->Cell(51, $nFont, utf8_decode($ff->estado_conservacion), 'LB', 0, 'L');
		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(30, $nFont, utf8_decode("Calidad del Proyecto"), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 6);
		$pdf->Cell(15, $nFont, utf8_decode($ff->calidad_proyecto), 'LBR', 1, 'L');

		//Línea 2
		$pdf->setX(5);
		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(50, $nFont, utf8_decode("Edad de las construcciones (Años): "), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 6);
		$pdf->Cell(10, $nFont, utf8_decode($ff->edad_construccion), 'LB', 0, 'C');
		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(30, $nFont, utf8_decode("Vida Útil Remanente "), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 6);
		$pdf->Cell(10, $nFont, utf8_decode($ff->vida_util), 'LB', 0, 'C');
		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(38, $nFont, utf8_decode("Número de niveles: "), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 6);
		$pdf->Cell(10, $nFont, utf8_decode($ff->numero_niveles), 'LB', 0, 'C');
		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(48, $nFont, utf8_decode("Nivel en edificio (condominio):"), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 6);
		$pdf->Cell(10, $nFont, utf8_decode($ff->nivel_edificio_condominio), 'LBR', 1, 'C');

		//Analisis (_viAEF_Construcciones)
		$pdf->ln(10);
		$pdf->setX(5);
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(50, $nFont * 2, utf8_decode('Tipo de Construcción'), 'TLB', 0, 'L', 1);
		$pdf->Cell(14, $nFont * 2, utf8_decode('Edad'), 'TBL', 0, 'C', 1);
		$pdf->Cell(25, $nFont * 2, utf8_decode('Superficie m²'), 'TBL', 0, 'C', 1);
		$pdf->Cell(25, $nFont * 2, utf8_decode('V.R. Nuevo'), 'TBL', 0, 'C', 1);

		$pdf->Cell(42, $nFont, utf8_decode('Factores'), 'TBL', 0, 'C', 1);

		$pdf->Cell(25, $nFont * 2, utf8_decode('V. U. Neto'), 'TBL', 0, 'C', 1);

		$pdf->Cell(25, $nFont, utf8_decode('Valor Parcial'), 'TLR', 1, 'C', 1);

		$pdf->setX(119);
		$pdf->Cell(14, $nFont, utf8_decode('Edad'), 'BL', 0, 'C', 1);
		$pdf->Cell(14, $nFont, utf8_decode('Cons.'), 'BL', 0, 'C', 1);
		$pdf->Cell(14, $nFont, utf8_decode('Res.'), 'BLR', 0, 'C', 1);
		$pdf->setX(186);
		$pdf->Cell(25, $nFont, utf8_decode('Construcciones'), 'BLR', 1, 'C', 1);

		$rowsAefConstrucciones = AefConstrucciones::AefConstruccionesByFk($ff->idavaluoenfoquefisico);
		$lID = 0;
		$pdf->SetFont('Arial', '', 7);
		foreach ($rowsAefConstrucciones as $fila) {
			$pdf->setX(5);
			$pdf->Cell(6, $nFont, ++$lID, 'LB', 0, 'L', 0);
			$pdf->Cell(44, $nFont, utf8_decode($fila->tipo), 'LB', 0, 'L', 0);
			$pdf->Cell(14, $nFont, number_format($fila->edad, 2, '.', ','), 'BL', 0, 'R', 0);
			$pdf->Cell(25, $nFont, number_format($fila->superficie_m2, 2, '.', ','), 'BL', 0, 'R', 0);
			$pdf->Cell(25, $nFont, number_format($fila->valor_nuevo, 2, '.', ','), 'BL', 0, 'R', 0);
			$pdf->Cell(14, $nFont, number_format($fila->factor_edad, 4, '.', ','), 'BL', 0, 'C', 0);
			$pdf->Cell(14, $nFont, number_format($fila->factor_conservacion, 2, '.', ','), 'BL', 0, 'C', 0);
			$pdf->Cell(14, $nFont, number_format($fila->factor_resultante, 2, '.', ','), 'BL', 0, 'C', 0);
			$pdf->Cell(25, $nFont, number_format($fila->valor_neto, 2, '.', ','), 'BL', 0, 'R', 0);
			$pdf->Cell(25, $nFont, number_format($fila->valor_parcial_construccion, 2, '.', ','), 'BLR', 1, 'R', 0);
		}
		$pdf->setX(5);
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(64, $nFont, utf8_decode('Total Superficie m²:'), 'LB', 0, 'R', 0);
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(25, $nFont, number_format($ff->total_metros_construccion, 2, '.', ','), 'BLR', 0, 'R', 0);
		$pdf->setX(94);
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(92, $nFont, utf8_decode('Valor de las construcciones:'), 'LB', 0, 'R', 0);
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(25, $nFont, number_format($ff->valor_construccion, 2, '.', ','), 'BLR', 1, 'R', 0);

		//Analisis (aef_condominios)
		$pdf->ln(10);
		$pdf->setX(5);
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(206, $nFont, utf8_decode('C1)  COMUNES, INSTALACIONES ESPECIALES Y OBRAS COMPLEMENTARIAS (SOLO EN CONDOMINIOS)'), 'TBLR', 1, 'L', 0);

		$pdf->setX(5);
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(45, $nFont * 2, utf8_decode('Descripción'), 'TLB', 0, 'L', 1);
		$pdf->Cell(14, $nFont * 2, utf8_decode('Unidad'), 'TBL', 0, 'C', 1);
		$pdf->Cell(15, $nFont * 2, utf8_decode('Cantidad'), 'TBL', 0, 'C', 1);
		$pdf->Cell(20, $nFont * 2, utf8_decode('V.R. Nuevo'), 'TBL', 0, 'C', 1);
		$pdf->Cell(15, $nFont, utf8_decode('Vida'), 'TBL', 0, 'C', 1);
		$pdf->Cell(15, $nFont, utf8_decode('Edad'), 'TBL', 0, 'C', 1);

		$pdf->Cell(42, $nFont, utf8_decode('Factores'), 'TBL', 0, 'C', 1);

		$pdf->Cell(15, $nFont * 2, utf8_decode('Indiviso'), 'TBL', 0, 'C', 1);

		$pdf->Cell(25, $nFont, utf8_decode('Valor Parcial'), 'TLR', 1, 'C', 1);

		$pdf->setX(99);
		$pdf->Cell(15, $nFont, utf8_decode('Remte'), 'BL', 0, 'C', 1);
		$pdf->Cell(15, $nFont, utf8_decode('Años'), 'BL', 0, 'C', 1);
		$pdf->Cell(14, $nFont, utf8_decode('Edad'), 'BL', 0, 'C', 1);
		$pdf->Cell(14, $nFont, utf8_decode('Cons.'), 'BL', 0, 'C', 1);
		$pdf->Cell(14, $nFont, utf8_decode('Res.'), 'BLR', 0, 'C', 1);
		$pdf->setX(186);
		$pdf->Cell(25, $nFont, utf8_decode('Comunes'), 'BLR', 1, 'C', 1);
		$rowsAefCondominios = AefCondominios::AefCondominiosByFk($ff->idavaluoenfoquefisico);
		$lID = 0;
		foreach ($rowsAefCondominios as $fila) {
			$pdf->setX(5);
			$pdf->SetFont('Arial', '', 6);
			$pdf->Cell(45, $nFont, utf8_decode(substr($fila->descripcion, 0, 47)), 'LB', 0, 'L', 0);
			$pdf->SetFont('Arial', '', 7);
			$pdf->Cell(14, $nFont, utf8_decode($fila->unidad), 'BL', 0, 'C', 0);
			$pdf->Cell(15, $nFont, number_format($fila->cantidad, 2, '.', ','), 'BL', 0, 'R', 0);
			$pdf->Cell(20, $nFont, number_format($fila->valor_nuevo, 2, '.', ','), 'BL', 0, 'R', 0);
			$pdf->Cell(15, $nFont, number_format($fila->vida_remanente, 4, '.', ','), 'BL', 0, 'C', 0);
			$pdf->Cell(15, $nFont, number_format($fila->edad, 2, '.', ','), 'BL', 0, 'C', 0);
			$pdf->Cell(14, $nFont, number_format($fila->factor_edad, 4, '.', ','), 'BL', 0, 'R', 0);
			$pdf->Cell(14, $nFont, number_format($fila->factor_conservacion, 2, '.', ','), 'BL', 0, 'R', 0);
			$pdf->Cell(14, $nFont, number_format($fila->factor_resultante, 2, '.', ','), 'BL', 0, 'R', 0);
			$pdf->Cell(15, $nFont, number_format($fila->indiviso, 2, '.', ','), 'BL', 0, 'R', 0);
			$pdf->Cell(25, $nFont, number_format($fila->valor_parcial, 2, '.', ','), 'BLR', 1, 'R', 0);
		}
		$pdf->setX(5);
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(181, $nFont, utf8_decode('Subtotal Áreas Comunes:'), 'LB', 0, 'R', 0);
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(25, $nFont, number_format($ff->subtotal_area_condominio, 2, '.', ','), 'BLR', 1, 'R', 0);

		// Analisis (aef_instalaciones)
		$pdf->ln(10);
		$pdf->setX(5);
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(206, $nFont, utf8_decode('C2)  PRIVATIVAS, INSTALACIONES ESPECIALES Y OBRAS COMPLEMENTARIAS'), 'TBLR', 1, 'L', 0);

		$pdf->setX(5);
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(45, $nFont * 2, utf8_decode('Descripción'), 'TLB', 0, 'L', 1);
		$pdf->Cell(14, $nFont * 2, utf8_decode('Unidad'), 'TBL', 0, 'C', 1);
		$pdf->Cell(15, $nFont * 2, utf8_decode('Cantidad'), 'TBL', 0, 'C', 1);
		$pdf->Cell(20, $nFont * 2, utf8_decode('V.R. Nuevo'), 'TBL', 0, 'C', 1);
		$pdf->Cell(15, $nFont, utf8_decode('Vida Util'), 'TBL', 0, 'C', 1);
		$pdf->Cell(15, $nFont, utf8_decode('Edad'), 'TBL', 0, 'C', 1);

		$pdf->Cell(42, $nFont, utf8_decode('Factores'), 'TBL', 0, 'C', 1);

		$pdf->Cell(15, $nFont, utf8_decode('V. Neto'), 'TL', 0, 'C', 1);

		$pdf->Cell(25, $nFont, utf8_decode('Valor Parcial'), 'TLR', 1, 'C', 1);

		$pdf->setX(99);
		$pdf->Cell(15, $nFont, utf8_decode('Total'), 'BL', 0, 'C', 1);
		$pdf->Cell(15, $nFont, utf8_decode('Años'), 'BL', 0, 'C', 1);
		$pdf->Cell(14, $nFont, utf8_decode('Edad'), 'BL', 0, 'C', 1);
		$pdf->Cell(14, $nFont, utf8_decode('Cons.'), 'BL', 0, 'C', 1);
		$pdf->Cell(14, $nFont, utf8_decode('Res.'), 'BLR', 0, 'C', 1);
		$pdf->setX(171);
		$pdf->Cell(15, $nFont, utf8_decode('Rep.'), 'BL', 0, 'C', 1);
		$pdf->Cell(25, $nFont, utf8_decode('Elem. Adic.'), 'BLR', 1, 'C', 1);
		
		$rowsAefInstalaciones = AefInstalaciones::AefInstalacionesByFk($ff->idavaluoenfoquefisico);
		$lID = 0;
		foreach ($rowsAefInstalaciones as $fila) {
			$pdf->setX(5);
			$pdf->SetFont('Arial', '', 6);
			$pdf->Cell(45, $nFont, utf8_decode(substr($fila->descripcion, 0, 47)), 'LB', 0, 'L', 0);
			$pdf->SetFont('Arial', '', 7);
			$pdf->Cell(14, $nFont, utf8_decode($fila->unidad), 'BL', 0, 'C', 0);
			$pdf->Cell(15, $nFont, number_format($fila->cantidad, 2, '.', ','), 'BL', 0, 'R', 0);
			$pdf->Cell(20, $nFont, number_format($fila->valor_nuevo, 2, '.', ','), 'BL', 0, 'R', 0);
			$pdf->Cell(15, $nFont, number_format($fila->vida_util, 4, '.', ','), 'BL', 0, 'C', 0);
			$pdf->Cell(15, $nFont, number_format($fila->edad, 2, '.', ','), 'BL', 0, 'C', 0);
			$pdf->Cell(14, $nFont, number_format($fila->factor_edad, 4, '.', ','), 'BL', 0, 'R', 0);
			$pdf->Cell(14, $nFont, number_format($fila->factor_conservacion, 2, '.', ','), 'BL', 0, 'R', 0);
			$pdf->Cell(14, $nFont, number_format($fila->factor_resultante, 2, '.', ','), 'BL', 0, 'R', 0);
			$pdf->Cell(15, $nFont, number_format($fila->valor_neto, 2, '.', ','), 'BL', 0, 'R', 0);
			$pdf->Cell(25, $nFont, number_format($fila->valor_parcial, 2, '.', ','), 'BLR', 1, 'R', 0);
		}
		$pdf->setX(5);
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(181, $nFont, utf8_decode('Subtotal Instalaciones Especiales:'), 'LB', 0, 'R', 0);
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(25, $nFont, number_format($ff->subtotal_instalaciones_especiales, 2, '.', ','), 'BLR', 1, 'R', 0);

		/*
		  Analisis (aef_instalaciones)
		 */
		$pdf->ln(10);
		$pdf->setX(5);
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(181, $nFont, utf8_decode('Valor Físico Total:'), 'TBL', 0, 'R', 0);
		$pdf->SetFillColor(246, 229, 115);
		$pdf->Cell(25, $nFont, number_format($ff->total_valor_fisico, 2, '.', ','), 'TBLR', 1, 'R', 1);

		// *********************************************************
		// ** 7. CONCLUSIONES
		// *********************************************************
		$pdf->AddPage();
		$nFont = 12;
		$pdf->SetFont('Arial', 'B', 12);
		$pdf->SetFillColor(164, 164, 164);
		$pdf->setX(5);
		$pdf->Cell(206, $nFont, 'CONCLUSIONES', 'TLBR', 1, 'C', 1);

		$cl = Avaluos::find($id)->AvaluosConclusiones;
		$pdf->ln(10);
		$pdf->setX(5);
		$pdf->Cell(100, $nFont * 2, 'RESUMEN DE VALORES', 'TL', 0, 'C', 0);
		$pdf->SetFont('Arial', 'B', 10);
		$pdf->Cell(60, $nFont, utf8_decode('Valor Comparativo de Mercado:'), 'LT', 0, 'R', 0);
		$pdf->SetFont('Arial', 'B', 12);
		$pdf->Cell(46, $nFont, '$ ' . number_format($cl->valor_mercado, 2, '.', ','), 'TLR', 1, 'R', 0);
		$pdf->setX(105);
		$pdf->SetFont('Arial', 'B', 10);
		$pdf->Cell(60, $nFont, utf8_decode('Valor Físico:'), 'LT', 0, 'R', 0);
		$pdf->SetFont('Arial', 'B', 12);
		$pdf->Cell(46, $nFont, '$ ' . number_format($cl->valor_fisico, 2, '.', ','), 'TLR', 1, 'R', 0);

		// Descripcion de la conclusión
		$pdf->setX(5);
		$xL = $pdf->GetX();
		$yL = $pdf->GetY();
		$pdf->Rect($xL, $yL, 206, $nFont * 5, false);

		$pdf->ln(10);

		$pdf->setX(5);
		$pdf->SetFont('Arial', '', 8);
		$pdf->MultiCell(206, 3.60, utf8_decode($cl->leyenda), '', 'L');

		$pdf->ln(24);
		$pdf->setX(5);
		$pdf->SetFont('Arial', 'B', 14);
		$pdf->SetFillColor(246, 229, 115);
		//$pdf->SetDrawColor(246,229,115);
		$pdf->SetLineWidth('0.5');
		$pdf->Cell(140, $nFont, utf8_decode('Importe del Valor Comercial:'), 'TBL', 0, 'R', 1);
		$pdf->SetFont('Arial', 'B', 16);
		$pdf->Cell(66, $nFont, '$ ' . number_format($cl->valor_concluido, 2, '.', ','), 'TBLR', 1, 'R', 1);

		$pdf->setX(5);
		$pdf->SetFont('Arial', '', 9);
		$pdf->SetFillColor(208, 208, 208);
		//$pdf->SetDrawColor(246,229,115);
		$val0 = explode('.', $cl->valor_concluido);
		$toLetter = new NumberToLetterConverter();

		$pdf->Cell(206, $nFont, trim($toLetter->to_word($val0[0])) . ' PESOS ' . $val0[1] . '/100 M.N.', 'TBLR', 1, 'R', 1);

		$pdf->SetLineWidth('0');
		$pdf->ln(10);
		$pdf->setX(5);
		$pdf->SetFont('Arial', 'B', 14);
		$pdf->SetFillColor(246, 229, 115);
		//$pdf->SetDrawColor(246,229,115);
		$pdf->SetLineWidth('0');
		$yL = $pdf->GetY();
		$pdf->SetFillColor(255, 255, 255);

		$pdf->SetFont('Arial', '', 9);
		$nFont = 6;
		$pdf->ln(30);
		$pdf->setX(5);
		$pdf->Cell(70, $nFont, utf8_decode(trim($rs->apellidos)) . ' ' . utf8_decode(trim($rs->nombres)), '', 1, 'C', 0);
		$pdf->setX(5);
		$pdf->Cell(70, $nFont, trim($rs->registro), '', 1, 'C', 0);

		$pdf->ln(20);
		$pdf->setX(5);
		$pdf->Cell(70, $nFont, '', '', 0, 'C', 0);
		$pdf->Cell(70, $nFont, 'FIRMA', '', 0, 'C', 0);
		$pdf->Cell(66, $nFont, 'SELLO', '', 1, 'C', 0);

		$pdf->Rect(5, $yL, 70, 70, false);
		$pdf->Rect(75, $yL, 70, 70, false);
		$pdf->Rect(145, $yL, 66, 70, false);

		// *********************************************************
		// ** 7. ANEXO FOTOGRÁFICO
		// *********************************************************
		$pdf->AddPage();
		$nFont = 10;
		$pdf->SetFont('Arial', 'B', 12);
		$pdf->SetFillColor(164, 164, 164);
		$pdf->setX(5);
		$pdf->Cell(206, $nFont, utf8_decode('ANEXO FOTOGRÁFICO'), 'TLBR', 1, 'C', 1);

		$ft = Avaluos::find($id)->AvaluosFotos;
		$pdf->Ln(0);
		$pdf->SetFont('Arial', '', 6);
		$pdf->setX(5);
		
		if ($ft->foto0 != "") {
			$fc = explode('.', $ft->foto0);
			$archivo = public_path() . '/corevat/files/' . $fc[0] . '.' . $fc[1];
			if ( file_exists($archivo) ) {
				$pdf->Image($archivo, 5, 22, 50.0, 50);
			} else {
				$archivo = public_path() . '/corevat/files/' . $fc[0] . '-big.' . $fc[1];
				if ( file_exists($archivo) ) {
					$pdf->Image($archivo, 5, 22, 50.0, 50);
				} else {
					$pdf->Image(public_path() . '/css/images/corevat/blank.gif', 122, 32, 89.0, 65.40);
				}
			}
		} else {
			$pdf->Image(public_path() . '/css/images/corevat/blank.gif', 122, 32, 89.0, 65.40);
		}

		if ($ft->foto1 != "") {
			$fc = explode('.', $ft->foto1);
			$archivo = public_path() . '/corevat/files/' . $fc[0] . '.' . $fc[1];
			if ( file_exists($archivo) ) {
				$pdf->Image($archivo, 83, 22, 50.0, 50);
			} else {
				$archivo = public_path() . '/corevat/files/' . $fc[0] . '-big.' . $fc[1];
				if ( file_exists($archivo) ) {
					$pdf->Image($archivo, 83, 22, 50.0, 50);
				} else {
					$pdf->Image(public_path() . '/css/images/corevat/blank.gif', 83, 22, 50.0, 50);
				}
			}
		} else {
			$pdf->Image(public_path() . '/css/images/corevat/blank.gif', 83, 22, 50.0, 50);
		}

		if ($ft->foto2 != "") {
			$fc = explode('.', $ft->foto2);
			$archivo = public_path() . '/corevat/files/' . $fc[0] . '.' . $fc[1];
			if ( file_exists($archivo) ) {
				$pdf->Image($archivo, 161, 22, 50.0, 50);
			} else {
				$archivo = public_path() . '/corevat/files/' . $fc[0] . '-big.' . $fc[1];
				if ( file_exists($archivo) ) {
					$pdf->Image($archivo, 161, 22, 50.0, 50);
				} else {
					$pdf->Image(public_path() . '/css/images/corevat/blank.gif', 161, 22, 50.0, 50);
				}
			}
		} else {
			$pdf->Image(public_path() . '/css/images/corevat/blank.gif', 161, 22, 50.0, 50);
		}

		$nFont = 6;
		$pdf->SetFillColor(208, 208, 208);
		$pdf->Ln(52);
		$pdf->setX(5);
		$pdf->Cell(50, $nFont, utf8_decode(substr(trim($ft->ftitulo0), 0, 54)), '', 0, 'C', 1);
		$pdf->Cell(28, $nFont, '', '', 0, 'C', 0);
		$pdf->Cell(50, $nFont, utf8_decode(substr(trim($ft->ftitulo1), 0, 54)), '', 0, 'C', 1);
		$pdf->Cell(28, $nFont, '', '', 0, 'C', 0);
		$pdf->Cell(50, $nFont, utf8_decode(substr(trim($ft->ftitulo2), 0, 54)), '', 1, 'C', 1);

		$pdf->Ln(50);
		$pdf->setX(5);

		if ($ft->foto3 != "") {
			$fc = explode('.', $ft->foto3);
			$archivo = public_path() . '/corevat/files/' . $fc[0] . '.' . $fc[1];
			if ( file_exists($archivo) ) {
				$pdf->Image($archivo, 5, 82, 50.0, 50);
			} else {
				$archivo = public_path() . '/corevat/files/' . $fc[0] . '-big.' . $fc[1];
				if ( file_exists($archivo) ) {
					$pdf->Image($archivo, 5, 82, 50.0, 50);
				} else {
					$pdf->Image(public_path() . '/css/images/corevat/blank.gif', 5, 82, 50.0, 50);
				}
			}
		} else {
			$pdf->Image(public_path() . '/css/images/corevat/blank.gif', 5, 82, 50.0, 50);
		}

		if ($ft->foto4 != "") {
			$fc = explode('.', $ft->foto4);
			$archivo = public_path() . '/corevat/files/' . $fc[0] . '.' . $fc[1];
			if ( file_exists($archivo) ) {
				$pdf->Image($archivo, 83, 82, 50.0, 50);
			} else {
				$archivo = public_path() . '/corevat/files/' . $fc[0] . '-big.' . $fc[1];
				if ( file_exists($archivo) ) {
					$pdf->Image($archivo, 83, 82, 50.0, 50);
				} else {
					$pdf->Image(public_path() . '/css/images/corevat/blank.gif', 83, 82, 50.0, 50);
				}
			}
		} else {
			$pdf->Image(public_path() . '/css/images/corevat/blank.gif', 83, 82, 50.0, 50);
		}

		if ($ft->foto5 != "") {
			$fc = explode('.', $ft->foto5);
			$archivo = public_path() . '/corevat/files/' . $fc[0] . '.' . $fc[1];
			if ( file_exists($archivo) ) {
				$pdf->Image($archivo, 161, 82, 50.0, 50);
			} else {
				$archivo = public_path() . '/corevat/files/' . $fc[0] . '-big.' . $fc[1];
				if ( file_exists($archivo) ) {
					$pdf->Image($archivo, 161, 82, 50.0, 50);
				} else {
					$pdf->Image(public_path() . '/css/images/corevat/blank.gif', 161, 82, 50.0, 50);
				}
			}
		} else {
			$pdf->Image(public_path() . '/css/images/corevat/blank.gif', 161, 82, 50.0, 50);
		}

		$pdf->Ln(3);
		$pdf->setX(5);
		$pdf->Cell(50, $nFont, utf8_decode(substr(trim($ft->ftitulo3), 0, 54)), '', 0, 'C', 1);
		$pdf->Cell(28, $nFont, '', '', 0, 'C', 0);
		$pdf->Cell(50, $nFont, utf8_decode(substr(trim($ft->ftitulo4), 0, 54)), '', 0, 'C', 1);
		$pdf->Cell(28, $nFont, '', '', 0, 'C', 0);
		$pdf->Cell(50, $nFont, utf8_decode(substr(trim($ft->ftitulo5), 0, 54)), '', 1, 'C', 1);

		$pdf->Ln(5);
		$pdf->setX(5);
		$nFont = 6;
		$pdf->SetFont('Arial', 'B', 12);
		$pdf->SetFillColor(164, 164, 164);
		$pdf->Cell(206, $nFont, utf8_decode('PLANO'), 'TLBR', 1, 'C', 1);
		$pdf->Ln(2);

		if ($ft->plano0 != "") {
			$fc = explode('.', $ft->plano0);
			$archivo = public_path() . '/corevat/files/' . $fc[0] . '.' . $fc[1];
			if ( file_exists($archivo) ) {
				$pdf->Image($archivo, 5, 150, 206.0, 103);
			} else {
				$archivo = public_path() . '/corevat/files/' . $fc[0] . '-big.' . $fc[1];
				if ( file_exists($archivo) ) {
					$pdf->Image($archivo, 5, 150, 206.0, 103);
				} else {
					$pdf->Image(public_path() . '/corevat/blank.gif', 5, 150, 206.0, 103);
				}
			}
		} else {
			$pdf->Image(public_path() . '/corevat/blank.gif', 5, 150, 206.0, 103);
		}

		$nFont = 6;
		$pdf->SetFillColor(208, 208, 208);
		$pdf->Ln(103);
		$pdf->setX(5);
		$pdf->SetFont('Arial', '', 6);
		$pdf->Cell(206, $nFont, utf8_decode(substr(trim($ft->ptitulo0), 0, 204)), '', 0, 'C', 1);

		$pdf->Output();
		exit;
	}

}
