<?php

class CatProximidadUrbana extends \Eloquent {

	protected $connection = 'corevat';
	protected $fillable = [];
	protected $table = 'cat_proximidad_urbana';
	protected $primaryKey = 'idproximidadurbana';
	public $timestamps = false;

	public static function comboList() {
		return CatProximidadUrbana::orderBy('proximidad_urbana')->where('status_proximidad_urbana', 1)->lists('proximidad_urbana', 'idproximidadurbana');
	}

}
