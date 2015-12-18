<?php

class ValuacionPredio extends Eloquent {
	
	protected $table      = 'valuacion_predios';
	protected $primaryKey = 'id';
	protected $guarded    = ['id','tramite_id'];
	protected $fillable   = ['clave','cuenta','valor_terreno','valor_construccion','fecha_valuacion','num_certificado','created_at','updated_at','demerito_terreno','demerito_construccion','incremento_terreno','incremento_construccion','valor_ajustado_terreno','valor_ajustado_construccion','valor_catastral'];
	public $timestamps    = true;
	
	/**
	 * Relacion uno a uno con la tabla datos_valuacion_terreno
	 * @param int $id
	 * @return Response 
	 */
	public function ValuacionTerreno () {
		return $this->hasOne('DatosValuacionTerrenos','valuacion_id','id');
	}
	/**
	 * Relacion uno a muchos con la tabla datos_valuacion_construcciones
	 * @param int $id
	 * @return Response
	 */
	public function ValuacionConstruccion () {
		return $this->hasMany('DatosValuacionConstrucciones','valuacion_id');
	}
}	