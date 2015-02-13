<?php

class requerimientos extends Eloquent
{
    protected $table ='requerimientos';
    protected $primaryKey = 'id_requerimiento';
    public $timestamps=false;
    protected $guarded = array("*");
    protected $fillable = array("*");
}