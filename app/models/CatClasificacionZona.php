<?php

class CatClasificacionZona extends \Eloquent {
	protected $connection = 'corevat';
	protected $fillable = [];
	protected $table = 'cat_clasificacion_zona';
	protected $primaryKey = 'idclasificacionzona';
	public $timestamps = false;
}