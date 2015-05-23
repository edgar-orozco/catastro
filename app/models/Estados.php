<?php

class Estados extends \Eloquent {

	protected $connection = 'corevat';
	protected $fillable = [];
	protected $table = 'estados';
	protected $primaryKey = 'idestado';
	public $timestamps = false;

	public static function comboList() {
		return Estados::orderBy('estado')->lists('estado', 'idestado');
	}
	
	public function municipiosComboList () {
		$rows = Estados::hasMany('Municipios', 'idestado', 'idestado');
		return $rows;
	}

}
