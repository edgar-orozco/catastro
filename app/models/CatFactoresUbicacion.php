<?php

class CatFactoresUbicacion extends \Eloquent {

	protected $connection = 'corevat';
	protected $fillable = [];
	protected $table = 'cat_factores_ubicacion';
	protected $primaryKey = 'idfactorubicacion';
	public $timestamps = false;

	public static function comboList() {
		return CatFactoresUbicacion::orderBy('factor_ubicacion')->where('status_factor_ubicacion', 1)->lists('factor_ubicacion', 'idfactorubicacion');
	}

	public static function getIdByValue($value) {
		$row = CatFactoresUbicacion::select('idfactorubicacion')
				->where('valor_factor_ubicacion', '=', $value)
				->where('status_factor_ubicacion', '=', 1)
				->first();
		return $row->idfactorubicacion;
	}
}
