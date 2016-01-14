<?php

class DatosValuacionConstrucciones extends Eloquent {

	protected $table      = 'datos_valuacion_construcciones';
	protected $primaryKey = 'id';
    protected $guarded = ['id', 'created_at', 'updated_at'];
	protected $fillable   = ['valuacion_id','clave','cuenta','valuacion_terreno_id','construccion_num','sup_terreno','es_alberca','tipoalberca_id','conservacion_id','tipo_id','piso_id','techo_id','muros_id','hidraulicas_id','sanitarias_id','electricas_id','avance','anio_construccion','edad','clase_id','demerito_edad','demerito_avance','valor_unitario','valor','valor_ajustado','puerta_id','numero_niveles'];
	public $timestamps    = true;
}
