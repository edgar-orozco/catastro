<?php

class CatAplanados extends \Eloquent {
	protected $connection = 'corevat';
	protected $fillable = [];
	protected $table = 'cat_aplanados';
	protected $primaryKey = 'idaplanado';
	public $timestamps = false;
}