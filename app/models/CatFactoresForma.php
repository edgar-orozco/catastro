<?php

class CatFactoresForma extends \Eloquent {

	protected $connection = 'corevat';
	protected $fillable = [];
	protected $table = 'cat_factores_forma';
	protected $primaryKey = 'idfactorforma';
	public $timestamps = false;

	public static function comboList() {
		return CatFactoresForma::orderBy('factor_forma')->where('status_factor_forma', 1)->lists('factor_forma', 'idfactorforma');
	}

	public static function getIdByValue($value) {
		$row = CatFactoresForma::select('idfactorforma')
				->where('valor_factor_forma', '=', $value)
				->where('status_factor_forma', '=', 1)
				->first();
		return $row->idfactorforma;
	}
}
