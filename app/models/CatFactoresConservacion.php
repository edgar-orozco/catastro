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

	public static function getCatFactoresConservacionComboList() {
		$rows = CatFactoresConservacion::select('idfactorconservacion', 'valor_factor_conservacion', 'factor_conservacion')
				->where('status_factor_conservacion', '=', 1)
				->orderBy('valor_factor_conservacion')
				->get();
		foreach ($rows as $key => $value) {
			$res[$value->idfactorconservacion] = $value->factor_conservacion . ' (' . $value->valor_factor_conservacion . ')';
		}
		return $res;
	}

}
