<?php

class CatFactoresConservacion extends \Eloquent {
	protected $connection = 'corevat';
	protected $fillable = [];
	protected $table = 'cat_factores_conservacion';
	protected $primaryKey = 'idfactorconservacion';
	public $timestamps = false;
}