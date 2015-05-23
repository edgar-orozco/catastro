<?php

class CatPisos extends \Eloquent {

	protected $connection = 'corevat';
	protected $fillable = [];
	protected $table = 'cat_pisos';
	protected $primaryKey = 'idpiso';
	public $timestamps = false;

	public static function comboList() {
		return CatPisos::orderBy('piso')->where('status_piso', 1)->lists('piso', 'idpiso');
	}

}
