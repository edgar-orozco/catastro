<?php

class CatFactoresSuperficie extends \Eloquent {
	protected $connection = 'corevat';
	protected $fillable = [];
	protected $table = 'cat_factores_superficie';
	protected $primaryKey = 'idfactorsuperficie';
	public $timestamps = false;
}