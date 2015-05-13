<?php

class CatFactoresZonas extends \Eloquent {
	protected $connection = 'corevat';
	protected $fillable = [];
	protected $table = 'cat_factores_zonas';
	protected $primaryKey = 'idfactorzona';
	public $timestamps = false;
}