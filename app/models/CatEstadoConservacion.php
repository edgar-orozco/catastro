<?php

class CatEstadoConservacion extends \Eloquent {
	protected $connection = 'corevat';
	protected $fillable = [];
	protected $table = 'cat_estado_conservacion';
	protected $primaryKey = 'idestadoconservacion';
	public $timestamps = false;
}