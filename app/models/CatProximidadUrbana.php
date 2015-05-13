<?php

class CatProximidadUrbana extends \Eloquent {
	protected $connection = 'corevat';
	protected $fillable = [];
	protected $table = 'cat_proximidad_urbana';
	protected $primaryKey = 'idproximidadurbana';
	public $timestamps = false;
}