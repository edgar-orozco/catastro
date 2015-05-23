<?php

class AemAnalisis extends \Eloquent {

	protected $connection = 'corevat';
	protected $fillable = [];
	protected $table = 'aem_analisis';
	protected $primaryKey = 'idaemanalisis';
	public $timestamps = false;

	public static function delByFk($idaeminformacion) {
		return AemAnalisis::delete($idaeminformacion);
		;
	}

}
