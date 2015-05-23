<?php

class CatClaseGeneralInmueble extends \Eloquent {

	protected $connection = 'corevat';
	protected $fillable = [];
	protected $table = 'cat_clase_general_inmueble';
	protected $primaryKey = 'idclasegeneralinmueble';
	public $timestamps = false;

	public static function comboList() {
		return CatClaseGeneralInmueble::orderBy('clase_general_inmueble')->where('status_clase_general_inmueble', 1)->lists('clase_general_inmueble', 'idclasegeneralinmueble');
	}

}
