<?php

class AvaluosFisico extends \Eloquent {

	protected $connection = 'corevat';
	protected $fillable = [];
	protected $table = 'avaluo_enfoque_fisico';
	protected $primaryKey = 'idavaluoenfoquefisico';
	public $timestamps = false;

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function AefTerrenos() {
		return $this->hasOne('AefTerrenos', 'idavaluoenfoquefisico', 'idavaluoenfoquefisico');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function AefConstrucciones() {
		return $this->hasOne('AefConstrucciones', 'idavaluoenfoquefisico', 'idavaluoenfoquefisico');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function AefCondominios() {
		return $this->hasOne('AefCondominios', 'idavaluoenfoquefisico', 'idavaluoenfoquefisico');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function AefCompConstrucciones() {
		return $this->hasOne('AefCompConstrucciones', 'idavaluoenfoquefisico', 'idavaluoenfoquefisico');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function AefInstalaciones() {
		return $this->hasOne('AefInstalaciones', 'idavaluoenfoquefisico', 'idavaluoenfoquefisico');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public static function getAvaluoFisicoByFk($idavaluo) {
		return AvaluosFisico::select('avaluo_enfoque_fisico.*', 
				'cat_clase_general_inmueble.clase_general_inmueble', 
				'cat_tipo_inmueble.tipo_inmueble',
				'cat_estado_conservacion.estado_conservacion',
				'cat_calidad_proyecto.calidad_proyecto')
						->leftJoin('cat_clase_general_inmueble', 'avaluo_enfoque_fisico.idclasegeneral', '=', 'cat_clase_general_inmueble.idclasegeneralinmueble')
						->leftJoin('cat_tipo_inmueble', 'avaluo_enfoque_fisico.idtipoinmueble', '=', 'cat_tipo_inmueble.idtipoinmueble')
						->leftJoin('cat_estado_conservacion', 'avaluo_enfoque_fisico.idestado_conservacion', '=', 'cat_estado_conservacion.idestadoconservacion')
						->leftJoin('cat_calidad_proyecto', 'avaluo_enfoque_fisico.idcalidadproyecto', '=', 'cat_calidad_proyecto.idcalidadproyecto')
				
						->where('avaluo_enfoque_fisico.idavaluo', '=', $idavaluo)
						->first();
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public static function delAvaluosFisico($idavaluo) {
		$rowFisico = Avaluos::findOrFail($idavaluo)->AvaluosFisico;
		if (count($rowFisico) > 0) {
			AefCompConstrucciones::where('idavaluoenfoquefisico', '=', $rowFisico->idavaluoenfoquefisico)->delete();
			AefCondominios::where('idavaluoenfoquefisico', '=', $rowFisico->idavaluoenfoquefisico)->delete();
			AefConstrucciones::where('idavaluoenfoquefisico', '=', $rowFisico->idavaluoenfoquefisico)->delete();
			AefInstalaciones::where('idavaluoenfoquefisico', '=', $rowFisico->idavaluoenfoquefisico)->delete();
			AefTerrenos::where('idavaluoenfoquefisico', '=', $rowFisico->idavaluoenfoquefisico)->delete();
		}
		AvaluosFisico::where('idavaluo', '=', $idavaluo)->delete();
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public static function insAvaluoFisico($idavaluo) {
		$row = new AvaluosFisico();
		$row->idavaluo = $idavaluo;
		$row->tipo_moda = $row->valor_unitario_promedio = $row->valor_aplicado_m2 = $row->valor_terreno = $row->total_metros_construccion = $row->valor_construccion = $row->subtotal_area_condominio = $row->subtotal_instalaciones_especiales = $row->total_valor_fisico = 0.00;
		$row->conclusion_investigacion_comparables = $row->conclusion_investigacion_terreno = $row->conclusion_investigacion_construccion = '';
		$row->idclasegeneral = 1;
		$row->idtipoinmueble = 1;
		$row->idestado_conservacion = 1;
		$row->idcalidadproyecto = 1;
		$row->edad_construccion = $row->vida_util = $row->numero_niveles = $row->nivel_edificio_condominio = 0;
		$row->idemp = 1;
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
	public static function updBeforeAvaluoEnfoqueFisico($rowEnfoqueFisico) {
		$total_valor_fisico = $rowEnfoqueFisico->valor_terreno + $rowEnfoqueFisico->valor_construccion + 
				$rowEnfoqueFisico->subtotal_area_condominio + $rowEnfoqueFisico->subtotal_instalaciones_especiales;
		return $total_valor_fisico;
	}
	
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public static function updAvaluoFisico($id, $inputs) {
		$rowEnfoqueFisico = Avaluos::find($id)->AvaluosFisico;
		
		$rowEnfoqueFisico->total_valor_fisico = AvaluosFisico::updBeforeAvaluoEnfoqueFisico($rowEnfoqueFisico);
		$rowEnfoqueFisico->idclasegeneral = $inputs["idclasegeneralinmueble"];
		$rowEnfoqueFisico->idtipoinmueble = $inputs["idtipoinmueble"];
		$rowEnfoqueFisico->idestado_conservacion = $inputs["idestadoconservacion"];
		$rowEnfoqueFisico->idcalidadproyecto = $inputs["idcalidadproyecto"];
		$rowEnfoqueFisico->edad_construccion = $inputs["edad_construccion"];
		$rowEnfoqueFisico->vida_util = $inputs["vida_util"];
		$rowEnfoqueFisico->numero_niveles = $inputs["numero_niveles"];
		$rowEnfoqueFisico->nivel_edificio_condominio = $inputs["nivel_edificio_condominio"];
		
		$rowEnfoqueFisico->ip = $_SERVER['REMOTE_ADDR'];
		$rowEnfoqueFisico->host = isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : '';
		$rowEnfoqueFisico->modi_por = Auth::id();
		$rowEnfoqueFisico->modi_el = date('Y-m-d H:i:s');
		
		$rowEnfoqueFisico->save();
		
		AvaluosFisico::updAfterAvaluoEnfoqueFisico($rowEnfoqueFisico->idavaluo, $rowEnfoqueFisico->total_valor_fisico);
	}
	
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public static function updAfterAvaluoEnfoqueFisico($idavaluo, $total_valor_fisico) {
		$rowAvaluosConclusiones = Avaluos::find($idavaluo)->AvaluosConclusiones;
		$rowAvaluosConclusiones->valor_fisico = $total_valor_fisico;
		$rowAvaluosConclusiones->save();
	}
}
