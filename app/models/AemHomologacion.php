<?php

class AemHomologacion extends \Eloquent {

	protected $connection = 'corevat';
	protected $fillable = [];
	protected $table = 'aem_homologacion';
	protected $primaryKey = 'idaemhomologacion';
	public $timestamps = false;

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public static function aemHomologacionBeforeInsert($idavaluoenfoquemercado, &$row) {
		$rowAvaluoEnfoqueMercado = AvaluosMercado::find($idavaluoenfoquemercado);
		$rowAvaluoInmueble = Avaluos::find($rowAvaluoEnfoqueMercado->idavaluo)->AvaluosInmueble;

		if ($rowAvaluoInmueble->superficie_total_terreno > 0) {
			$row->superficie = round(pow($row->superficie_terreno / $rowAvaluoInmueble->superficie_total_terreno, 0.166666666666667), 2);
			$row->valor_unitario_resultante_m2 = $row->valor_unitario * $row->zona * $row->ubicacion * $row->frente * $row->superficie * $row->valor_unitario_negociable;
		} else {
			$row->superficie = 0;
			$row->valor_unitario_resultante_m2 = 0;
		}
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public static function insAemHomologacion($idavaluoenfoquemercado, $idaemcompterreno, $ubicacion, $superficie_terreno, $precio_unitario_m2_terreno) {
		$row = new AemHomologacion();
		$row->idavaluoenfoquemercado = $idavaluoenfoquemercado;
		$row->idaemcompterreno = $idaemcompterreno;
		$row->comparable = $ubicacion;
		$row->superficie_terreno = $superficie_terreno;
		$row->superficie_construccion = $row->zona = $row->ubicacion = $row->frente = $row->forma = $row->valor_unitario_negociable = 0.00;
		$row->valor_unitario = $precio_unitario_m2_terreno;
		$row->in_promedio = 0;
		$row->idemp = 1;
		$row->ip = $_SERVER['REMOTE_ADDR'];
		$row->host = isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : '';
		$row->creado_por = Auth::Id();
		$row->creado_el = date('Y-m-d H:i:s');

		AemHomologacion::aemHomologacionBeforeInsert($idavaluoenfoquemercado, $row);

		$row->save();

		AvaluosMercado::updateAemValorUnitario($idavaluoenfoquemercado);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public static function aemHomologacionBeforeUpdate(&$superficie, $row, $inputs) {
		$rowAvaluoEnfoqueMercado = AvaluosMercado::find($row->idavaluoenfoquemercado);
		$rowAvaluoInmueble = Avaluos::find($rowAvaluoEnfoqueMercado->idavaluo)->AvaluosInmueble;

		if ($rowAvaluoInmueble->superficie_total_terreno > 0) {
			$superficie = round(pow($row->superficie_terreno / $rowAvaluoInmueble->superficie_total_terreno, 0.166666666666667), 2);
		} else {
			$superficie = 0;
		}
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $idavaluo
	 * @return Response
	 */
	public static function updAemHomologacionCascade($idavaluo) {
		$rowAvaluoInmueble = Avaluos::find($idavaluo)->AvaluosInmueble;
		$rowAvaluoMercado = Avaluos::find($idavaluo)->AvaluosMercado;

		$rowsAemHomologacion = AemHomologacion::select('*')->where('idavaluoenfoquemercado', '=', $rowAvaluoMercado->idavaluoenfoquemercado)->get();
		foreach ($rowsAemHomologacion as $row) {
			$rowAemHomologacion = AemHomologacion::find($row->idaemhomologacion);
			if ($rowAvaluoInmueble->superficie_total_terreno > 0) {
				$rowAemHomologacion->superficie = round(pow(($rowAemHomologacion->superficie_terreno / $rowAvaluoInmueble->superficie_total_terreno), 0.166666666666667), 2);
				$rowAemHomologacion->valor_unitario_resultante_m2 = $rowAemHomologacion->valor_unitario *
						$rowAemHomologacion->zona *
						$rowAemHomologacion->ubicacion *
						$rowAemHomologacion->frente * $rowAemHomologacion->forma *
						$rowAemHomologacion->superficie * $rowAemHomologacion->valor_unitario_negociable;
			} else {
				$rowAemHomologacion->superficie = 0;
				$rowAemHomologacion->valor_unitario_resultante_m2 = 0;
			}
			$rowAemHomologacion->save();
		}
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public static function updAemHomologacion($inputs, &$valor_unitario_promedio, &$valor_aplicado_m2) {
		$row = AemHomologacion::find($inputs["idaemhomologacion"]);
		AemHomologacion::aemHomologacionBeforeUpdate($superficie, $row, $inputs);
		$row->zona = $inputs["zona_aemhomologacion"];
		$row->ubicacion = $inputs["ubicacion_aemhomologacion"];
		$row->frente = $inputs["frente"];
		$row->forma = $inputs["forma"];
		$row->valor_unitario_negociable = $inputs["valor_unitario_negociable"];
		$row->in_promedio = isset($inputs["in_promedio_aemhomologacion"]) ? 1 : 0;
		$row->superficie = $superficie;
		$row->valor_unitario_resultante_m2 = $row->valor_unitario *
				$row->zona * $row->ubicacion *
				$row->frente * $row->forma *
				$row->superficie * $row->valor_unitario_negociable;
		$row->fk_zona = $inputs["idfactorzona_aemhomologacion"];
		$row->fk_ubicacion = $inputs["idfactorubicacion_aemhomologacion"];
		$row->fk_frente = $inputs["idfactorfrente"];
		$row->fk_forma = $inputs["idfactorforma"];

		$row->modi_por = Auth::Id();
		$row->modi_el = date('Y-m-d H:i:s');
		$row->save();
		AemHomologacion::aemHomologacionAfterUpdate($row->idavaluoenfoquemercado);

		$rowAem = AvaluosMercado::find($row->idavaluoenfoquemercado);
		$valor_unitario_promedio = $rowAem->valor_unitario_promedio;
		$valor_aplicado_m2 = $rowAem->valor_aplicado_m2;
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $idavaluoenfoquemercado
	 * @return Response
	 */
	public static function aemHomologacionAfterUpdate($idavaluoenfoquemercado) {
		AvaluosMercado::updateAemValorUnitario($idavaluoenfoquemercado);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public static function aemHomologacionBeforeDelete() {
		
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public static function delAemHomologacion() {
		
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public static function aemHomologacionAfterDelete() {
		
	}

	public static function getAjaxAemHomologacionByFk($fk) {
		$pato = array();
		$rows = AemHomologacion::select('aem_homologacion.idaemhomologacion', 'aem_homologacion.comparable', 'aem_homologacion.superficie_terreno', 'aem_homologacion.valor_unitario', 'aem_homologacion.zona', 'aem_homologacion.ubicacion', 'aem_homologacion.frente', 'aem_homologacion.forma', 'aem_homologacion.superficie', 'aem_homologacion.valor_unitario_negociable', 'aem_homologacion.valor_unitario_resultante_m2')
				->where('aem_homologacion.idavaluoenfoquemercado', '=', $fk)
				->orderBy('aem_homologacion.idaemcompterreno')
				->get();
		$count = count($rows);
		$i = 0;
		foreach ($rows as $row) {
			$pato[] = array(
				++$i,
				$row['idaemhomologacion'],
				$row['comparable'],
				$row['superficie_terreno'],
				$row['valor_unitario'],
				$row['zona'],
				$row['ubicacion'],
				$row['frente'],
				$row['forma'],
				$row['superficie'],
				$row['valor_unitario_negociable'],
				$row['valor_unitario_resultante_m2'],
				'<a class="btn btn-xs btn-info btnEdit"  title="Editar" onclick="$.editAemHomologacion(' . $row['idaemhomologacion'] . ');"><i class="glyphicon glyphicon-pencil"></i></a>');
		}
		$res = array(
			"draw" => 1,
			"recordsTotal" => $count,
			"recordsFiltered" => $count,
			"data" => $pato
		);
		return $res;
	}

}
