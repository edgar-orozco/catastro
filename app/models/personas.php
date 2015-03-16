<?php

class personas extends Eloquent
{
    protected $table ='personas';
    protected $primaryKey = 'id_p';
    public $timestamps=false;
    protected $guarded = array("*");
    protected $fillable = array("nombres", "apellido_paterno", "apellido_materno", "nombrec", "rfc", "curp", "fecha_ingr");
}

