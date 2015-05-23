<?php

class CatOrientaciones extends \Eloquent {

	protected $connection = 'corevat';
	protected $fillable = [];
	protected $table = 'cat_orientaciones';
	protected $primaryKey = 'idorientacion';
	public $timestamps = false;

	public static function comboList() {
		return CatOrientaciones::orderBy('orientacion')->where('status_orientacion', 1)->lists('orientacion', 'idorientacion');
	}

}
