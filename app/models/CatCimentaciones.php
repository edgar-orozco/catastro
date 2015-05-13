<?php

class CatCimentaciones extends \Eloquent {
	protected $connection = 'corevat';
	protected $fillable = [];
	protected $table = 'cat_cimentaciones';
	protected $primaryKey = 'idcimentacion';
	public $timestamps = false;
}