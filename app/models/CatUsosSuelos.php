<?php

class CatUsosSuelos extends \Eloquent {
	protected $connection = 'corevat';
	protected $fillable = [];
	protected $table = 'cat_usos_suelos';
	protected $primaryKey = 'idusossuelos';
	public $timestamps = false;
}