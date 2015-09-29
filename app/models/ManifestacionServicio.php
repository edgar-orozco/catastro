<?php

class ManifestacionServicio extends Eloquent
{
    protected $table = 'manifestaciones_servicios';
    protected $guarded = ['id'];

    public function manifestacion()
    {
        return $this->belongsTo('Manifestacion', 'manifestacion_id', 'id');
    }

    public function servicio(){
        return $this->hasOne('tiposervicios','id_tiposervicio','servicio_id');
    }
}