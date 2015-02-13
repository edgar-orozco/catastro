<?php

class ejecucion extends Eloquent
{
    protected $table ='ejecucion_fiscal';
    protected $primaryKey = 'id_ejecucion_fiscal';
    public $timestamps=false;
    protected $guarded = array("*");
    protected $fillable = array("*");
}