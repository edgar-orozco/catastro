<?php

class CatFactoresSuperficie extends \Eloquent {

	protected $connection = 'corevat';
	protected $fillable = [];
	protected $table = 'cat_factores_superficie';
	protected $primaryKey = 'idfactorsuperficie';
	public $timestamps = false;

	public static function comboList() {
		return CatFactoresSuperficie::orderBy('factor_frente')->where('status_factor_superficie', 1)->lists('text(minimo) || " " || text(maximo)', 'idfactorsuperficie');
	}

}
