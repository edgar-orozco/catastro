<?php

class CatFinalidad extends \Eloquent {

	protected $connection = 'corevat';
	protected $fillable = [];
	protected $table = 'cat_finalidad';
	protected $primaryKey = 'idfinalidad';
	public $timestamps = false;

	public static function comboList() {
		return CatFinalidad::orderBy('finalidad')->where('status', 1)->lists('finalidad', 'idfinalidad');
	}

}
