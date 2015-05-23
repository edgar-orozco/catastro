<?php

class CatCalidadProyecto extends \Eloquent {

	protected $connection = 'corevat';
	protected $fillable = [];
	protected $table = 'cat_calidad_proyecto';
	protected $primaryKey = 'idcalidadproyecto';
	public $timestamps = false;

	public static function comboList() {
		return CatCalidadProyecto::orderBy('calidad_proyecto')->where('status_calidad_proy', 1)->lists('calidad_proyecto', 'idcalidadproyecto');
	}

}
