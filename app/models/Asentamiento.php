<?php

class Asentamiento extends Eloquent {

    protected $primaryKey = 'id_asentamiento';
    public $timestamps = false;

    public function edo(){
        return $this->belongsTo('Entidad', 'entidad', 'entidad');
    }

    public function mpio() {
        return $this->belongsTo('Municipio', 'municipio', 'municipio');
    }
}