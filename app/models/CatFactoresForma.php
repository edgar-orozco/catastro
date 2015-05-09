<?php

class CatFactoresForma extends \Eloquent {
	protected $connection = 'corevat';
	protected $fillable = [];
	protected $table = 'cat_factores_forma';
	protected $primaryKey = 'idfactorforma';
	public $timestamps = false;
}