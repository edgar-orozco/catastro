<?php

class CatTechos extends \Eloquent {

	protected $connection = 'corevat';
	protected $fillable = [];
	protected $table = 'cat_techos';
	protected $primaryKey = 'idtecho';
	public $timestamps = false;

	public static function comboList() {
		return CatTechos::orderBy('techo')->where('status_techo', 1)->lists('techo', 'idtecho');
	}

}
