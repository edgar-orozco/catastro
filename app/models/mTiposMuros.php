<?php

class mTiposMuros extends \Eloquent 
{
	protected $table = 'mtiposmurosconstruccion';
	protected $primaryKey = 'id';
	public $timestamps = true;
	protected $fillable = ["descripcion", "clave"];
}
