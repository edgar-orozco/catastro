<?php

class predios extends Eloquent
{
    protected $table ='predios';
    protected $primaryKey = 'gid';
    public $timestamps=false;
    protected $guarded = array("*");
    protected $fillable = array("gid","id_propietario","municipio");
}

