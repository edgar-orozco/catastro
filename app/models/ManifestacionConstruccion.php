<?php

class ManifestacionConstruccion extends Eloquent
{
    protected $table = 'manifestaciones_construcciones';
    protected $guarded = ['id'];

    public function manifestacion()
    {
        return $this->belongsTo('Manifestacion', 'manifestacion_id', 'id');
    }
}