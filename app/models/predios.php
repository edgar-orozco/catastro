<?php

class predios extends Eloquent
{
   protected $table ='predios';
    protected $primaryKey = 'clave';
    public $timestamps=false;
    protected $guarded = array("*");
   // protected $fillable = array("nombrec","rfc");
}