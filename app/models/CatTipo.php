<?php

class CatTipo extends \Eloquent {
	protected $connection = 'corevat';
	protected $fillable = [];
	protected $table = 'cat_tipo';
	protected $primaryKey = 'idtipo';
	public $timestamps = false;
}