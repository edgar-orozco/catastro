<?php

class AvaluosFotos extends \Eloquent {

	protected $connection = 'corevat';
	protected $fillable = [];
	protected $table = 'avaluo_fotos_planos';
	protected $primaryKey = 'idavaluofotosplano';
	public $timestamps = false;

}
