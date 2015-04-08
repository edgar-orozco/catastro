<?php

class instalaciones extends Eloquent
{
    protected $table ='instalacionesespeciales';
    protected $primaryKey = 'id_ie'; 
    public $timestamps=true;
//    protected $guarded = array("*");
//    protected $fillable = array("id_ie","clave","id_tipo_ie");
}
