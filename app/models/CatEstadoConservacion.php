<?php

class CatEstadoConservacion extends \Eloquent {

	protected $connection = 'corevat';
	protected $fillable = [];
	protected $table = 'cat_estado_conservacion';
	protected $primaryKey = 'idestadoconservacion';
	public $timestamps = false;

	public static function comboList() {
		return CatEstadoConservacion::orderBy('estado_conservacion')->where('status_estado_conservacion', 1)->lists('estado_conservacion', 'idestadoconservacion');
	}

}
