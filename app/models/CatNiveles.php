<?php

class CatNiveles extends \Eloquent {

	protected $connection = 'corevat';
	protected $fillable = [];
	protected $table = 'cat_niveles';
	protected $primaryKey = 'idnivel';
	public $timestamps = false;

	public static function comboList() {
		return CatNiveles::orderBy('nivel')->where('status_nivel', 1)->lists('nivel', 'idnivel');
	}

}
