<?php

class Domicilio extends Eloquent {

    protected $fillable = ['tipo_vialidad_id', 'vialidad', 'num_ext', 'num_int', 'tipo_asentamiento_id', 'asentamiento', 'cp', 'localidad', 'municipio', 'entidad', 'referencia'];
    public $timestamps = false;

    public function tipoVialidad(){
        return $this->belongsTo('TipoVialidad', 'tipo_vialidad_id');
    }

    public function tipoAsentamiento(){
        return $this->belongsTo('TipoAsentamiento', 'tipo_asentamiento_id');
    }

    public function mpio(){
        return $this->belongsTo('Municipio','municipio', 'municipio');
    }

    public function edo(){
        return $this->belongsTo('Entidad','entidad', 'entidad');
    }

}