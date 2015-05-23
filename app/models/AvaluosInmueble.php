<?php

class AvaluosInmueble extends \Eloquent {

	protected $connection = 'corevat';
	protected $fillable = [];
	protected $table = 'avaluo_inmueble';
	protected $primaryKey = 'idavaluoinmueble';
	public $timestamps = false;

	public function AiMedidasColindancias() {
		return $this->hasOne('AiMedidasColindancias', 'idavaluoinmueble', 'idavaluoinmueble');
	}

	public function getAvaluosInmuebleByFk($fk) {
		return AvaluosInmueble::select('avaluo_inmueble.*', 'cat_usos_suelos.usos_suelos', 'cat_niveles.nivel', 'cat_cimentaciones.cimentacion', 'cat_estructuras.estructura', 'cat_muros.muro', 'cat_entrepisos.entrepiso', 'cat_techos.techo', 'cat_bardas.barda')
						->leftJoin('avaluos', 'avaluo_inmueble.idavaluo', '=', 'avaluos.idavaluo')
						->leftJoin('cat_usos_suelos', 'avaluo_inmueble.idusossuelo', '=', 'cat_usos_suelos.idusossuelos')
						->leftJoin('cat_niveles', 'avaluo_inmueble.numero_niveles_unidad', '=', 'cat_niveles.idnivel')
						->leftJoin('cat_cimentaciones', 'avaluo_inmueble.id_cimentacion', '=', 'cat_cimentaciones.idcimentacion')
						->leftJoin('cat_estructuras', 'avaluo_inmueble.id_estructura', '=', 'cat_estructuras.idestructura')
						->leftJoin('cat_muros', 'avaluo_inmueble.id_muro', '=', 'cat_muros.idmuro')
						->leftJoin('cat_entrepisos', 'avaluo_inmueble.id_entrepiso', '=', 'cat_entrepisos.identrepiso')
						->leftJoin('cat_techos', 'avaluo_inmueble.id_techo', '=', 'cat_techos.idtecho')
						->leftJoin('cat_bardas', 'avaluo_inmueble.id_barda', '=', 'cat_bardas.idbarda')
						->where('avaluo_inmueble.idavaluo', '=', $fk)
						->orderBy('avaluo_inmueble.idavaluoinmueble')
						->get();
	}

}
