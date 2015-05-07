<?php

class CatBardas extends \Eloquent {
	protected $connection = 'corevat';
	protected $fillable = [];
	protected $table = 'cat_bardas';
	protected $primaryKey = 'idbarda';
	public $timestamps = false;
}