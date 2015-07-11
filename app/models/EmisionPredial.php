<?php

class EmisionPredial extends Ardent {
    
    protected $fillable = ['periodo','anio','mes',''];

    protected $table = 'emisiones_predial';

    public function usuario(){
        return $this->belongsTo('User', 'id', 'usuario_id');
    }
    
}