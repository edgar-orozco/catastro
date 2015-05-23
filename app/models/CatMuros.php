<?php

class CatMuros extends \Eloquent {

	protected $connection = 'corevat';
	protected $fillable = [];
	protected $table = 'cat_muros';
	protected $primaryKey = 'idmuro';
	public $timestamps = false;

	public static function comboList() {
		return CatMuros::orderBy('muro')->where('status_muro', 1)->lists('muro', 'idmuro');
	}

}
