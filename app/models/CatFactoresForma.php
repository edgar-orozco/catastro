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

	public static function getCatFactoresFormaComboList() {
		$rows = CatFactoresForma::select('idfactorforma', 'valor_factor_forma', 'factor_forma')
						->where('status_factor_forma', '=', 1)
						->orderBy('valor_factor_forma')
						->get();
				foreach ($rows as $key => $value) {
					$res[$value->idfactorforma] = $value->factor_forma . ' (' . $value->valor_factor_forma .')';
				}
		return $res;
	}
}
