<?php

class CatTipoInmueble extends \Eloquent {
	protected $connection = 'corevat';
	protected $fillable = [];
	protected $table = 'cat_tipo_inmueble';
	protected $primaryKey = 'idtipoinmueble';
	public $timestamps = false;
}