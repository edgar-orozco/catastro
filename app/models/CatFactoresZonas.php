<?php

class CatFactoresZonas extends \Eloquent {

	protected $connection = 'corevat';
	protected $fillable = [];
	protected $table = 'cat_factores_zonas';
	protected $primaryKey = 'idfactorzona';
	public $timestamps = false;

	public static function comboList() {
		return CatFactoresZonas::orderBy('factor_zona')->where('status_factor_zona', 1)->lists('valor_factor_zona', 'idfactorzona');
	}

	public static function getIdByValue($value) {
		$row = CatFactoresZonas::select('idfactorzona')
				->where('valor_factor_zona', '=', $value)
				->where('status_factor_zona', '=', 1)
				->first();
		return $row->idfactorzona;
	}
}
