<?php

class CatEstructuras extends \Eloquent {
	protected $connection = 'corevat';
	protected $fillable = [];
	protected $table = 'cat_estructuras';
	protected $primaryKey = 'idestructura';
	public $timestamps = false;
}