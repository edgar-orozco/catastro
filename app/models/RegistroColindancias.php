<?php

class RegistroColindancias extends Eloquent {
    protected $table = 'registro_colindancias';
    protected $primaryKey = 'id';
    protected $guarded = ['id', 'created_at', 'updated_at'];
    protected $fillable = ['registro_id', 'orientacion', 'superficie', 'colindancia'];
   public $timestamps = true;

   public function registro()
    {

        return $this->belongsTo('RegistroEscritura', 'registro_id', 'id');


    }
}
