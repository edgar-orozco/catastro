<?php

class mTiposPuertas extends \Eloquent 
{
	protected $table = 'mtipospuertasconstruccion';
	protected $primaryKey = 'id';
	public $timestamps = true;
	protected $fillable = ["descripcion", "clave"];
}
