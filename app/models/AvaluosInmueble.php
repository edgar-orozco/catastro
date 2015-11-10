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
				'us.usos_suelos',
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

		//$row->id_recamara0 = $inputs["id_recamara0"];
		//$row->id_recamara1 = $inputs["id_recamara1"];
		//$row->id_recamara2 = $inputs["id_recamara2"];

		//$row->id_estancia_comedor0 = $inputs["id_estancia_comedor0"];
		//$row->id_estancia_comedor1 = $inputs["id_estancia_comedor1"];
		//$row->id_estancia_comedor2 = $inputs["id_estancia_comedor2"];

		//$row->id_bano0 = $inputs["id_bano0"];
		//$row->id_bano1 = $inputs["id_bano1"];
		//$row->id_bano2 = $inputs["id_bano2"];

		//$row->id_escalera0 = $inputs["id_escalera0"];
		//$row->id_escalera1 = $inputs["id_escalera1"];
		//$row->id_escalera2 = $inputs["id_escalera2"];

		//$row->id_cocina0 = $inputs["id_cocina0"];
		//$row->id_cocina1 = $inputs["id_cocina1"];
		//$row->id_cocina2 = $inputs["id_cocina2"];

		//$row->id_patio_servicio0 = $inputs["id_patio_servicio0"];
		//$row->id_patio_servicio1 = $inputs["id_patio_servicio1"];
		//$row->id_patio_servicio2 = $inputs["id_patio_servicio2"];

		//$row->id_estacionamiento0 = $inputs["id_estacionamiento0"];
		//$row->id_estacionamiento1 = $inputs["id_estacionamiento1"];
		//$row->id_estacionamiento2 = $inputs["id_estacionamiento2"];

		//$row->id_fachada0 = $inputs["id_fachada0"];
		//$row->id_fachada1 = $inputs["id_fachada1"];
		//$row->id_fachada2 = $inputs["id_fachada2"];

		$row->hidraulico_sanitarias = $inputs["hidraulico_sanitarias"];
		$row->electricas = $inputs["electricas"];
		$row->carpinteria = $inputs["carpinteria"];
		//$row->herreria = $inputs["herreria"];
		$row->segun = $inputs["segun"];

		$row->superficie_total_terreno = $inputs["superficie_total_terreno"]=='' ? 0 : $inputs["superficie_total_terreno"];
		$row->indiviso_terreno = $inputs["indiviso_terreno"]=='' ? 0 : $inputs["indiviso_terreno"];
		$row->superficie_terreno = $inputs["superficie_terreno"]=='' ? 0 : $inputs["superficie_terreno"];
		$row->indiviso_areas_comunes = $inputs["indiviso_areas_comunes"]=='' ? 0 : $inputs["indiviso_areas_comunes"];
		$row->superficie_construccion = $inputs["superficie_construccion"]=='' ? 0 : $inputs["superficie_construccion"];
		$row->indiviso_accesoria = $inputs["indiviso_accesoria"]=='' ? 0 : $inputs["indiviso_accesoria"];
		$row->superficie_escritura = $inputs["superficie_escritura"]=='' ? 0 : $inputs["superficie_escritura"];
		$row->superficie_vendible = $inputs["superficie_vendible"]=='' ? 0 : $inputs["superficie_vendible"];
		$row->updated_at = $inputs["updated_at"];
		
		$row->herreria_ventana = $inputs["herreria_ventana"];
		$row->aluminio_ventana = $inputs["aluminio_ventana"];
		$row->herreria_puerta = $inputs["herreria_puerta"];
		$row->aluminio_puerta = $inputs["aluminio_puerta"];

		$row->save();
		
	}

	public static function clonarAvaluosInmueble($idavaluoold, $idavaluonew) {
		$rowInmuebleOld = Avaluos::find($idavaluoold)->AvaluosInmueble;
		$rowInmuebleNew = Avaluos::find($idavaluonew)->AvaluosInmueble;
		
		$rowInmuebleNew->medidas_colindancias         = $rowInmuebleOld->medidas_colindancias;
		$rowInmuebleNew->idusossuelo                  = $rowInmuebleOld->idusossuelo;
		$rowInmuebleNew->servidumbre_restricciones    = $rowInmuebleOld->servidumbre_restricciones;
		$rowInmuebleNew->descripcion_inmueble         = $rowInmuebleOld->descripcion_inmueble;
		$rowInmuebleNew->numero_niveles_unidad        = $rowInmuebleOld->numero_niveles_unidad;
		$rowInmuebleNew->unidades_rentables_escritura = $rowInmuebleOld->unidades_rentables_escritura;
		$rowInmuebleNew->cimentacion                  = $rowInmuebleOld->cimentacion;
		$rowInmuebleNew->estructura                   = $rowInmuebleOld->estructura;
		$rowInmuebleNew->muros                        = $rowInmuebleOld->muros;
		$rowInmuebleNew->entrepisos                   = $rowInmuebleOld->entrepisos;
		$rowInmuebleNew->techos = $rowInmuebleOld->techos;
		$rowInmuebleNew->bardas = $rowInmuebleOld->bardas;
		$rowInmuebleNew->id_cimentacion = $rowInmuebleOld->id_cimentacion;
		$rowInmuebleNew->id_estructura = $rowInmuebleOld->id_estructura;
		$rowInmuebleNew->id_muro = $rowInmuebleOld->id_muro;
		$rowInmuebleNew->id_entrepiso = $rowInmuebleOld->id_entrepiso;
		$rowInmuebleNew->id_techo = $rowInmuebleOld->id_techo;
		$rowInmuebleNew->id_barda = $rowInmuebleOld->id_barda;
		$rowInmuebleNew->hidraulico_sanitarias = $rowInmuebleOld->hidraulico_sanitarias;
		$rowInmuebleNew->electricas = $rowInmuebleOld->electricas;
		$rowInmuebleNew->carpinteria = $rowInmuebleOld->carpinteria;
		$rowInmuebleNew->segun = $rowInmuebleOld->segun;
		$rowInmuebleNew->superficie_total_terreno = $rowInmuebleOld->superficie_total_terreno;
		$rowInmuebleNew->indiviso_terreno = $rowInmuebleOld->indiviso_terreno;
		$rowInmuebleNew->superficie_terreno = $rowInmuebleOld->superficie_terreno;
		$rowInmuebleNew->indiviso_areas_comunes = $rowInmuebleOld->indiviso_areas_comunes;
		$rowInmuebleNew->superficie_construccion = $rowInmuebleOld->superficie_construccion;
		$rowInmuebleNew->indiviso_accesoria      = $rowInmuebleOld->indiviso_accesoria;
		$rowInmuebleNew->superficie_escritura = $rowInmuebleOld->superficie_escritura;
		$rowInmuebleNew->superficie_vendible = $rowInmuebleOld->superficie_vendible;
		$rowInmuebleNew->herreria_ventana = $rowInmuebleOld->herreria_ventana;
		$rowInmuebleNew->aluminio_ventana = $rowInmuebleOld->aluminio_ventana;
		$rowInmuebleNew->herreria_puerta = $rowInmuebleOld->herreria_puerta;
		$rowInmuebleNew->aluminio_puerta = $rowInmuebleOld->aluminio_puerta;

		$rowInmuebleNew->save();
		
		AiMedidasColindancias::clonarAiMedidasColindancias($rowInmuebleOld->idavaluoinmueble, $rowInmuebleNew->idavaluoinmueble);
		AiAcabados::clonarAiAcabados($rowInmuebleOld->idavaluoinmueble, $rowInmuebleNew->idavaluoinmueble);
		
	}
}
