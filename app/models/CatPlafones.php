<?php

class CatPlafones extends \Eloquent {

	protected $connection = 'corevat';
	protected $fillable = [];
	protected $table = 'cat_plafones';
	protected $primaryKey = 'idplafon';
	public $timestamps = false;

	public static function comboList() {
		return CatPlafones::orderBy('plafon')->where('status_plafon', 1)->lists('plafon', 'idplafon');
	}

}
