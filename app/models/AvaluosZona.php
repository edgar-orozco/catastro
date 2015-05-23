<?php

class AvaluosZona extends \Eloquent {

	protected $connection = 'corevat';
	protected $fillable = [];
	protected $table = 'avaluo_zona';
	protected $primaryKey = 'idavaluozona';
	public $timestamps = false;

	public function getAvaluosZonaByFk($fk) {
		return AvaluosZona::select('avaluo_zona.*', 'cat_clasificacion_zona.clasificacion_zona', 'cat_proximidad_urbana.proximidad_urbana')
						->leftJoin('avaluos', 'avaluo_zona.idavaluo', '=', 'avaluos.idavaluo')
						->leftJoin('cat_clasificacion_zona', 'avaluo_zona.idclasificacionzona', '=', 'cat_clasificacion_zona.idclasificacionzona')
						->leftJoin('cat_proximidad_urbana', 'avaluos.idproximidadurbana', '=', 'cat_proximidad_urbana.idproximidadurbana')
						->where('avaluo_zona.idavaluo', '=', $fk)
						->orderBy('avaluo_zona.idavaluozona')
						->get();
	}

}
