<?php

class DatosValuacionTerrenos extends Eloquent {

	protected $table      = 'datos_valuacion_terrenos';
	protected $primaryKey = 'id';
	protected $guarded    = ['id','valuacion_id'];
	protected $fillable   = ['clave','cuenta','estatus','sup_terreno','valor_calle','valor_calle_id','usosuelo_id','incremnento_esquina_id','demerito_escaso_frente','demerito_profundidad_frente','demerito_profundidad','demerito_irregular','demerito_superficie_excavada','demerito_profundidad_excavada','demerito_desnivel_area','demerito_desnivel_porcentaje','superficie_paso_servidumbre','demerito_porcentaje','demeritos_terreno','demeritos_construccion','incrementos_terreno','incrementos_construccin','incremento_viascomunicacion_id','incremento_cabeceramunicipal_id','incremento_centrospoblacion_id','ajustado_terreno','ajustado_construccion','observaciones','recibo','fecha_pago','num_construcciones','finalizado','user_id','created_at','updated_at'];
	public $timestamps    = true;
}	