<?php

class TipoPersona extends Eloquent {

    protected $table = 'tipopersonas';
    protected $pk = 'id_tipo';

    /**
     * Relacion pertenece a una persona
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function personas() {
        return $this->belongsTo('personas', 'id_tipo', 'id_tipo');
    }
}