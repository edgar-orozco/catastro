<?php

class Avaluos extends \Eloquent {

	protected $connection = 'corevat';
	protected $fillable = [];
	protected $table = 'avaluos';
	protected $primaryKey = 'idavaluo';
	public $timestamps = false;

	public function AvaluosZona() {
		return $this->hasOne('AvaluosZona', 'idavaluo', 'idavaluo');
	}

	public function AvaluosInmueble() {
		return $this->hasOne('AvaluosInmueble', 'idavaluo', 'idavaluo');
	}

	public function AvaluosMercado() {
		return $this->hasOne('AvaluosMercado', 'idavaluo', 'idavaluo');
	}

	public function AvaluosFisico() {
		return $this->hasOne('AvaluosFisico', 'idavaluo', 'idavaluo');
	}

	public function AvaluosConclusiones() {
		return $this->hasOne('AvaluosConclusiones', 'idavaluo', 'idavaluo');
	}

	public function AvaluosFotos() {
		return $this->hasOne('AvaluosFotos', 'idavaluo', 'idavaluo');
	}

	public function getAvaluo($id) {
		return Avaluos::select('avaluos.*', 'estados.estado', 'municipios.municipio', 'cat_tipo_inmueble.tipo_inmueble', 'cat_regimen_propiedad.regimen_propiedad')
						->leftJoin('estados', 'avaluos.idestado', '=', 'estados.idestado')
						->leftJoin('municipios', 'avaluos.idmunicipio', '=', 'municipios.idmunicipio')
						->leftJoin('cat_tipo_inmueble', 'avaluos.idtipoinmueble', '=', 'cat_tipo_inmueble.idtipoinmueble')
						->leftJoin('cat_regimen_propiedad', 'avaluos.idregimenpropiedad', '=', 'cat_regimen_propiedad.idregimenpropiedad')
						->where('avaluos.idavaluo', '=', $id)
						->orderBy('avaluos.idavaluo')
						->get();
	}

}
