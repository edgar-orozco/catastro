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

	public static function getCatFactoresFrenteComboList() {
		$rows = CatFactoresFrente::select('idfactorfrente', 'valor_factor_frente', 'factor_frente')
						->where('status_factor_frente', '=', 1)
						->orderBy('valor_factor_frente')
						->get();
				foreach ($rows as $key => $value) {
					$res[$value->idfactorfrente] = $value->factor_frente . ' (' . $value->valor_factor_frente .')';
				}
		return $res;
	}
}
