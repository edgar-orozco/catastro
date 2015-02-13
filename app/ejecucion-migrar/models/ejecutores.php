<?php

class ejecutores extends Eloquent
{
    protected $table ='ejecutores';
    protected $primaryKey = 'id_ejecutor';
    public $timestamps=false;
    protected $guarded = array("*");
    protected $fillable = array("*");
}