<?php

class CatPisos extends \Eloquent {
	protected $connection = 'corevat';
	protected $fillable = [];
	protected $table = 'cat_pisos';
	protected $primaryKey = 'idpiso';
	public $timestamps = false;
}