<?php

class CatCalidadProyecto extends \Eloquent {
	protected $connection = 'corevat';
	protected $fillable = [];
	protected $table = 'cat_calidad_proyecto';
	protected $primaryKey = 'idcalidadproyecto';
	public $timestamps = false;
}