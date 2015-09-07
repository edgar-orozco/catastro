<?php

class AvaluosMercado extends \Eloquent {

	protected $connection = 'corevat';
	protected $fillable = [];
	protected $table = 'avaluo_enfoque_mercado';
	protected $primaryKey = 'idavaluoenfoquemercado';
	public $timestamps = false;

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function AemCompTerrenos() {
		return $this->hasMany('AemCompTerrenos', 'idavaluoenfoquemercado', 'idavaluoenfoquemercado')->orderBy('idaemcompterreno');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function AemHomologacion() {
		return $this->hasMany('AemHomologacion', 'idavaluoenfoquemercado', 'idavaluoenfoquemercado')->orderBy('idaemcompterreno')->orderBy('idaemhomologacion');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function AemInformacion() {
		return $this->hasMany('AemInformacion', 'idavaluoenfoquemercado', 'idavaluoenfoquemercado')->orderBy('idaeminformacion');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function AemAnalisis() {
		return $this->hasMany('AemAnalisis', 'idavaluoenfoquemercado', 'idavaluoenfoquemercado')->orderBy('idaeminformacion')->orderBy('idaemanalisis');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public static function getAvaluoMercadoByFkAvaluo($idavaluo) {
		return AvaluosMercado::select('*')->where('idavaluo', '=', $idavaluo)->orderBy('idavaluoenfoquemercado')->first();
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getAvaluosMercadoByFk($fk) {
		return AvaluosMercado::select('avaluo_inmueble.*', 'cat_usos_suelos.usos_suelos', 'cat_niveles.nivel', 'cat_cimentaciones.cimentacion', 'cat_estructuras.estructura', 'cat_muros.muro', 'cat_entrepisos.entrepiso', 'cat_techos.techo', 'cat_bardas.barda')
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
