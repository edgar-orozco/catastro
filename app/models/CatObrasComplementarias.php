<?php

class CatObrasComplementarias extends \Eloquent {

	protected $connection = 'corevat';
	protected $fillable = [];
	protected $table = 'cat_obras_complementarias';
	protected $primaryKey = 'idobracomplementaria';
	public $timestamps = false;

	public static function comboList() {
		return CatObrasComplementarias::orderBy('obra_complementaria')->where('status_obra_complementaria', 1)->lists('obra_complementaria', 'idobracomplementaria');
	}

}
