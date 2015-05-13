<?php

class CatPlafones extends \Eloquent {
	protected $connection = 'corevat';
	protected $fillable = [];
	protected $table = 'cat_plafones';
	protected $primaryKey = 'idplafon';
	public $timestamps = false;
}