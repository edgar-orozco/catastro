<?php

class mTiposInstalacionesEspeciales extends \Eloquent 
{
	protected $table = 'mtiposinstalacionesespeciales';
	protected $primaryKey = 'id';
	public $timestamps = true;
	protected $fillable = ["descripcion", "clave"];
}
