<?php

class CatTechos extends \Eloquent {
	protected $connection = 'corevat';
	protected $fillable = [];
	protected $table = 'cat_techos';
	protected $primaryKey = 'idtecho';
	public $timestamps = false;
}