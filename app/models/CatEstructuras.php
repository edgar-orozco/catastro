<?php

class CatEstructuras extends \Eloquent {

	protected $connection = 'corevat';
	protected $fillable = [];
	protected $table = 'cat_estructuras';
	protected $primaryKey = 'idestructura';
	public $timestamps = false;

	public static function comboList() {
		return CatEstructuras::orderBy('estructura')->where('status_estructura', 1)->lists('estructura', 'idestructura');
	}

}
