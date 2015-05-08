<?php

class CatEntrepisos extends \Eloquent {
	protected $connection = 'corevat';
	protected $fillable = [];
	protected $table = 'cat_entrepisos';
	protected $primaryKey = 'identrepiso';
	public $timestamps = false;
}