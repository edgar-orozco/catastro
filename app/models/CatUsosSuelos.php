<?php

class CatUsosSuelos extends \Eloquent {

	protected $connection = 'corevat';
	protected $fillable = [];
	protected $table = 'cat_usos_suelos';
	protected $primaryKey = 'idusossuelos';
	public $timestamps = false;

	public static function comboList() {
		return CatUsosSuelos::orderBy('usos_suelos')->where('status_usos_suelos', 1)->lists('usos_suelos', 'idusossuelos');
	}

}
