<?php

class mTiposConstruccion extends \Eloquent 
{
	protected $table = 'mtipos_construccion';
	protected $primaryKey = 'id';
	public $timestamps = true;
	protected $fillable = ["descripcion", "cve_tipo_construccion", "grupo_tipoconstruccion"];
}
