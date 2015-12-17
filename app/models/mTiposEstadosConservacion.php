<?php

class mTiposEstadosConservacion extends \Eloquent 
{
	protected $table = 'mtiposestadosconservacion';
	protected $primaryKey = 'id';
	public $timestamps = true;
	protected $fillable = ["descripcion", "clave"];
}
