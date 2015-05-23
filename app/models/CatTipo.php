<?php

class CatTipo extends \Eloquent {

	protected $connection = 'corevat';
	protected $fillable = [];
	protected $table = 'cat_tipo';
	protected $primaryKey = 'idtipo';
	public $timestamps = false;

	public static function comboList() {
		return CatTipo::orderBy('tipo')->where('status_tipo', 1)->lists('tipo', 'idtipo');
	}

}
