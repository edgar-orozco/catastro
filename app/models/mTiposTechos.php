<?php

class mTiposTechos extends \Eloquent 
{
	protected $table = 'mtipostechosconstruccion';
	protected $primaryKey = 'id';
	public $timestamps = true;
	protected $fillable = ["descripcion", "clave"];
}
