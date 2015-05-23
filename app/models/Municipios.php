<?php

class Municipios extends \Eloquent {

	protected $connection = 'corevat';
	protected $fillable = [];
	protected $table = 'municipios';
	protected $primaryKey = 'idmunicipio';
	public $timestamps = false;

	public static function comboList() {
		return Municipios::orderBy('municipio')->where('idestado', 1)->where('status', 1)->lists('municipio', 'idmunicipio');
	}

}
