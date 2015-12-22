<?php

class ManifestacionConstruccion extends Eloquent
{
    protected $table = 'manifestaciones_construcciones';
    protected $guarded = ['id'];
    protected $fillable = 	[
    							'sup_construccion', 'tipo_construccion_id',
    							'techo_id',	'muro_id',
    							'piso_id','puerta_id',
    							'ventana_id', 'hidraulicas',
    							'electricas', 'sanitarias',
    							'inst_especiales_id', 'antiguedad',
    							'edo_construccion_id', 'avance',
    							'uso_construccion_id', 'num_niveles',
    							'sup_albercas', 'sup_total',
    							'num_bloque', 'manifestacion_id'
    						];

    public function manifestacion()
    {
        return $this->belongsTo('Manifestacion', 'manifestacion_id', 'id');
    }
}