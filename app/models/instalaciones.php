<?php

class instalaciones extends Eloquent
{
    protected $table ='instalaciones_especiales';
    protected $primaryKey = 'id_ie'; 
    public $timestamps=false;
//    protected $guarded = array("*");
//    protected $fillable = array("id_ie","clave","id_tipo_ie");
}
