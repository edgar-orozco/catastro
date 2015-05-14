<?php

use LaravelBook\Ardent\Ardent;


class Notaria extends Ardent
{
    protected $primaryKey = 'id_notaria';
    public $timestamps=false;

    public function notario() {
        return $this->hasOne('personas', 'id_p', 'id_notario');
    }

    public function responsable() {
        return $this->hasOne('personas', 'id_p', 'id_responsable');
    }

    public function mpio(){
        return $this->hasOne('Municipio','municipio','municipio');
    }

}