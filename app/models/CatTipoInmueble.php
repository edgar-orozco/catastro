<?php

class CatTipoInmueble extends \Eloquent {
	protected $connection = 'corevat';
	protected $fillable = [];
	protected $table = 'cat_tipo_inmueble';
	protected $primaryKey = 'idtipoinmueble';
	public $timestamps = false;
	
	public static function comboList() {
		return CatTipoInmueble::orderBy('tipo_inmueble')->where('status_tipo_inmueble', 1)->lists('tipo_inmueble', 'idtipoinmueble');
	}
}