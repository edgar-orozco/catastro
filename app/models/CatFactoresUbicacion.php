<?php

class CatFactoresUbicacion extends \Eloquent {
	protected $connection = 'corevat';
	protected $fillable = [];
	protected $table = 'cat_factores_ubicacion';
	protected $primaryKey = 'idfactorubicacion';
	public $timestamps = false;
}