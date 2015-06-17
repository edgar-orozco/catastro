<?php

class fiscal extends Eloquent
{
    protected $table ='fiscal';
    protected $primaryKey = 'clave';
    public $timestamps=false;
    protected $guarded = array("*");
    protected $fillable = array("*");
}