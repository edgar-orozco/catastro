<?php

class mTiposPisos extends \Eloquent 
{
	protected $table = 'mtipospisosconstruccion';
	protected $primaryKey = 'id';
	public $timestamps = true;
	protected $fillable = ["descripcion", "clave"];
}
