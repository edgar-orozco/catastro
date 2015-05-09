<?php

class CatMuros extends \Eloquent {
	protected $connection = 'corevat';
	protected $fillable = [];
	protected $table = 'cat_muros';
	protected $primaryKey = 'idmuro';
	public $timestamps = false;
}