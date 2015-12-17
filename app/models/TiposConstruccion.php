<?php

class TiposConstruccion extends \Eloquent 
{
	protected $table = 'ftipos_construccion';
	protected $primaryKey = 'id';
	public $timestamps = true;
	protected $fillable = ["descripcion", "cve_tipo_construccion", "grupo_tipoconstruccion"];
}
