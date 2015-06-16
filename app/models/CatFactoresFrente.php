<?php

class CatFactoresFrente extends \Eloquent {

	protected $connection = 'corevat';
	protected $fillable = [];
	protected $table = 'cat_factores_frente';
	protected $primaryKey = 'idfactorfrente';
	public $timestamps = false;

	public static function comboList() {
		return CatFactoresFrente::orderBy('factor_frente')->where('status_factor_frente', 1)->lists('factor_frente', 'idfactorfrente');
	}

	public static function getIdByValue($value) {
		$row = CatFactoresFrente::select('idfactorfrente')
				->where('valor_factor_frente', '=', $value)
				->where('status_factor_frente', '=', 1)
				->first();
		return $row->idfactorfrente;
	}
}
