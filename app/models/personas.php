<?php

class personas extends Eloquent
{
    protected $table ='personas';
    protected $primaryKey = 'id_p';
    public $timestamps=false;
    protected $guarded = array("*");
    protected $fillable = array("*");
}