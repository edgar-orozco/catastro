<?php

class AemInformacion extends \Eloquent {

	protected $connection = 'corevat';
	protected $fillable = [];
	protected $table = 'aem_informacion';
	protected $primaryKey = 'idaeminformacion';
	public $timestamps = false;

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function AemAnalisis() {
		return $this->hasOne('AemAnalisis', 'idaeminformacion', 'idaeminformacion');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public static function getAemInformacionByFk($idavaluoenfoquemercado) {
		return AemInformacion::select('*')
						->where('idavaluoenfoquemercado', '=', $idavaluoenfoquemercado)
						->orderBy('idaeminformacion')
						->get();
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public static function getAemAnalisisByFk($idavaluoenfoquemercado) {
		return AemAnalisis::select('aem_analisis.*')
						->join('aem_informacion', 'aem_analisis.idaeminformacion', '=', 'aem_informacion.idaeminformacion')
						->where('aem_informacion.idavaluoenfoquemercado', '=', $idavaluoenfoquemercado)
						->orderBy('aem_analisis.idaemanalisis')
						->get();
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public static function insAemInformacion($inputs) {
		$rowAemInformacion = new AemInformacion();
		$rowAemInformacion->idavaluoenfoquemercado = $inputs['idavaluoenfoquemercado3'];
		$rowAemInformacion->ubicacion = $inputs['ubicacion_aeminformacion'];
		$rowAemInformacion->edad = $inputs['edad'];
		$rowAemInformacion->telefono = $inputs['telefono'];
		$rowAemInformacion->observaciones = $inputs['observaciones_aeminformacion'];
		$rowAemInformacion->created_at = $inputs["created_at"];
		$rowAemInformacion->save();
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $inputs
	 * @return Response
	 */
	public static function updInformacion($inputs) {
		$rowAemInformacion = AemInformacion::find($inputs['idaeminformacion']);
		$rowAemInformacion->ubicacion = $inputs['ubicacion_aeminformacion'];
		$rowAemInformacion->edad = $inputs['edad'];
		$rowAemInformacion->telefono = $inputs['telefono'];
		$rowAemInformacion->observaciones = $inputs['observaciones_aeminformacion'];
		$rowAemInformacion->updated_at = $inputs["updated_at"];
		$rowAemInformacion->save();
	}

	public static function getAjaxAemInformacionByFk($fk) {
		$pato = array();
		$rows = AemInformacion::select(
						'aem_informacion.idaeminformacion', 'aem_informacion.ubicacion', 'aem_informacion.edad', 'aem_informacion.telefono', 'aem_informacion.observaciones')
				->where('aem_informacion.idavaluoenfoquemercado', '=', $fk)
				->orderBy('aem_informacion.idaeminformacion')
				->get();
		$count = count($rows);
		$i = 0;
		foreach ($rows as $row) {
			$pato[] = array(
				++$i,
				$row['idaeminformacion'],
				$row['ubicacion'],
				$row['edad'],
				$row['telefono'],
				$row['observaciones'],
				'<a class="btn btn-xs btn-info btnEdit"  title="Editar" onclick="$.editAemInformacion(' . $row['idaeminformacion'] . ');"><i class="glyphicon glyphicon-pencil"></i></a>',
				'<a class="btn btn-xs btn-danger btnDel" title="Eliminar" onclick="$.delAemInformacion(' . $row['idaeminformacion'] . ');"><i class="glyphicon glyphicon-remove"></i></a>');
		}
		$res = array(
			"draw" => 1,
			"recordsTotal" => $count,
			"recordsFiltered" => $count,
			"data" => $pato
		);
		return $res;
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public static function clonarAemInformacion($idavaluoenfoquemercadoold, $idavaluoenfoquemercadonew) {
		$rowsAemInformacionOld = AemInformacion::select('*')->where('idavaluoenfoquemercado', '=', $idavaluoenfoquemercadoold)->get();
		foreach ($rowsAemInformacionOld as $rowAemInformacionOld) {
			AemInformacion::clonarAemInformacionIns($idavaluoenfoquemercadonew, $rowAemInformacionOld);
		}
	}

	private static function clonarAemInformacionIns($idavaluoenfoquemercadonew, $rowAemInformacionOld) {
		$rowAemInformacionNew = new AemInformacion();
		$rowAemInformacionNew->idavaluoenfoquemercado = $idavaluoenfoquemercadonew;
		$rowAemInformacionNew->ubicacion = $rowAemInformacionOld->ubicacion;
		$rowAemInformacionNew->edad = $rowAemInformacionOld->edad;
		$rowAemInformacionNew->telefono = $rowAemInformacionOld->telefono;
		$rowAemInformacionNew->observaciones = $rowAemInformacionOld->observaciones;
		$rowAemInformacionNew->save();
		AemInformacion::clonarAemAnalisisUpd($rowAemInformacionOld->idaeminformacion, $rowAemInformacionNew->idaeminformacion);
	}

	private static function clonarAemAnalisisUpd($idaeminformacionold, $idaeminformacionnew) {
		$rowAemAnalisisOld = AemInformacion::find($idaeminformacionold)->AemAnalisis;
		$rowAemAnalisisNew = AemInformacion::find($idaeminformacionnew)->AemAnalisis;
		$rowAemAnalisisNew->precio_venta = $rowAemAnalisisOld->precio_venta;
		$rowAemAnalisisNew->superficie_terreno = $rowAemAnalisisOld->superficie_terreno;
		$rowAemAnalisisNew->superficie_construccion = $rowAemAnalisisOld->superficie_construccion;
		$rowAemAnalisisNew->valor_unitario_m2 = $rowAemAnalisisOld->valor_unitario_m2;
		$rowAemAnalisisNew->factor_zona = $rowAemAnalisisOld->factor_zona;
		$rowAemAnalisisNew->factor_ubicacion = $rowAemAnalisisOld->factor_ubicacion;
		$rowAemAnalisisNew->factor_superficie = $rowAemAnalisisOld->factor_superficie;
		$rowAemAnalisisNew->factor_edad = $rowAemAnalisisOld->factor_edad;
		$rowAemAnalisisNew->factor_conservacion = $rowAemAnalisisOld->factor_conservacion;
		$rowAemAnalisisNew->factor_negociacion = $rowAemAnalisisOld->factor_negociacion;
		$rowAemAnalisisNew->factor_resultante = $rowAemAnalisisOld->factor_resultante;
		$rowAemAnalisisNew->valor_unitario_resultante_m2 = $rowAemAnalisisOld->valor_unitario_resultante_m2;
		$rowAemAnalisisNew->in_promedio = $rowAemAnalisisOld->in_promedio;
		$rowAemAnalisisNew->fk_zona = $rowAemAnalisisOld->fk_zona;
		$rowAemAnalisisNew->fk_ubicacion = $rowAemAnalisisOld->fk_ubicacion;
		$rowAemAnalisisNew->fk_conservacion = $rowAemAnalisisOld->fk_conservacion;
		$rowAemAnalisisNew->save();
	}
}
