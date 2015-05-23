<?php

class CatCimentaciones extends \Eloquent {

	protected $connection = 'corevat';
	protected $fillable = [];
	protected $table = 'cat_cimentaciones';
	protected $primaryKey = 'idcimentacion';
	public $timestamps = false;

	public static function comboList() {
		return CatCimentaciones::orderBy('cimentacion')->where('status_cimentacion', 1)->lists('cimentacion', 'idcimentacion');
	}

}
