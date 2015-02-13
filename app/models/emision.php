<?php

class emision extends Eloquent
{
    protected $table ='emision_predial';
    protected $primaryKey = 'clave';
    public $timestamps=false;
    protected $guarded = array("*");
    protected $fillable = array("*");
}