<?php

class CatAcabados extends \Eloquent {

	protected $connection = 'corevat';
	protected $fillable = ['nombre', 'estatus'];
	protected $table = 'cat_acabados';
	protected $primaryKey = 'id';
	public $timestamps = true;

	public static function comboList() {
		return CatAcabados::orderBy('nombre')->where('estatus', 'true')->lists('nombre', 'id');
	}

}
