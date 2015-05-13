<?php

class CatRegimenPropiedad extends \Eloquent {
	protected $connection = 'corevat';
	protected $fillable = [];
	protected $table = 'cat_regimen_propiedad';
	protected $primaryKey = 'idregimenpropiedad';
	public $timestamps = false;
}