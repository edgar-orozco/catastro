<?php

class CatConstrucciones extends \Eloquent {

	protected $connection = 'corevat';
	protected $fillable = [];
	protected $table = 'cat_construcciones';
	protected $primaryKey = 'idconstruccion';
	public $timestamps = false;

	public static function comboList() {
		return CatConstrucciones::orderBy('clasificacion_zona')->where('status_clasificacion_zona', 1)->lists('clasificacion_zona', 'idconstruccion');
	}

}
