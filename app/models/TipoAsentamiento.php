<?php

class TipoAsentamiento extends Eloquent {

    protected $table = 'tiposasentamiento';

    public function domicilios(){
        return $this->hasMany('Domicilio', 'tipo_asentamiento_id');
    }
}