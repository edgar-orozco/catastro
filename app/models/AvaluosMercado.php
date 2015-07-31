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

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public static function updateAemValorUnitario($idavaluoenfoquemercado) {
		//$x = $y = 0;
		$rowAemHomologacion = AemHomologacion::select(DB::raw('avg(valor_unitario_resultante_m2) AS avg'))->groupBy('idavaluoenfoquemercado')->where('idavaluoenfoquemercado', '=', $idavaluoenfoquemercado)->where('in_promedio', '>=', 0)->first();
		$z = isset($rowAemHomologacion->avg) ? $rowAemHomologacion->avg : 0;

		$rowAemHomologacion = AemHomologacion::select(DB::raw('avg(valor_unitario_resultante_m2) AS avg'))->groupBy('idavaluoenfoquemercado')->where('idavaluoenfoquemercado', '=', $idavaluoenfoquemercado)->where('in_promedio', '=', 1)->first();
		$x = isset($rowAemHomologacion->avg) ? $rowAemHomologacion->avg : 0;

		if ($x >= 0 && $x <= 9) {
			$y = 0;
		} else if ($x >= 10 && $x <= 99) {
			$y = -1;
		} else if ($x >= 100 && $x <= 999) {
			$y = -2;
		} else if ($x >= 1000 && $x <= 9999) {
			$y = 0;
		} else if ($x >= 10000 && $x <= 99999) {
			$y = -1;
		} else {
			$y = 0;
		}

		$rowAem = AvaluosMercado::find($idavaluoenfoquemercado);
		$rowAem->valor_unitario_promedio = $z;
		$rowAem->valor_aplicado_m2 = round($x, $y);
		$rowAem->save();
		
		$rowAvaluosConclusiones = Avaluos::find($rowAem->idavaluo)->AvaluosConclusiones;
		$rowAvaluosConclusiones->valor_mercado = 0;
		$rowAvaluosConclusiones->save();
		
		$rowAvaluosFisico = Avaluos::find($rowAem->idavaluo)->AvaluosFisico;
		$rowAvaluosFisico->valor_unitario_promedio = $rowAem->valor_unitario_promedio;
		$rowAvaluosFisico->valor_aplicado_m2 = $rowAem->valor_aplicado_m2;
		$rowAvaluosFisico->save();
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public static function delAvaluoEnfoqueMercado($idavaluo) {
		$success = true;
		$rowMercado = Avaluos::findOrFail($idavaluo)->AvaluosMercado;
		if (count($rowMercado) > 0) {
			AemHomologacion::where('idavaluoenfoquemercado', '=', $rowMercado->idavaluoenfoquemercado)->delete();
			AemCompTerrenos::where('idavaluoenfoquemercado', '=', $rowMercado->idavaluoenfoquemercado)->delete();
			AemAnalisis::where('idavaluoenfoquemercado', '=', $rowMercado->idavaluoenfoquemercado)->delete();
			AemInformacion::where('idavaluoenfoquemercado', '=', $rowMercado->idavaluoenfoquemercado)->delete();
		}
		AvaluosMercado::where('idavaluo', '=', $idavaluo)->delete();
		return $success;
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public static function insAvaluoMercado($idavaluo) {
		$row = new AvaluosMercado();
		$row->idavaluo = $idavaluo;
		$row->promedio_directo = $row->valor_unitario_promedio = $row->valor_aplicado_m2 = $row->minimo_directo = 0.00;
		$row->maximo_directo = $row->promedio_analisis = $row->minimo_analisis = $row->maximo_analisis = 0.00;
		$row->monto_unitario_aplicable = $row->superficie_construida = $row->valor_comparativo_mercado = 0.00;
		$row->superfice_terreno_avaluo = $row->superficie_construccion_avaluo = $row->promedio_unitario = 0.00;
		$row->superficie_terreno = 0.0000;
		$row->ip = $_SERVER['REMOTE_ADDR'];
		$row->host = isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : '';
		$row->creado_por = Auth::id();
		$row->creado_el = date('Y-m-d H:i:s');
		$row->save();
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public static function avaluosEnfoqueMercadoBeforeUpdate($idavaluo, &$rowAem) {
		$rowAvaluosInmueble = Avaluos::find($idavaluo)->AvaluosInmueble;
		if ($rowAvaluosInmueble->superficie_construccion > 0) {
			$rowAem->superficie_construida = $rowAvaluosInmueble->superficie_construccion;
			$rowAem->valor_comparativo_mercado = round(($rowAvaluosInmueble->superficie_construccion * $rowAem->promedio_analisis), -1);
		} else {
			$rowAem->superficie_terreno = $rowAvaluosInmueble->superficie_terreno;
			$rowAem->valor_comparativo_mercado = round(($rowAvaluosInmueble->superficie_terreno * $rowAem->valor_aplicado_m2), -1);
		}
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public static function avaluosEnfoqueMercadoAfterUpdate($idavaluo, &$rowAem) {
		$rowAvaluosConclusiones = Avaluos::find($idavaluo)->AvaluosConclusiones;
		$rowAvaluosConclusiones->valor_mercado = $rowAem->valor_unitario_promedio;
		$rowAvaluosConclusiones->save();

		$rowAvaluosFisico = Avaluos::find($idavaluo)->AvaluosFisico;
		$rowAvaluosFisico->valor_unitario_promedio = $rowAem->valor_unitario_promedio;
		$rowAvaluosFisico->valor_aplicado_m2 = $rowAem->valor_aplicado_m2;
		$rowAvaluosFisico->save();

		// $rowAvaluosMercado = Avaluos::find($idavaluo)->AvaluosMercado;
		// $rowAvaluosMercado->valor_unitario_promedio = $rowAem->valor_unitario_promedio;
		// $rowAvaluosMercado->valor_aplicado_m2 = $rowAem->valor_aplicado_m2;
		// $rowAvaluosMercado->save();

	}

}
