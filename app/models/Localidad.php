<?php
/**
 * Created by david.
 */
use LaravelBook\Ardent\Ardent;


class Localidad extends Ardent
{
    protected $table = 'localidades_a';
    protected $primaryKey = 'gid';
    public $timestamps=false; 

   
}