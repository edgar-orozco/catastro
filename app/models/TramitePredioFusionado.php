<?php

class TramitePredioFusionado extends Eloquent
{
    protected $table = 'tramite_predios_fusionados';
    protected $fillable = ['tramite_id','clave','cuenta'];

    /**
     * Relación con trámite. Un Predio fusionado pertenece a un trámite.
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function tramite(){
        return $this->belongsTo('Tramite','tramite_id');
    }

}