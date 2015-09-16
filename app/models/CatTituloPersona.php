<?php

class CatTituloPersona extends \Eloquent {

	protected $connection = 'corevat';
	protected $fillable = [];
	protected $table = 'cat_titulo_persona';
	protected $primaryKey = 'idtitulopersona';
	public $timestamps = false;

	public static function comboList() {
		return CatTituloPersona::orderBy('titulo_persona')->where('status', 1)->lists('titulo_persona', 'idtitulopersona');
	}

}
