<?php

class mTiposUsosConstruccion extends \Eloquent 
{
	protected $table = 'mtiposusosconstruccion';
	protected $primaryKey = 'id';
	public $timestamps = true;
	protected $fillable = ["descripcion", "clave"];
}
