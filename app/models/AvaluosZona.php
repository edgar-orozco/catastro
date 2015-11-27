<?php

class AvaluosZona extends \Eloquent {

	protected $connection = 'corevat';
	protected $fillable = [];
	protected $table = 'avaluo_zona';
	protected $primaryKey = 'idavaluozona';
	public $timestamps = false;

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $idavaluo
	 * @return Response
	 */
	public static function getAvaluosZonaByFk($idavaluo) {
		return AvaluosZona::select('avaluo_zona.*', 'cat_clasificacion_zona.clasificacion_zona', 'cat_proximidad_urbana.proximidad_urbana')
						->leftJoin('cat_clasificacion_zona', 'avaluo_zona.idclasificacionzona', '=', 'cat_clasificacion_zona.idclasificacionzona')
						->leftJoin('cat_proximidad_urbana', 'avaluo_zona.idproximidadurbana', '=', 'cat_proximidad_urbana.idproximidadurbana')
						->where('avaluo_zona.idavaluo', '=', $idavaluo)
						->first();
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public static function updAvaluosZona($idavaluo, $inputs) {
		$x = 0;
		$row = Avaluos::find($idavaluo)->AvaluosZona;
		$row->is_agua_potable = isset($inputs["is_agua_potable"]) ? 1 : 0;
		$row->is_guarniciones = isset($inputs["is_guarniciones"]) ? 1 : 0;
		$row->is_drenaje = isset($inputs["is_drenaje"]) ? 1 : 0;
		$row->is_banqueta = isset($inputs["is_banqueta"]) ? 1 : 0;
		$row->is_electricidad = isset($inputs["is_electricidad"]) ? 1 : 0;
		$row->is_telefono = isset($inputs["is_telefono"]) ? 1 : 0;
		$row->is_pavimentacion = isset($inputs["is_pavimentacion"]) ? 1 : 0;
		$row->is_transporte_publico = isset($inputs["is_transporte_publico"]) ? 1 : 0;
		$row->is_alumbrado_publico = isset($inputs["is_alumbrado_publico"]) ? 1 : 0;
		$row->is_recoleccion_basura = isset($inputs["is_recoleccion_basura"]) ? 1 : 0;
		$row->is_vigilancia_privada = isset($inputs["is_vigilancia_privada"]) ? 1 : 0;
		$row->is_internet = isset($inputs["is_internet"]) ? 1 : 0;
		
		$row->is_escuela = isset($inputs["is_escuela"]) ? 1 : 0;
		$row->is_iglesia = isset($inputs["is_iglesia"]) ? 1 : 0;
		$row->is_banco = isset($inputs["is_banco"]) ? 1 : 0;
		$row->is_comercio = isset($inputs["is_comercio"]) ? 1 : 0;
		$row->is_hospital = isset($inputs["is_hospital"]) ? 1 : 0;
		$row->is_parque = isset($inputs["is_parque"]) ? 1 : 0;
		$row->is_transporte = isset($inputs["is_transporte"]) ? 1 : 0;
		$row->is_gasolinera = isset($inputs["is_gasolinera"]) ? 1 : 0;
		$row->is_mercado = isset($inputs["is_mercado"]) ? 1 : 0;
		
		$row->is_otro_servicio = isset($inputs["is_otro_servicio"]) ? 1 : 0;
		$row->otro_servicio_municipal = isset($inputs["otro_servicio_municipal"]) ? $inputs["otro_servicio_municipal"] : '';
		
		$row->nivel_equipamiento = (int) $inputs["hidden_nivel_equipamiento"];
		
		$row->is_otro_equipamiento = isset($inputs["is_otro_equipamiento"]) ? 1 : 0;

		$row->calles_transversales = $inputs["calles_transversales"];
		//
		$row->cobertura = $inputs["cobertura"];
		$row->otro_equipamiento = isset($inputs["otro_equipamiento"]) ? $inputs["otro_equipamiento"] : '';
		$row->idclasificacionzona = $inputs["idclasificacionzona"];
		$row->idproximidadurbana = $inputs["idproximidadurbana"];
		$row->construc_predominante = $inputs["construc_predominante"];
		$row->vias_acceso_importante = $inputs["vias_acceso_importante"];
		$row->updated_at = $inputs["updated_at"];
		
		$row->save();
	}
	
	public static function clonarAvaluosZona($idavaluo_old, $idavaluo_new) {
		$rowZonaOld = AvaluosZona::select('*')->where('idavaluo', '=', $idavaluo_old)->first();
		$rowZonaNew = Avaluos::find($idavaluo_new)->AvaluosZona;
		$rowZonaNew->is_agua_potable = $rowZonaOld->is_agua_potable;
		$rowZonaNew->is_guarniciones = $rowZonaOld->is_guarniciones;
		$rowZonaNew->is_drenaje = $rowZonaOld->is_drenaje;
		$rowZonaNew->is_banqueta = $rowZonaOld->is_banqueta;
		$rowZonaNew->is_electricidad = $rowZonaOld->is_electricidad;
		$rowZonaNew->is_telefono = $rowZonaOld->is_telefono;
		$rowZonaNew->is_pavimentacion = $rowZonaOld->is_pavimentacion;
		$rowZonaNew->is_transporte_publico = $rowZonaOld->is_transporte_publico;
		$rowZonaNew->is_alumbrado_publico = $rowZonaOld->is_alumbrado_publico;
		$rowZonaNew->is_otro_servicio = $rowZonaOld->is_otro_servicio;
		$rowZonaNew->otro_servicio_municipal = $rowZonaOld->otro_servicio_municipal;
		$rowZonaNew->is_escuela = $rowZonaOld->is_escuela;
		$rowZonaNew->is_iglesia = $rowZonaOld->is_iglesia;
		$rowZonaNew->is_banco = $rowZonaOld->is_banco;
		$rowZonaNew->is_comercio = $rowZonaOld->is_comercio;
		$rowZonaNew->is_hospital = $rowZonaOld->is_hospital;
		$rowZonaNew->is_parque = $rowZonaOld->is_parque;
		$rowZonaNew->is_transporte = $rowZonaOld->is_transporte;
		$rowZonaNew->is_gasolinera = $rowZonaOld->is_gasolinera;
		$rowZonaNew->is_mercado = $rowZonaOld->is_mercado;
		$rowZonaNew->is_otro_equipamiento = $rowZonaOld->is_otro_equipamiento;
		$rowZonaNew->cobertura = $rowZonaOld->cobertura;
		$rowZonaNew->otro_equipamiento = $rowZonaOld->otro_equipamiento;
		$rowZonaNew->nivel_equipamiento = $rowZonaOld->nivel_equipamiento;
		$rowZonaNew->idclasificacionzona = $rowZonaOld->idclasificacionzona;
		$rowZonaNew->idproximidadurbana = $rowZonaOld->idproximidadurbana;
		$rowZonaNew->construc_predominante = $rowZonaOld->construc_predominante;
		$rowZonaNew->vias_acceso_importante = $rowZonaOld->vias_acceso_importante;
		$rowZonaNew->is_recoleccion_basura = $rowZonaOld->is_recoleccion_basura;
		$rowZonaNew->is_vigilancia_privada = $rowZonaOld->is_vigilancia_privada;
		$rowZonaNew->is_internet = $rowZonaOld->is_internet;
		$rowZonaNew->calles_transversales = $rowZonaOld->calles_transversales;
		$rowZonaNew->save();
	}
	
}
