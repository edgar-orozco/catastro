<?php

class CatEntrepisos extends \Eloquent {

	protected $connection = 'corevat';
	protected $fillable = [];
	protected $table = 'cat_entrepisos';
	protected $primaryKey = 'identrepiso';
	public $timestamps = false;

	public static function comboList() {
		return CatEntrepisos::orderBy('entrepiso')->where('status_entrepiso', 1)->lists('entrepiso', 'identrepiso');
	}

}
