<?php

class RegistroColindancias extends Eloquent {
    protected $table = 'registro_colindancias';
    protected $primaryKey = 'id';
    protected $guarded = array("*");
    protected $fillable = array("*");
   public $timestamps = true;

   public function registro()
    {

        return $this->belongsTo('RegistroEscritura', 'registro_id', 'id');


    }
}
