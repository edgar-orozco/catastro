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

    public function estado(){
        return $this->hasOne('Entidad','entidad','entidad');
    }

    /**
     * Regresa la relacion de los usuarios del sistema que pertenecen a esta notaría
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function usuarios(){
        return $this->hasMany('NotariaUsuario','notaria_id','id_notaria');
    }

    public function notaria(){
        return $this->belongsTo('RegistroEscritura', 'notaria_id', 'id_notaria');
    }
}