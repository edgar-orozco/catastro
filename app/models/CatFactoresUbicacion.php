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

	public static function getCatFactoresUbicacionComboList() {
		$rows = CatFactoresUbicacion::select('idfactorubicacion', 'valor_factor_ubicacion', 'factor_ubicacion')
						->where('status_factor_ubicacion', '=', 1)
						->orderBy('valor_factor_ubicacion')
						->get();
				foreach ($rows as $key => $value) {
					$res[$value->idfactorubicacion] = $value->factor_ubicacion . ' (' . $value->valor_factor_ubicacion .')';
				}
		return $res;
	}
}
