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
		$row->nivel_equipamiento = (int) $inputs["nivel_equipamiento"];
		$row->idclasificacionzona = $inputs["idclasificacionzona"];
		$row->idproximidadurbana = $inputs["idproximidadurbana"];
		$row->construc_predominante = $inputs["construc_predominante"];
		$row->vias_acceso_importante = $inputs["vias_acceso_importante"];
		$row->updated_at = $inputs["updated_at"];
		$row->save();
	}

}
