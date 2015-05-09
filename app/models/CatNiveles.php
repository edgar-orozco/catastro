<?php

class CatNiveles extends \Eloquent {
	protected $connection = 'corevat';
	protected $fillable = [];
	protected $table = 'cat_niveles';
	protected $primaryKey = 'idnivel';
	public $timestamps = false;
}