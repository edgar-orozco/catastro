<?php

class CatOrientaciones extends \Eloquent {
	protected $connection = 'corevat';
	protected $fillable = [];
	protected $table = 'cat_orientaciones';
	protected $primaryKey = 'idorientacion';
	public $timestamps = false;
}