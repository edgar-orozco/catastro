<?php

class CatClasificacionZona extends \Eloquent {

	protected $connection = 'corevat';
	protected $fillable = [];
	protected $table = 'cat_clasificacion_zona';
	protected $primaryKey = 'idclasificacionzona';
	public $timestamps = false;

	public static function comboList() {
		return CatClasificacionZona::orderBy('clasificacion_zona')->where('status_clasificacion_zona', 1)->lists('clasificacion_zona', 'idclasificacionzona');
	}

}
