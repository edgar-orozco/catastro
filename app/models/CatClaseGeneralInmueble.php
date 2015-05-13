<?php

class CatClaseGeneralInmueble extends \Eloquent {
	protected $connection = 'corevat';
	protected $fillable = [];
	protected $table = 'cat_clase_general_inmueble';
	protected $primaryKey = 'idclasegeneralinmueble';
	public $timestamps = false;
}