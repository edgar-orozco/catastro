<?php

class CatRegimenPropiedad extends \Eloquent {

	protected $connection = 'corevat';
	protected $fillable = [];
	protected $table = 'cat_regimen_propiedad';
	protected $primaryKey = 'idregimenpropiedad';
	public $timestamps = false;

	public static function comboList() {
		return CatRegimenPropiedad::orderBy('regimen_propiedad')->where('status_regimen_propiedad', 1)->lists('regimen_propiedad', 'idregimenpropiedad');
	}

}
