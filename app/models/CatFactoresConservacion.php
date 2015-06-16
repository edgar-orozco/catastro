<?php

class CatFactoresConservacion extends \Eloquent {

	protected $connection = 'corevat';
	protected $fillable = [];
	protected $table = 'cat_factores_conservacion';
	protected $primaryKey = 'idfactorconservacion';
	public $timestamps = false;

	public static function comboList() {
		return CatFactoresConservacion::orderBy('factor_conservacion')->where('status_factor_conservacion', 1)->lists('factor_conservacion', 'idfactorconservacion');
	}

	public static function getIdByValue($value) {
		$row = CatFactoresConservacion::select('idfactorconservacion')
				->where('valor_factor_conservacion', '=', $value)
				->where('status_factor_conservacion', '=', 1)
				->first();
		return $row->idfactorconservacion;
	}
}
