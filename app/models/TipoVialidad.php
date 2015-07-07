<?php

class TipoVialidad extends Eloquent {

    protected $table = 'tiposvialidad';

    public function domicilios(){
        return $this->hasMany('Domicilio', 'tipo_vialidad_id');
    }

}