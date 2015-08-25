<?php

class AvaluosInmueble extends \Eloquent {

	protected $connection = 'corevat';
	protected $fillable = [];
	protected $table = 'avaluo_inmueble';
	protected $primaryKey = 'idavaluoinmueble';
	public $timestamps = false;

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function AiMedidasColindancias() {
		return $this->hasOne('AiMedidasColindancias', 'idavaluoinmueble', 'idavaluoinmueble');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getAvaluosInmuebleByFk($fk) {
		return AvaluosInmueble::select('avaluo_inmueble.*', 'cat_usos_suelos.usos_suelos', 'cat_niveles.nivel', 'cat_cimentaciones.cimentacion', 'cat_estructuras.estructura', 'cat_muros.muro', 'cat_entrepisos.entrepiso', 'cat_techos.techo', 'cat_bardas.barda')
						->leftJoin('avaluos', 'avaluo_inmueble.idavaluo', '=', 'avaluos.idavaluo')
						->leftJoin('cat_usos_suelos', 'avaluo_inmueble.idusossuelo', '=', 'cat_usos_suelos.idusossuelos')
						->leftJoin('cat_niveles', 'avaluo_inmueble.numero_niveles_unidad', '=', 'cat_niveles.idnivel')
						->leftJoin('cat_cimentaciones', 'avaluo_inmueble.id_cimentacion', '=', 'cat_cimentaciones.idcimentacion')
						->leftJoin('cat_estructuras', 'avaluo_inmueble.id_estructura', '=', 'cat_estructuras.idestructura')
						->leftJoin('cat_muros', 'avaluo_inmueble.id_muro', '=', 'cat_muros.idmuro')
						->leftJoin('cat_entrepisos', 'avaluo_inmueble.id_entrepiso', '=', 'cat_entrepisos.identrepiso')
						->leftJoin('cat_techos', 'avaluo_inmueble.id_techo', '=', 'cat_techos.idtecho')
						->leftJoin('cat_bardas', 'avaluo_inmueble.id_barda', '=', 'cat_bardas.idbarda')
						->where('avaluo_inmueble.idavaluo', '=', $fk)
						->orderBy('avaluo_inmueble.idavaluoinmueble')
						->get();
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $idavaluo
	 * @return Response
	 */
	public static function getAvaluoInmuebleByIdForPdf($idavaluo) {
		return AvaluosInmueble::select('avaluo_inmueble.*', 
				'ct_niv.nivel AS nivel', 
				'cim.cimentacion', 
				'estruc.estructura', 
				'mur.muro AS muros', 
				'entrepi.entrepiso AS entrepisos', 
				'tech.techo AS techos', 
				'brd.barda AS bardas', 
				
				'pis0.piso AS recamaras0',
				'apla0.aplanado AS recamaras1',
				'plaf0.plafon AS recamaras2',

				'pis1.piso AS estancia_comedor0',
				'apla1.aplanado AS estancia_comedor1',
				'plaf1.plafon AS estancia_comedor2',

				'pis2.piso AS banos0',
				'apla2.aplanado AS banos1',
				'plaf2.plafon AS banos2',

				'pis3.piso AS escaleras0',
				'apla3.aplanado AS escaleras1',
				'plaf3.plafon AS escaleras2',

				'pis4.piso AS cocina0',
				'apla4.aplanado AS cocina1',
				'plaf4.plafon AS cocina2',

				'pis5.piso AS patio_servicio0',
				'apla5.aplanado AS patio_servicio0',
				'plaf5.plafon AS patio_servicio0',

				'pis6.piso AS estacionamiento0',
				'apla6.aplanado AS estacionamiento1',
				'plaf6.plafon AS estacionamiento2',

				'pis7.piso AS fachada0',
				'apla7.aplanado AS fachada1'
				)
				
						->leftJoin('cat_usos_suelos AS us', 'avaluo_inmueble.idusossuelo', '=', 'us.idusossuelos')
						->leftJoin('cat_niveles AS ct_niv', 'avaluo_inmueble.numero_niveles_unidad', '=', 'ct_niv.idnivel')
						->leftJoin('cat_cimentaciones AS cim', 'avaluo_inmueble.id_cimentacion', '=', 'cim.idcimentacion')
						->leftJoin('cat_estructuras AS estruc', 'avaluo_inmueble.id_estructura', '=', 'estruc.idestructura')
						->leftJoin('cat_muros AS mur', 'avaluo_inmueble.id_muro', '=', 'mur.idmuro')
						->leftJoin('cat_entrepisos AS entrepi', 'avaluo_inmueble.id_entrepiso', '=', 'entrepi.identrepiso')
						->leftJoin('cat_techos AS tech', 'avaluo_inmueble.id_techo', '=', 'tech.idtecho')
						->leftJoin('cat_bardas AS brd', 'avaluo_inmueble.id_barda', '=', 'brd.idbarda')
				
						->leftJoin('cat_pisos AS pis0', 'avaluo_inmueble.id_recamara0', '=', 'pis0.idpiso')
						->leftJoin('cat_aplanados AS apla0', 'avaluo_inmueble.id_recamara1', '=', 'apla0.idaplanado')
						->leftJoin('cat_plafones AS plaf0', 'avaluo_inmueble.id_recamara2', '=', 'plaf0.idplafon')
				
						->leftJoin('cat_pisos AS pis1', 'avaluo_inmueble.id_estancia_comedor0', '=', 'pis1.idpiso')
						->leftJoin('cat_aplanados AS apla1', 'avaluo_inmueble.id_estancia_comedor1', '=', 'apla1.idaplanado')
						->leftJoin('cat_plafones AS plaf1', 'avaluo_inmueble.id_estancia_comedor2', '=', 'plaf1.idplafon')
				
						->leftJoin('cat_pisos AS pis2', 'avaluo_inmueble.id_bano0', '=', 'pis2.idpiso')
						->leftJoin('cat_aplanados AS apla2', 'avaluo_inmueble.id_bano1', '=', 'apla2.idaplanado')
						->leftJoin('cat_plafones AS plaf2', 'avaluo_inmueble.id_bano2', '=', 'plaf2.idplafon')
				
						->leftJoin('cat_pisos AS pis3', 'avaluo_inmueble.id_escalera0', '=', 'pis3.idpiso')
						->leftJoin('cat_aplanados AS apla3', 'avaluo_inmueble.id_escalera1', '=', 'apla3.idaplanado')
						->leftJoin('cat_plafones AS plaf3', 'avaluo_inmueble.id_escalera2', '=', 'plaf3.idplafon')
				
						->leftJoin('cat_pisos AS pis4', 'avaluo_inmueble.id_cocina0', '=', 'pis4.idpiso')
						->leftJoin('cat_aplanados AS apla4', 'avaluo_inmueble.id_cocina1', '=', 'apla4.idaplanado')
						->leftJoin('cat_plafones AS plaf4', 'avaluo_inmueble.id_cocina2', '=', 'plaf4.idplafon')
				
						->leftJoin('cat_pisos AS pis5', 'avaluo_inmueble.id_patio_servicio0', '=', 'pis5.idpiso')
						->leftJoin('cat_aplanados AS apla5', 'avaluo_inmueble.id_patio_servicio1', '=', 'apla5.idaplanado')
						->leftJoin('cat_plafones AS plaf5', 'avaluo_inmueble.id_patio_servicio2', '=', 'plaf5.idplafon')
				
						->leftJoin('cat_pisos AS pis6', 'avaluo_inmueble.id_estacionamiento0', '=', 'pis6.idpiso')
						->leftJoin('cat_aplanados AS apla6', 'avaluo_inmueble.id_estacionamiento1', '=', 'apla6.idaplanado')
						->leftJoin('cat_plafones AS plaf6', 'avaluo_inmueble.id_estacionamiento2', '=', 'plaf6.idplafon')
				
						->leftJoin('cat_pisos AS pis7', 'avaluo_inmueble.id_fachada0', '=', 'pis7.idpiso')
						->leftJoin('cat_aplanados AS apla7', 'avaluo_inmueble.id_fachada1', '=', 'apla7.idaplanado')
						->leftJoin('cat_plafones AS plaf7', 'avaluo_inmueble.id_fachada2', '=', 'plaf7.idplafon')
				
						->where('avaluo_inmueble.idavaluo', '=', $idavaluo)
						->orderBy('avaluo_inmueble.idavaluoinmueble')
						->first();
	}
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public static function insAvaluoInmueble($idavaluo) {
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

		$row->superficie_total_terreno = $row->indiviso_terreno = $row->superficie_terreno = $row->indiviso_areas_comunes = $row->superficie_construccion = $row->indiviso_accesoria = $row->superficie_escritura = $row->superficie_vendible = '0.0000';

		$row->ip = $_SERVER['REMOTE_ADDR'];
		$row->host = isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : '';
		$row->creado_por = Auth::id();
		$row->creado_el = date('Y-m-d H:i:s');
		$row->save();
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public static function updAvaluosInmueble($idavaluo, $inputs) {
		$row = Avaluos::find($idavaluo)->AvaluosInmueble;
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

		$row->id_recamara0 = $inputs["id_recamara0"];
		$row->id_recamara1 = $inputs["id_recamara1"];
		$row->id_recamara2 = $inputs["id_recamara2"];

		$row->id_estancia_comedor0 = $inputs["id_estancia_comedor0"];
		$row->id_estancia_comedor1 = $inputs["id_estancia_comedor1"];
		$row->id_estancia_comedor2 = $inputs["id_estancia_comedor2"];

		$row->id_bano0 = $inputs["id_bano0"];
		$row->id_bano1 = $inputs["id_bano1"];
		$row->id_bano2 = $inputs["id_bano2"];

		$row->id_escalera0 = $inputs["id_escalera0"];
		$row->id_escalera1 = $inputs["id_escalera1"];
		$row->id_escalera2 = $inputs["id_escalera2"];

		$row->id_cocina0 = $inputs["id_cocina0"];
		$row->id_cocina1 = $inputs["id_cocina1"];
		$row->id_cocina2 = $inputs["id_cocina2"];

		$row->id_patio_servicio0 = $inputs["id_patio_servicio0"];
		$row->id_patio_servicio1 = $inputs["id_patio_servicio1"];
		$row->id_patio_servicio2 = $inputs["id_patio_servicio2"];

		$row->id_estacionamiento0 = $inputs["id_estacionamiento0"];
		$row->id_estacionamiento1 = $inputs["id_estacionamiento1"];
		$row->id_estacionamiento2 = $inputs["id_estacionamiento2"];

		$row->id_fachada0 = $inputs["id_fachada0"];
		$row->id_fachada1 = $inputs["id_fachada1"];
		$row->id_fachada2 = $inputs["id_fachada2"];

		$row->hidraulico_sanitarias = $inputs["hidraulico_sanitarias"];
		$row->electricas = $inputs["electricas"];
		$row->carpinteria = $inputs["carpinteria"];
		$row->herreria = $inputs["herreria"];
		$row->segun = $inputs["segun"];

		$row->superficie_total_terreno = $inputs["superficie_total_terreno"]=='' ? 0 : $inputs["superficie_total_terreno"];
		$row->indiviso_terreno = $inputs["indiviso_terreno"]=='' ? 0 : $inputs["indiviso_terreno"];
		$row->superficie_terreno = $inputs["superficie_terreno"]=='' ? 0 : $inputs["superficie_terreno"];
		$row->indiviso_areas_comunes = $inputs["indiviso_areas_comunes"]=='' ? 0 : $inputs["indiviso_areas_comunes"];
		$row->superficie_construccion = $inputs["superficie_construccion"]=='' ? 0 : $inputs["superficie_construccion"];
		$row->indiviso_accesoria = $inputs["indiviso_accesoria"]=='' ? 0 : $inputs["indiviso_accesoria"];
		$row->superficie_escritura = $inputs["superficie_escritura"]=='' ? 0 : $inputs["superficie_escritura"];
		$row->superficie_vendible = $inputs["superficie_vendible"]=='' ? 0 : $inputs["superficie_vendible"];

		$row->ip = $_SERVER['REMOTE_ADDR'];
		$row->host = isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : '';
		$row->modi_por = Auth::id();
		$row->modi_el = date('Y-m-d H:i:s');
		$row->save();
		
		// ACTUALIZAR aem_comp_terrenos, aem_homologacion
		AemHomologacion::updAemHomologacionCascade($idavaluo);
		
		// ACTUALIZAR aef_terrenos Y aef_construcciones
		
		
		AvaluosInmueble::avaluosInmuebleAfterUpdate($idavaluo, $row);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public static function avaluosInmuebleAfterUpdate($id, $row) {
		$rowAvaluoMercado = Avaluos::find($id)->AvaluosMercado;
		if ($row->superficie_construccion > 0) {
			$rowAvaluoMercado->superficie_construida = $row->superficie_construccion;
			$rowAvaluoMercado->valor_comparativo_mercado = round(($row->superficie_construccion * $rowAvaluoMercado->promedio_analisis), -1);
		} else {
			$rowAvaluoMercado->superficie_terreno = $row->superficie_terreno;
			$rowAvaluoMercado->valor_comparativo_mercado = round(($row->superficie_terreno * $rowAvaluoMercado->valor_aplicado_m2), -1);
		}
		$rowAvaluoMercado->save();
	}

}
