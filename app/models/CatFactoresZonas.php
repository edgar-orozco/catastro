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

	public static function getCatFactoresZonasComboList() {
		$rows = CatFactoresZonas::select('idfactorzona', 'valor_factor_zona', 'factor_zona')
						->where('status_factor_zona', '=', 1)
						->orderBy('valor_factor_zona')
						->get();
				foreach ($rows as $key => $value) {
					$res[$value->idfactorzona] = $value->factor_zona . ' (' . $value->valor_factor_zona .')';
				}
		return $res;
	}
}
