<?php

use Illuminate\Database\Eloquent\Model;

class PeritoUsuario extends Model {

    protected $table = 'perito_usuarios';
    protected $fillable = ['user_id','perito_id','created_at','updated_at'];

    public function perito(){
        return $this->hasOne('Perito','id','perito_id');
    }

    public function usuario(){
        return $this->belongsTo('User','id','user_id');
    }
}