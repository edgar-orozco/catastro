<?php

class Empresas extends \Eloquent {
	protected $connection = 'corevat';
	protected $fillable = [];
	protected $table = 'empresas';
	protected $primaryKey = 'idemp';
	public $timestamps = false;
}