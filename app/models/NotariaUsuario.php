<?php

class NotariaUsuario extends Eloquent {
    protected $table = 'notaria_usuario';
    protected $fillable = ['user_id','notaria_id','created_at','updated_at'];

    public function notaria(){
        return $this->belongsTo('Notaria','notaria_id','id_notaria');
    }

    public function usuario(){
        return $this->belongsTo('User','user_id','id');
    }
}