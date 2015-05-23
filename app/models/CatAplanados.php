<?php

class CatAplanados extends \Eloquent {

	protected $connection = 'corevat';
	protected $fillable = [];
	protected $table = 'cat_aplanados';
	protected $primaryKey = 'idaplanado';
	public $timestamps = false;

	public static function comboList() {
		return CatAplanados::orderBy('aplanado')->where('status', 1)->lists('aplanado', 'idaplanado');
	}

}
