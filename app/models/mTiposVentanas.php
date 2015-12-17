<?php

class mTiposVentanas extends \Eloquent 
{
	protected $table = 'mtiposventanasconstruccion';
	protected $primaryKey = 'id';
	public $timestamps = true;
	protected $fillable = ["descripcion", "clave"];
}
