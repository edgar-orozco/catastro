<?php

class corevat_AvaluosController extends \BaseController {

	protected $avaluo;

	public function __construct(Avaluos $avaluo) {
		$this->avaluo = $avaluo;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($format = 'html') {
		$title = 'COREVAT';
		$title_section = 'Avaluos';
		$row = $this->avaluo;
		$rows = Avaluos::orderBy('idavaluo')->get();
		return View::make('Corevat.Avaluos.index', compact('title', 'rows', 'row'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		$title = 'COREVAT';
		$title_section = 'Avaluos';
		$row = $this->avaluo;
		$row['fecha_reporte'] = date("d/m/Y");
		$row['fecha_avaluo'] = date("d/m/Y");
		$estados = Estados::comboList();
		$municipios = Municipios::comboList();
		$cat_tipo_inmueble = CatTipoInmueble::comboList();
		$cat_regimen_propiedad = CatRegimenPropiedad::comboList();
		$idavaluo = 0;
		return View::make('Corevat.Avaluos.create', compact('title', 'row', 'estados', 'municipios', 'cat_tipo_inmueble', 'cat_regimen_propiedad', 'idavaluo'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store() {
		$inputs = Input::All();
		$rules = array(
			'fecha_reporte' => 'required|date_format:"d/m/Y"',
			'fecha_avaluo' => 'required|date_format:"d/m/Y"',
			'foliocoretemp' => 'required',
			'proposito' => 'required',
			'finalidad' => 'required',
		);
		$validate = Validator::make($inputs, $rules);
		if ($validate->fails()) {
			return Redirect::back()->withInput()->withErrors($validate);
		} else {
			$row = new Avaluos();
			$row->iduser = 1; //Auth::id()
			$row->proposito = $inputs["proposito"];
			$row->finalidad = $inputs["finalidad"];
			$row->idmunicipio = $inputs["idmunicipio"];
			$row->idestado = $inputs["idestado"];
			$row->idestado = $inputs["idestado"];
			$row->fecha_reporte = $inputs["fecha_reporte"];
			$row->fecha_avaluo = $inputs["fecha_avaluo"];
			$row->serie = $inputs["serie"];
			$row->folio = 0;
			$row->foliocoretemp = $inputs["foliocoretemp"];
			$row->idtipoinmueble = $inputs["idtipoinmueble"];
			$row->ubicacion = $inputs["ubicacion"];
			$row->conjunto = $inputs["conjunto"];
			$row->colonia = $inputs["colonia"];
			$row->cp = $inputs["cp"];
			$row->latitud = '';
			$row->lat0 = $inputs["lat0"];
			$row->lat1 = $inputs["lat1"];
			$row->lat2 = $inputs["lat2"];
			$row->longitud = '';
			$row->lon0 = $inputs["lon0"];
			$row->lon1 = $inputs["lon1"];
			$row->lon2 = $inputs["lon2"];
			$row->altitud = $inputs["altitud"];
			$row->idregimenpropiedad = $inputs["idregimenpropiedad"];
			$row->cuenta_predial = $inputs["cuenta_predial"];
			$row->cuenta_catastral = $inputs["cuenta_catastral"];
			$row->nombre_solicitante = $inputs["nombre_solicitante"];
			$row->nombre_propietario = $inputs["nombre_propietario"];
			$row->idemp = 1;
			$row->ip = $_SERVER['REMOTE_ADDR'];
			$row->host = isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : '';
			$row->creado_por = 1;
			$row->creado_el = date('Y-m-d H:i:s');
			$row->save();
			$this->insAvaluoZona($row->idavaluo);
			$this->insAvaluoInmueble($row->idavaluo);
			$this->insAvaluoMercado($row->idavaluo);
			$this->insAvaluoFisico($row->idavaluo);
			$this->insAvaluoConclusiones($row->idavaluo);
			$this->insAvaluoFotos($row->idavaluo);
			return Redirect::to('corevat/Avaluos/create')->with('success', '¡El Avaluo fue creado satisfactoriamente!');
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
		$row->fecha_reporte = date("d/m/Y", strtotime($row->fecha_reporte));
		$row->fecha_avaluo = date("d/m/Y", strtotime($row->fecha_avaluo));
		$title = 'Editando el registro: ' . $row['foliocoretemp'];
		$estados = Estados::comboList();
		$municipios = Municipios::comboList();
		$cat_tipo_inmueble = CatTipoInmueble::comboList();
		$cat_regimen_propiedad = CatRegimenPropiedad::comboList();
		return View::make('Corevat.Avaluos.avaluos', compact('opt', 'idavaluo', 'title', 'row', 'estados', 'municipios', 'cat_tipo_inmueble', 'cat_regimen_propiedad'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function updateGeneral($id) {
		$inputs = Input::All();
		$row = Avaluos::find($id);
		$rules = array(
			'fecha_reporte' => 'required|date_format:"d/m/Y"',
			'fecha_avaluo' => 'required|date_format:"d/m/Y"',
			'foliocoretemp' => 'required',
			'proposito' => 'required',
			'finalidad' => 'required',
		);
		$validate = Validator::make($inputs, $rules);
		if ($validate->fails()) {
			return Redirect::back()->withInput()->withErrors($validate);
		} else {
			$row->iduser = 1; //Auth::id()
			$row->proposito = $inputs["proposito"];
			$row->finalidad = $inputs["finalidad"];
			$row->idmunicipio = $inputs["idmunicipio"];
			$row->idestado = $inputs["idestado"];
			$row->idestado = $inputs["idestado"];
			$row->fecha_reporte = $inputs["fecha_reporte"];
			$row->fecha_avaluo = $inputs["fecha_avaluo"];
			$row->serie = $inputs["serie"];
			$row->folio = 0;
			$row->foliocoretemp = $inputs["foliocoretemp"];
			$row->idtipoinmueble = $inputs["idtipoinmueble"];
			$row->ubicacion = $inputs["ubicacion"];
			$row->conjunto = $inputs["conjunto"];
			$row->colonia = $inputs["colonia"];
			$row->cp = $inputs["cp"];
			$row->latitud = '';
			$row->lat0 = $inputs["lat0"];
			$row->lat1 = $inputs["lat1"];
			$row->lat2 = $inputs["lat2"];
			$row->longitud = '';
			$row->lon0 = $inputs["lon0"];
			$row->lon1 = $inputs["lon1"];
			$row->lon2 = $inputs["lon2"];
			$row->altitud = $inputs["altitud"];
			$row->idregimenpropiedad = $inputs["idregimenpropiedad"];
			$row->cuenta_predial = $inputs["cuenta_predial"];
			$row->cuenta_catastral = $inputs["cuenta_catastral"];
			$row->nombre_solicitante = $inputs["nombre_solicitante"];
			$row->nombre_propietario = $inputs["nombre_propietario"];
			$row->idemp = 1;
			$row->ip = $_SERVER['REMOTE_ADDR'];
			$row->host = isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : '';
			$row->modi_por = 1;
			$row->modi_el = date('Y-m-d H:i:s');

			$row->save();
			return Redirect::to('/corevat/AvaluoGeneral/' . $id)->with('success', '¡La modificación se efectuo correctamente!');
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
		$row = Avaluos::find($id)->AvaluosZona;
		$row->idavaluo = $id;
		$row->is_agua_potable = isset($inputs["is_agua_potable"]) ? 1 : 0;
		$row->is_guarniciones = isset($inputs["is_guarniciones"]) ? 1 : 0;
		$row->is_drenaje = isset($inputs["is_drenaje"]) ? 1 : 0;
		$row->is_banqueta = isset($inputs["is_banqueta"]) ? 1 : 0;
		$row->is_electricidad = isset($inputs["is_electricidad"]) ? 1 : 0;
		$row->is_telefono = isset($inputs["is_telefono"]) ? 1 : 0;
		$row->is_pavimentacion = isset($inputs["is_pavimentacion"]) ? 1 : 0;
		$row->is_transporte_publico = isset($inputs["is_transporte_publico"]) ? 1 : 0;
		$row->is_alumbrado_publico = isset($inputs["is_alumbrado_publico"]) ? 1 : 0;
		$row->is_otro_servicio = isset($inputs["is_otro_servicio"]) ? 1 : 0;
		$row->otro_servicio_municipal = isset($inputs["otro_servicio_municipal"]) ? $inputs["otro_servicio_municipal"] : '';
		$row->is_escuela = isset($inputs["is_escuela"]) ? 1 : 0;
		$row->is_iglesia = isset($inputs["is_iglesia"]) ? 1 : 0;
		$row->is_banco = isset($inputs["is_banco"]) ? 1 : 0;
		$row->is_comercio = isset($inputs["is_comercio"]) ? 1 : 0;
		$row->is_hospital = isset($inputs["is_hospital"]) ? 1 : 0;
		$row->is_parque = isset($inputs["is_parque"]) ? 1 : 0;
		$row->is_transporte = isset($inputs["is_transporte"]) ? 1 : 0;
		$row->is_gasolinera = isset($inputs["is_gasolinera"]) ? 1 : 0;
		$row->is_mercado = isset($inputs["is_mercado"]) ? 1 : 0;
		$row->is_otro_equipamiento = isset($inputs["is_otro_equipamiento"]) ? 1 : 0;
		$row->cobertura = $inputs["cobertura"];
		$row->otro_equipamiento = isset($inputs["otro_equipamiento"]) ? $inputs["otro_equipamiento"] : '';
		$row->nivel_equipamiento = $inputs["nivel_equipamiento"];
		$row->idclasificacionzona = $inputs["idclasificacionzona"];
		$row->idproximidadurbana = $inputs["idproximidadurbana"];
		$row->construc_predominante = $inputs["construc_predominante"];
		$row->vias_acceso_importante = $inputs["vias_acceso_importante"];
		$row->ip = $_SERVER['REMOTE_ADDR'];
		$row->host = isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : '';
		$row->modi_por = 1;
		$row->modi_el = date('Y-m-d H:i:s');
		$row->save();
		return Redirect::to('/corevat/AvaluoZona/' . $id)->with('success', '¡La modificación se efectuo correctamente!');
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
		$title = '3 Características del Inmueble: ' . $row['foliocoretemp'];
		$row = Avaluos::find($id)->AvaluosInmueble;
		if ( count($row) <= 0 ) {
			$this->insAvaluoInmueble($id);
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
		//
		$cat_pisos = CatPisos::comboList();
		$cat_aplanados = CatAplanados::comboList();
		$cat_plafones = CatPlafones::comboList();
		$cat_orientaciones = CatOrientaciones::comboList();
		$ai_medidas_colindancias = AiMedidasColindancias::AiMedidasColindanciasByFk($row->idavaluoinmueble);
		//return $row->idavaluoinmueble;
		return View::make('Corevat.Avaluos.avaluos', compact('opt', 'idavaluo', 'title', 'row', 'cat_cimentaciones', 'cat_estructuras', 'cat_muros', 'cat_entrepisos', 'cat_techos', 'cat_bardas', 'cat_usos_suelos', 'cat_niveles', 'cat_pisos', 'cat_aplanados', 'cat_plafones', 'cat_orientaciones', 'ai_medidas_colindancias'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function updateInmueble($id) {
		$inputs = Input::All();
		$rules = array(
			'unidades_rentables_escritura' => 'min:0',
			'superficie_total_terreno' => 'numeric',
			'indiviso_terreno' => 'numeric',
			'superficie_terreno' => 'numeric',
			'indiviso_areas_comunes' => 'numeric',
			'superficie_construccion' => 'numeric',
			'indiviso_accesoria' => 'numeric',
			'superficie_escritura' => 'numeric',
			'superficie_vendible' => 'numeric',
		);
		$validate = Validator::make($inputs, $rules);
		if ($validate->fails()) {
			return Redirect::back()->withInput()->withErrors($validate);
		} else {
			$row = Avaluos::find($id)->AvaluosInmueble;
			$row->idavaluo = $id;
			$row->croquis = '';
			$row->fachada = '';
			$row->medidas_colindancias = '';
			$row->idusossuelo = $inputs["idusossuelo"];
			$row->servidumbre_restricciones = $inputs["servidumbre_restricciones"];
			$row->descripcion_inmueble = $inputs["descripcion_inmueble"];
			$row->numero_niveles_unidad = $inputs["numero_niveles_unidad"];

			$row->unidades_rentables_escritura = (int) $inputs["unidades_rentables_escritura"];

			$row->cimentacion = $row->estructura = $row->muros = $row->entrepisos = $row->techos = $row->bardas = '';
			$row->id_cimentacion = $inputs["id_cimentacion"];
			$row->id_estructura = $inputs["id_estructura"];
			$row->id_muro = $inputs["id_muro"];
			$row->id_entrepiso = $inputs["id_entrepiso"];
			$row->id_techo = $inputs["id_techo"];
			$row->id_barda = $inputs["id_barda"];

			$row->recamaras0 = $row->recamaras1 = $row->recamaras2 = '';
			$row->id_recamara0 = $inputs["id_recamara0"];
			$row->id_recamara1 = $inputs["id_recamara1"];
			$row->id_recamara2 = $inputs["id_recamara2"];

			$row->estancia_comedor0 = $row->estancia_comedor1 = $row->estancia_comedor2 = '';
			$row->id_estancia_comedor0 = $inputs["id_estancia_comedor0"];
			$row->id_estancia_comedor1 = $inputs["id_estancia_comedor1"];
			$row->id_estancia_comedor2 = $inputs["id_estancia_comedor2"];

			$row->banos0 = $row->banos1 = $row->banos2 = '';
			$row->id_bano0 = $inputs["id_bano0"];
			$row->id_bano1 = $inputs["id_bano1"];
			$row->id_bano2 = $inputs["id_bano2"];

			$row->escaleras0 = $row->escaleras1 = $row->escaleras2 = '';
			$row->id_escalera0 = $inputs["id_escalera0"];
			$row->id_escalera1 = $inputs["id_escalera1"];
			$row->id_escalera2 = $inputs["id_escalera2"];

			$row->cocina0 = $row->cocina1 = $row->cocina2 = '';
			$row->id_cocina0 = $inputs["id_cocina0"];
			$row->id_cocina1 = $inputs["id_cocina1"];
			$row->id_cocina2 = $inputs["id_cocina2"];

			$row->patio_servicio0 = $row->patio_servicio1 = $row->patio_servicio2 = '';
			$row->id_patio_servicio0 = $inputs["id_patio_servicio0"];
			$row->id_patio_servicio1 = $inputs["id_patio_servicio1"];
			$row->id_patio_servicio2 = $inputs["id_patio_servicio2"];

			$row->estacionamiento0 = $row->estacionamiento1 = $row->estacionamiento2 = '';
			$row->id_estacionamiento0 = $inputs["id_estacionamiento0"];
			$row->id_estacionamiento1 = $inputs["id_estacionamiento1"];
			$row->id_estacionamiento2 = $inputs["id_estacionamiento2"];

			$row->fachada0 = $row->fachada1 = $row->fachada2 = '';
			$row->id_fachada0 = $inputs["id_fachada0"];
			$row->id_fachada1 = $inputs["id_fachada1"];
			$row->id_fachada2 = $inputs["id_fachada2"];

			$row->hidraulico_sanitarias = $inputs["hidraulico_sanitarias"];
			$row->electricas = $inputs["electricas"];
			$row->carpinteria = $inputs["carpinteria"];
			$row->herreria = $inputs["herreria"];

			$row->superficie_total_terreno = $inputs["superficie_total_terreno"];
			$row->indiviso_terreno = $inputs["indiviso_terreno"];
			$row->superficie_terreno = $inputs["superficie_terreno"];
			$row->indiviso_areas_comunes = $inputs["indiviso_areas_comunes"];
			$row->superficie_construccion = $inputs["superficie_construccion"];
			$row->indiviso_accesoria = $inputs["indiviso_accesoria"];
			$row->superficie_escritura = $inputs["superficie_escritura"];
			$row->superficie_vendible = $inputs["superficie_vendible"];

			$row->ip = $_SERVER['REMOTE_ADDR'];
			$row->host = isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : '';
			$row->modi_por = 1;
			$row->modi_el = date('Y-m-d H:i:s');
			$row->save();
			if ( $inputs["ctrl"] == 'ins' ) {
				$message = '¡El registro fue ingresado satisfactoriamente!';
			} else {
				$message = '¡El registro fue modificado satisfactoriamente!';
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
		$row = Avaluos::find($id);
		$title = 'Enfoque de Mercado: ' . $row['foliocoretemp'];
		$row = Avaluos::find($id)->AvaluosMercado;
		if ( count($row) <= 0 ) {
			$this->insAvaluoMercado($id);
			$row = Avaluos::find($id)->AvaluosMercado;
		}
		$aem_comp_terrenos = AemCompTerrenos::AemCompTerrenosByFk($row->idavaluoenfoquemercado);
		$aem_homologacion = AemCompTerrenos::AemHomologacionByFk($row->idavaluoenfoquemercado);
		$aem_informacion = AemInformacion::AemInformacionByFk($row->idavaluoenfoquemercado);
		$aem_analisis = AemInformacion::AemAnalisisByFk($row->idavaluoenfoquemercado);
		$cat_factores_zonas = CatFactoresZonas::getCatFactoresZonasComboList();
		$cat_factores_ubicacion = CatFactoresUbicacion::getCatFactoresUbicacionComboList();
		$cat_factores_frente = CatFactoresFrente::getCatFactoresFrenteComboList();
		$cat_factores_forma = CatFactoresForma::getCatFactoresFormaComboList();
		return View::make('Corevat.Avaluos.avaluos', compact('opt', 'idavaluo', 'title', 'row', 'aem_comp_terrenos', 
				'aem_homologacion', 'aem_informacion', 'aem_analisis', 'cat_factores_zonas', 'cat_factores_ubicacion', 
				'cat_factores_frente', 'cat_factores_forma'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function updateMercado() {
		$inputs = Input::All();
		if ( $inputs['ctrl'] == 'btnNewAemComp' || $inputs['ctrl'] == 'btnEditAemComp' ) {
			$response = $this->setAemCompTerrenos($inputs);
			
		} else if ( $inputs['ctrl'] == 'btnEditAemHom' ) {
			$response = $this->setAemHomologacion($inputs);

		} else if ( $inputs['ctrl'] == 'btnNewAemInf' || $inputs['ctrl'] == 'btnEditAemInf' ) {
			$response = $this->setAemInformacion($inputs);

		} else if ( $inputs['ctrl'] == 'btnEditAemAna' ) {
			$response = $this->setAemAnalisis($inputs);

		}
		
		return $response;
	}

/*
ALTER TABLE avaluo_zona DROP CONSTRAINT IF EXISTS avaluo_zona_id_avaluo_foreign;
ALTER TABLE avaluo_zona ADD CONSTRAINT avaluo_zona_id_avaluo_foreign FOREIGN KEY(idavaluo) REFERENCES avaluos(idavaluo) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE avaluo_inmueble DROP CONSTRAINT IF EXISTS avaluo_inmueble_id_barda_foreign;
ALTER TABLE avaluo_inmueble ADD CONSTRAINT avaluo_inmueble_id_barda_foreign FOREIGN KEY(idavaluo) REFERENCES avaluos(idavaluo) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE ai_medidas_colindancias DROP CONSTRAINT IF EXISTS ai_medidas_colindancias_idavaluoinmueble_foreign;
ALTER TABLE ai_medidas_colindancias ADD CONSTRAINT ai_medidas_colindancias_idavaluoinmueble_foreign FOREIGN KEY(idavaluo) REFERENCES avaluos(idavaluo) ON DELETE CASCADE ON UPDATE CASCADE;



ALTER TABLE avaluo_enfoque_mercado DROP CONSTRAINT IF EXISTS avaluo_enfoque_mercado_idavaluo_foreign;
ALTER TABLE avaluo_enfoque_mercado ADD CONSTRAINT avaluo_enfoque_mercado_idavaluo_foreign FOREIGN KEY(idavaluo) REFERENCES avaluos(idavaluo) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE avaluo_enfoque_fisico DROP CONSTRAINT IF EXISTS avaluo_enfoque_fisico_idavaluo_foreign;
ALTER TABLE avaluo_enfoque_fisico ADD CONSTRAINT avaluo_enfoque_fisico_idavaluo_foreign FOREIGN KEY(idavaluo) REFERENCES avaluos(idavaluo) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE avaluo_conclusiones DROP CONSTRAINT IF EXISTS avaluo_conclusiones_idavaluo_foreign;
ALTER TABLE avaluo_conclusiones ADD CONSTRAINT avaluo_conclusiones_idavaluo_foreign FOREIGN KEY(idavaluo) REFERENCES avaluos(idavaluo) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE avaluo_fotos_planos DROP CONSTRAINT IF EXISTS avaluo_fotos_planos_idavaluo_foreign;
ALTER TABLE avaluo_fotos_planos ADD CONSTRAINT avaluo_fotos_planos_idavaluo_foreign FOREIGN KEY(idavaluo) REFERENCES avaluos(idavaluo) ON DELETE CASCADE ON UPDATE CASCADE;

*/



	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function editFisico($id) {
		$idavaluo = $id;
		$opt = 'fisico';
		$row = Avaluos::find($id);
		$title = 'Enfoque de Físico: ' . $row['foliocoretemp'];
		$row = Avaluos::find($id)->AvaluosFisico;
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
		$cat_factores_frente = CatFactoresFrente::getCatFactoresFrenteComboList();
		$cat_factores_forma = CatFactoresForma::getCatFactoresFormaComboList();
		$cat_factores_conservacion = CatFactoresConservacion::getCatFactoresConservacionComboList();
		$cat_obras_complementarias = CatObrasComplementarias::comboList();
		return View::make('Corevat.Avaluos.avaluos', compact('opt', 'idavaluo', 'title', 'row', 'aef_terrenos', 
				'aef_construcciones', 'aef_condominios', 'aef_comp_construcciones', 'aef_instalaciones', 
				'cat_clase_general_inmueble', 'cat_tipo_inmueble', 'cat_estado_conservacion', 'cat_calidad_proyecto', 
				'cat_tipo', 'cat_factores_frente', 'cat_factores_forma', 'cat_factores_conservacion', 'cat_obras_complementarias'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function updateFisico() {
		$inputs = Input::All();
		if ( $inputs['ctrl'] == 'btnNewAefTerreno' || $inputs['ctrl'] == 'btnEditAefTerreno' ) {
			$response = $this->setAefTerrenos($inputs);

		} else if ( $inputs['ctrl'] == 'btnNewAefInstalaciones' || $inputs['ctrl'] == 'btnEditAefInstalaciones' ) {
			$response = $this->setAefInstalaciones($inputs);

		} else if ( $inputs['ctrl'] == 'btnNewAefConstrucciones' || $inputs['ctrl'] == 'btnEditAefConstrucciones' ) {
			$response = $this->setAefConstrucciones($inputs);

		} else if ( $inputs['ctrl'] == 'btnNewAefCondominios' || $inputs['ctrl'] == 'btnEditAefCondominios' ) {
			$response = $this->setAefCondominios($inputs);

		} else if ( $inputs['ctrl'] == 'btnNewAefCompConstrucciones' || $inputs['ctrl'] == 'btnEditAefCompConstrucciones' ) {
			$response = $this->setAefCompConstrucciones($inputs);

		}
		
		return $response;
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

		return View::make('Corevat.Avaluos.avaluos', compact('opt', 'idavaluo', 'title', 'row'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function updateConclusiones($id) {
		
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function updateFotos($id) {
		
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $idavaluo
	 * @return Response
	 */
	private function insAvaluoZona($idavaluo) {
		$row = new AvaluosZona();
		$row->idavaluo = $idavaluo;
		$row->is_agua_potable = 0;
		$row->is_guarniciones = 0;
		$row->is_drenaje = 0;
		$row->is_banqueta = 0;
		$row->is_electricidad = 0;
		$row->is_telefono = 0;
		$row->is_pavimentacion = 0;
		$row->is_transporte_publico = 0;
		$row->is_alumbrado_publico = 0;
		$row->is_otro_servicio = 0;
		$row->otro_servicio_municipal = '';
		$row->is_escuela = 0;
		$row->is_iglesia = 0;
		$row->is_banco = 0;
		$row->is_comercio = 0;
		$row->is_hospital = 0;
		$row->is_parque = 0;
		$row->is_transporte = 0;
		$row->is_gasolinera = 0;
		$row->is_mercado = 0;
		$row->is_otro_equipamiento = 0;
		$row->cobertura = '';
		$row->otro_equipamiento = '';
		$row->nivel_equipamiento = 0;
		$row->idclasificacionzona = 1;
		$row->idproximidadurbana = 1;
		$row->construc_predominante = '';
		$row->vias_acceso_importante = '';
		$row->ip = $_SERVER['REMOTE_ADDR'];
		$row->host = isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : '';
		$row->creado_por = 1;
		$row->creado_el = date('Y-m-d H:i:s');
		$row->save();
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function insAvaluoInmueble($idavaluo) {
		$row = new AvaluosInmueble();
		$row->idavaluo = $idavaluo;
		$row->croquis = '';
		$row->fachada = '';
		$row->medidas_colindancias = '';
		$row->idusossuelo = 12;
		$row->servidumbre_restricciones = '';
		$row->descripcion_inmueble = '';
		$row->numero_niveles_unidad = 1;

		$row->unidades_rentables_escritura = 0;

		$row->cimentacion = $row->estructura = $row->muros = $row->entrepisos = $row->techos = $row->bardas = '';
		$row->id_cimentacion = 24;
		$row->id_estructura = 28;
		$row->id_muro = 30;
		$row->id_entrepiso = 8;
		$row->id_techo = 45;
		$row->id_barda = 9;

		$row->recamaras0 = $row->recamaras1 = $row->recamaras2 = '';
		$row->estancia_comedor0 = $row->estancia_comedor1 = $row->estancia_comedor2 = '';
		$row->banos0 = $row->banos1 = $row->banos2 = '';
		$row->escaleras0 = $row->escaleras1 = $row->escaleras2 = '';
		$row->cocina0 = $row->cocina1 = $row->cocina2 = '';
		$row->patio_servicio0 = $row->patio_servicio1 = $row->patio_servicio2 = '';
		$row->estacionamiento0 = $row->estacionamiento1 = $row->estacionamiento2 = '';
		$row->fachada0 = $row->fachada1 = $row->fachada2 = '';
		$row->id_recamara0 = $row->id_estancia_comedor0 = $row->id_bano0 = $row->id_escalera0 = $row->id_cocina0 = $row->id_patio_servicio0 = $row->id_estacionamiento0 = $row->id_fachada0 = 53;
		$row->id_recamara1 = $row->id_estancia_comedor1 = $row->id_bano1 = $row->id_escalera1 = $row->id_cocina1 = $row->id_patio_servicio1 = $row->id_estacionamiento1 = $row->id_fachada1 = 15;
		$row->id_recamara2 = $row->id_estancia_comedor2 = $row->id_bano2 = $row->id_escalera2 = $row->id_cocina2 = $row->id_patio_servicio2 = $row->id_estacionamiento2 = $row->id_fachada2 = 22;

		$row->hidraulico_sanitarias = '';
		$row->electricas = '';
		$row->carpinteria = '';
		$row->herreria = '';

		$row->superficie_total_terreno = $row->indiviso_terreno = $row->superficie_terreno = $row->indiviso_areas_comunes = $row->superficie_construccion = $row->indiviso_accesoria = $row->superficie_escritura = $row->superficie_vendible = 0.0000;

		$row->ip = $_SERVER['REMOTE_ADDR'];
		$row->host = isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : '';
		$row->creado_por = 1;
		$row->creado_el = date('Y-m-d H:i:s');
		$row->save();
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function insAvaluoMercado($idavaluo) {
		$row = new AvaluosMercado();
		$row->idavaluo = $idavaluo;
		$row->promedio_directo = $row->valor_unitario_promedio = $row->valor_aplicado_m2 = $row->minimo_directo = 0.00;
		$row->maximo_directo = $row->promedio_analisis = $row->minimo_analisis = $row->maximo_analisis = 0.00;
		$row->monto_unitario_aplicable = $row->superficie_construida = $row->valor_comparativo_mercado = 0.00;
		$row->superfice_terreno_avaluo = $row->superficie_construccion_avaluo = $row->promedio_unitario = 0.00;
		$row->superficie_terreno = 0.0000;
		$row->ip = $_SERVER['REMOTE_ADDR'];
		$row->host = isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : '';
		$row->creado_por = 1;
		$row->creado_el = date('Y-m-d H:i:s');
		$row->save();
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function insAvaluoFisico($idavaluo) {
		$row = new AvaluosFisico();
		$row->idavaluo = $idavaluo;
		$row->tipo_moda = $row->valor_unitario_promedio = $row->valor_aplicado_m2 = $row->valor_terreno = $row->total_metros_construccion = $row->valor_construccion = $row->subtotal_area_condominio = $row->subtotal_instalaciones_especiales = $row->total_valor_fisico = 0.00;
		$row->conclusion_investigacion_comparables = $row->conclusion_investigacion_terreno = $row->conclusion_investigacion_construccion = '';
		$row->idclasegeneral = 1;
		$row->idtipoinmueble = 1;
		$row->idestado_conservacion = 1;
		$row->idcalidadproyecto = 1;
		$row->edad_construccion = $row->vida_util = $row->numero_niveles = $row->nivel_edificio_condominio = 0;
		$row->ip = $_SERVER['REMOTE_ADDR'];
		$row->host = isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : '';
		$row->creado_por = 1;
		$row->creado_el = date('Y-m-d H:i:s');
		$row->save();
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	private function insAvaluoConclusiones($idavaluo) {
		$row = new AvaluosConclusiones();
		$row->idavaluo = $idavaluo;
		$row->valor_fisico = $row->valor_mercado = $row->valor_concluido = 0.00;
		$row->leyenda = $row->sello = $row->firma = '';
		$row->factor_seleccion_valor = 0;
		$row->idemp = 1;
		$row->ip = $_SERVER['REMOTE_ADDR'];
		$row->host = isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : '';
		$row->creado_por = 1;
		$row->creado_el = date('Y-m-d H:i:s');
		$row->save();
	}
	
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function insAvaluoFotos($idavaluo) {
		$row = new AvaluosFotos();
		$row->idavaluo = $idavaluo;
		$row->foto0 = $row->foto1 = $row->foto2 = $row->foto3 = $row->foto4 = $row->foto5 = $row->foto6 = $row->foto7 = $row->foto8 = $row->foto9 = '';
		$row->plano0 = $row->plano1 = $row->plano2 = $row->plano3 = $row->plano4 = '';
		$row->ftitulo0 = $row->ftitulo1 = $row->ftitulo2 = $row->ftitulo3 = $row->ftitulo4 = $row->ftitulo5 = $row->ftitulo6 = $row->ftitulo7 = $row->ftitulo8 = $row->ftitulo9 = '';
		$row->ptitulo0 = $row->ptitulo1 = $row->ptitulo2 = $row->ptitulo3 = $row->ptitulo4 = '';
		$row->idemp = 1;
		$row->ip = $_SERVER['REMOTE_ADDR'];
		$row->host = isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : '';
		$row->creado_por = 1;
		$row->creado_el = date('Y-m-d H:i:s');
		$row->save();
	}

	private function insAemHomologacion($idavaluoenfoquemercado, $idaemcompterreno, $ubicacion, $superficie_terreno, $precio_unitario_m2_terreno) {
		$row = new AemHomologacion();
		$row->idavaluoenfoquemercado = $idavaluoenfoquemercado;
		$row->idaemcompterreno = $idaemcompterreno;
		$row->comparable = $ubicacion;
		$row->superficie_terreno = $superficie_terreno;
		$row->superficie_construccion = $row->zona = $row->valor_unitario_resultante_m2 = 
				$row->ubicacion = $row->frente = $row->forma = $row->superficie = $row->valor_unitario_negociable = 0.00;
		$row->valor_unitario = $precio_unitario_m2_terreno;;
		$row->in_promedio = 0;
		$row->idemp = 1;
		$row->ip = $_SERVER['REMOTE_ADDR'];
		$row->host = isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : '';
		$row->creado_por = 1;
		$row->creado_el = date('Y-m-d H:i:s');
		$row->save();
	}

	private function insAemAnalisis($idavaluoenfoquemercado, $idaeminformacion) {
		$row = new AemHomologacion();
		$row->idavaluoenfoquemercado = $idavaluoenfoquemercado;
		$row->idaeminformacion = $idaeminformacion;
		$row->precio_venta = $row->superficie_terreno = $row->superficie_construccion = $row->valor_unitario_m2 = 
				$row->factor_zona = $row->factor_ubicacion = $row->factor_superficie = $row->factor_edad = $row->factor_conservacion = 
				$row->factor_negociacion = $row->factor_resultante = $row->valor_unitario_resultante_m2 =0.00;
		$row->in_promedio = 1;
		
		$row->idemp = 1;
		$row->ip = $_SERVER['REMOTE_ADDR'];
		$row->host = isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : '';
		$row->creado_por = 1;
		$row->creado_el = date('Y-m-d H:i:s');
		$row->save();
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function setAiMedidasColindancias() {
		$response = array();
		$response['success'] = FALSE;
		$response['obj'] = '';
		$response['idaimedidacolindancia'] = '';

		$inputs = Input::All();
		$rules = array(
			'medida' => 'required',
			'colindancia' => 'required',
		);
		$messages = array(
			'required' => 'El campo es requerido',
		);
		$validate = Validator::make($inputs, $rules, $messages);
		if ($validate->fails()) {
			return Response::json(array(
			    'success' => false,
			    'errors' => $validate->getMessageBag()->toArray()
			)); 
		} else {
			if ( $inputs['ctrl'] == 'ins') {
				$row = new AiMedidasColindancias();
				$row->idavaluoinmueble = $inputs['idavaluoinmueble2'];
				$row->idorientacion = $inputs['idorientacion'];
				$row->medida = $inputs['medida'];
				$row->colindancia = $inputs['colindancia'];
				$row->idemp = 1;
				$row->ip = $_SERVER['REMOTE_ADDR'];
				$row->host = isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : '';
				$row->creado_por = 1;
				$row->creado_el = date('Y-m-d H:i:s');
				$row->save();
				return Response::json(array('success' => true));
			} else {
				$row = AiMedidasColindancias::find($inputs['idaimedidacolindancia']);
				$row->idorientacion = $inputs['idorientacion'];
				$row->medida = $inputs['medida'];
				$row->colindancia = $inputs['colindancia'];
				$row->ip = $_SERVER['REMOTE_ADDR'];
				$row->host = isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : '';
				$row->modi_por = 1;
				$row->modi_el = date('Y-m-d H:i:s');
				$row->save();
				return Response::json(array('success' => true));
			}
		}
	}

	/*
	 * 
	 */
	private function setAemCompTerrenos($inputs) {
		$rules = array(
			'ubicacion' => 'required',
			'precio' => array('required', 'numeric'),
			'superficie_terreno' => array('required', 'numeric'),
			'observaciones' => 'required',
		);
		$messages = array(
			'ubicacion.required' => '¡El campo "Ubicación" es obligatorio!',
			'precio.required' => '¡El campo "Precio" es obligatorio!',
			'precio.numeric' => '¡El valor del campo "Precio" debe ser numerico!',
			'superficie_terreno.required' => '¡El campo "Superficie del Terreno" es obligado!',
			'superficie_terreno.numeric' => '¡El valor del campo "Superficie del Terreno" debe ser numerico!',
			'observaciones.required' => '¡El campo "Observaciones" es requerido!',
		);
		$validate = Validator::make($inputs, $rules, $messages);
		if ($validate->fails()) {
			$response = array('success' => false, 'errors' => $validate->getMessageBag()->toArray());
		} else {
			if ( $inputs['ctrl'] == 'btnNewAemComp') {
				$row = new AemCompTerrenos();
				$row->idavaluoenfoquemercado = $inputs['idAem'];
				$row->ubicacion = $inputs['ubicacion'];
				$row->precio = $inputs['precio'];
				$row->superficie_terreno = $inputs['superficie_terreno'];
				$row->superficie_construida = 0.00;
				$precio = (float) $inputs['precio'];
				$superficie_terreno = (float) $inputs['superficie_terreno'];
				$row->precio_unitario_m2_terreno = ( (float) $inputs['superficie_terreno'] <= 0 ? 0.00 : ($precio/$superficie_terreno) );
				$row->precio_unitario_m2_construccion = 0.00;
				$row->observaciones = $inputs['observaciones'];
				$row->idemp = 1;
				$row->ip = $_SERVER['REMOTE_ADDR'];
				$row->host = isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : '';
				$row->creado_por = 1;
				$row->creado_el = date('Y-m-d H:i:s');
				$row->save();
				$this->insAemHomologacion($inputs['idAem'], $row->idaemcompterreno, $row->ubicacion, $row->superficie_terreno, $row->precio_unitario_m2_terreno);
				$response = array('success' => true, 'message' => '¡El registro fue ingresado satisfactoriamente!', 'idTable' => $row->idaemcompterreno);
			} else {
				$row = AemCompTerrenos::find($inputs['idTable']);
				$row->ubicacion = $inputs['ubicacion'];
				$row->precio = $inputs['precio'];
				$row->superficie_terreno = $inputs['superficie_terreno'];
				$precio = (float) $inputs['precio'];
				$superficie_terreno = (float) $inputs['superficie_terreno'];
				$row->precio_unitario_m2_terreno = ( (float) $inputs['superficie_terreno'] <= 0 ? 0.00 : ($precio/$superficie_terreno) );
				$row->observaciones = $inputs['observaciones'];
				$row->ip = $_SERVER['REMOTE_ADDR'];
				$row->host = isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : '';
				$row->modi_por = 1;
				$row->modi_el = date('Y-m-d H:i:s');
				$row->save();
				$row2 = AemCompTerrenos::find($inputs['idTable'])->AemHomologacion;
				$row2->comparable = $inputs['ubicacion'];
				$row2->superficie_terreno = $inputs['superficie_terreno'];
				$row2->valor_unitario = $row->precio_unitario_m2_terreno;;
				$row2->ip = $_SERVER['REMOTE_ADDR'];
				$row2->host = isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : '';
				$row2->modi_por = 1;
				$row2->modi_el = date('Y-m-d H:i:s');
				$row2->save();
				$response = array('success' => true, 'message' => '¡El registro fue modificado satisfactoriamente!' . $row2->comparable);
			}
		}
		return $response;
	}
	
	/*
	 * 
	 */
	private function setAemHomologacion($inputs) {
		$response = array('success' => false, 'errors' => array('PENDIENTE'));
		return $response;
	}

	/*
	 * 
	 */
	private function setAemInformacion($inputs) {
		$response = array('success' => false, 'errors' => array('PENDIENTE'));
		return $response;
	}

	/*
	 * 
	 */
	private function setAemAnalisis($inputs) {
		$response = array('success' => false, 'errors' => array('PENDIENTE'));
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
		$response = array('success' => false, 'errors' => array('PENDIENTE'));
		return $response;
	}

	/*
	 * 
	 */
	private function setAefInstalaciones($inputs) {
		$response = array('success' => false, 'errors' => array('PENDIENTE'));
		return $response;
	}

	/*
	 * 
	 */
	private function setAefConstrucciones($inputs) {
		$response = array('success' => false, 'errors' => array('PENDIENTE'));
		return $response;
	}

	/*
	 * 
	 */
	private function setAefCondominios($inputs) {
		$response = array('success' => false, 'errors' => array('PENDIENTE'));
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
		return AemHomologacion::find($id);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getAemInformación($id) {
		return AemInformacion::find($id);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getAemAnalisis($id) {
		return AemAnalisis::find($id);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getAeiTerrenos($id) {
		return AefTerrenos::find($id);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getAefCompConstrucciones($id) {
		return AefCompConstrucciones::find($id);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getAefConstrucciones($id) {
		return AefConstrucciones::find($id);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getAefCondominios($id) {
		return AefCondominios::find($id);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getAefInstalaciones($id) {
		return AefInstalaciones::find($id);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function delAvaluo($id) {
		//$row = AemHomologacion::delByFk($id);
		//$row->delete($id);
		//$row = AemCompTerrenos::findOrFail($id);
		//$row->delete($id);
		return Response::json(array('success' => true, 'message' => '!El registro fue eliminado satisfactoriamente!'));
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
		if ( $inputs['ctrlDel'] == 'btnDelAemComp' ) {
			$response = $this->delAemCompTerrenos($inputs['idTableDel']);
			
		} else if ( $inputs['ctrlDel'] == 'btnDelAemInf' ) {
			$response = $this->delAemInformcion($inputs['idTableDel']);

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
        $row = AemCompTerrenos::findOrFail($id)->AemHomologacion;
		if ( count($row) > 0 ) {
			$row->delete();
		}
        $row = AemCompTerrenos::findOrFail($id);
		if ( count($row) > 0 ) {
			$row->delete();
		} else {
			$response->success = false;
			$response->error = 'Error';
		}
		return $response;
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	private function delAemInformacion($id) {
        $row = AemAnalisis::delByFk($id);
        $row->delete($id);
        $row = AemInformacion::findOrFail($id);
        $row->delete($id);
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
		if ( $inputs['ctrlDel'] == 'btnDelAefTerreno' ) {
			$response = $this->delAefTerrenos($inputs['idTableDel']);

		} else if ( $inputs['ctrlDel'] == 'btnDelAefInstalaciones' ) {
			$response = $this->delAefInstalaciones($inputs['idTableDel']);

		} else if ( $inputs['ctrlDel'] == 'btnDelAefConstrucciones' ) {
			$response = $this->delAefConstrucciones($inputs['idTableDel']);

		} else if ( $inputs['ctrlDel'] == 'btnDelAefCondominios' ) {
			$response = $this->delAefCondominios($inputs['idTableDel']);

		} else if ( $inputs['ctrlDel'] == 'btnDelAefCompConstrucciones' ) {
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
        $row->delete($id);
		return Response::json(array('success' => true, 'message' => '!El registro fue eliminado satisfactoriamente!'));
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function delAefConstrucciones($id) {
        $row = AefConstrucciones::findOrFail($id);
        $row->delete($id);
		return Response::json(array('success' => true, 'message' => '!El registro fue eliminado satisfactoriamente!'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function delAefInstalaciones($id) {
        $row = AefInstalaciones::findOrFail($id);
        $row->delete($id);
		return Response::json(array('success' => true, 'message' => '!El registro fue eliminado satisfactoriamente!'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function delAefTerrenos($id) {
        $row = AefTerrenos::findOrFail($id);
        $row->delete($id);
		return Response::json(array('success' => true, 'message' => '!El registro fue eliminado satisfactoriamente!'));
	}

}
