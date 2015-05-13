<?php

class CatFactoresFrente extends \Eloquent {
	protected $connection = 'corevat';
	protected $fillable = [];
	protected $table = 'cat_factores_frente';
	protected $primaryKey = 'idfactorfrente';
	public $timestamps = false;
}