<?php

class AefInstalaciones extends \Eloquent {

	protected $connection = 'corevat';
	protected $fillable = [];
	protected $table = 'aef_instalaciones';
	protected $primaryKey = 'idaefinstalacion';
	public $timestamps = false;

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public static function AefInstalacionesByFk($idavaluoenfoquefisico) {
		return AefInstalaciones::select('aef_instalaciones.*', 'cat_obras_complementarias.obra_complementaria')
						->leftJoin('cat_obras_complementarias', 'aef_instalaciones.idobracomplementaria', '=', 'cat_obras_complementarias.idobracomplementaria')
						->where('aef_instalaciones.idavaluoenfoquefisico', '=', $idavaluoenfoquefisico)
						->orderBy('idaefinstalacion')
						->get();
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public static function insBeforoAefInstalaciones($inputs, &$rowAefInstalaciones) {
		$fe_v1 = 0.1;
		$fe_v2 = 0.9;
		$FE0 = 0;
		// $Factor_Edad = $inputs["eaf_Instalacion_vida_util"] == 0 ? 0 : (($fe_v1 * $inputs["eaf_Instalacion_vida_util"] + $fe_v2 * ($inputs["eaf_Instalacion_vida_util"] - $inputs["edad"]))) / $inputs["eaf_Instalacion_vida_util"];
		if ( $inputs["vida_util_instalaciones"] > 0 ) {
			$FE0 = (
					( 
					($fe_v1 * $inputs["vida_util_instalaciones"] ) + 
					($fe_v2 * $inputs["vida_util_instalaciones"] ) - 
					$inputs["edad_instalaciones"]
				) / $inputs["vida_util_instalaciones"]
			);
		}
		$FE = $inputs["vida_util_instalaciones"] == 0 ? 0 : $FE0;
		$Factor_Resultante = $FE * $inputs["factor_conservacion_instalaciones"];
		$Valor_Neto = $Factor_Resultante * $inputs["valor_nuevo_instalaciones"];
		$Valor_Parcial = $Valor_Neto * $inputs["cantidad_instalaciones"];
		$rowAefInstalaciones->factor_edad = $FE;
		$rowAefInstalaciones->factor_resultante = $Factor_Resultante;
		$rowAefInstalaciones->valor_neto = $Valor_Neto;
		$rowAefInstalaciones->valor_parcial = $Valor_Parcial;
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public static function insAefInstalaciones($inputs, &$subtotal_instalaciones_especiales, &$total_valor_fisico) {
		$rowAefInstalaciones = new AefInstalaciones();
		$rowAefInstalaciones->idavaluoenfoquefisico = $inputs["idavaluoenfoquefisico4"];
		$rowAefInstalaciones->idobracomplementaria = $inputs["idobracomplementaria"];
		$rowAefInstalaciones->cantidad = $inputs["cantidad_instalaciones"];
		$rowAefInstalaciones->unidad = $inputs["unidad_instalaciones"];
		$rowAefInstalaciones->valor_nuevo = $inputs["valor_nuevo_instalaciones"];
		$rowAefInstalaciones->vida_util = $inputs["vida_util_instalaciones"];
		$rowAefInstalaciones->edad = $inputs["edad_instalaciones"];
		$rowAefInstalaciones->factor_conservacion = $inputs["factor_conservacion_instalaciones"];

		AefInstalaciones::insBeforoAefInstalaciones($inputs, $rowAefInstalaciones);

		$rowAefInstalaciones->idemp = 1;
		$rowAefInstalaciones->ip = $_SERVER['REMOTE_ADDR'];
		$rowAefInstalaciones->host = isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : '';
		$rowAefInstalaciones->creado_por = Auth::Id();
		$rowAefInstalaciones->creado_el = date('Y-m-d H:i:s');
		$rowAefInstalaciones->save();
		AefInstalaciones::insAfterAefInstalaciones($inputs["idavaluoenfoquefisico4"], $subtotal_instalaciones_especiales, $total_valor_fisico);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public static function insAfterAefInstalaciones($idavaluoenfoquefisico, &$subtotal_instalaciones_especiales, &$total_valor_fisico) {
		$Total = AefInstalaciones::select(DB::raw('sum(valor_parcial) AS nsuma'))->where('idavaluoenfoquefisico', '=', $idavaluoenfoquefisico)->first();
		$rowEnfoqueFisico = AvaluosFisico::find($idavaluoenfoquefisico);
		$rowEnfoqueFisico->subtotal_instalaciones_especiales = $Total->nsuma;
		$rowEnfoqueFisico->total_valor_fisico = AvaluosFisico::updBeforeAvaluoEnfoqueFisico($rowEnfoqueFisico);
		$rowEnfoqueFisico->save();
		$subtotal_instalaciones_especiales = $rowEnfoqueFisico->subtotal_instalaciones_especiales;
		$total_valor_fisico = $rowEnfoqueFisico->total_valor_fisico;
		AvaluosFisico::updAfterAvaluoEnfoqueFisico($rowEnfoqueFisico->idavaluo, $rowEnfoqueFisico->total_valor_fisico);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public static function updBeforeAefInstalaciones($inputs, &$rowAefInstalaciones) {
		$fe_v1 = 0.1;
		$fe_v2 = 0.9;
		$FE0 = 0;
		// $Factor_Edad = $inputs["eaf_Instalacion_vida_util"] == 0 ? 0 : (($fe_v1 * $inputs["eaf_Instalacion_vida_util"] + $fe_v2 * ($inputs["eaf_Instalacion_vida_util"] - $inputs["edad"]))) / $inputs["eaf_Instalacion_vida_util"];
		if ( $inputs["vida_util_instalaciones"] > 0 ) {
			$FE0 = (
					( 
					($fe_v1 * $inputs["vida_util_instalaciones"] ) + 
					($fe_v2 * $inputs["vida_util_instalaciones"] ) - 
					$inputs["edad_instalaciones"]
				) / $inputs["vida_util_instalaciones"]
			);
		}
		$FE = $inputs["vida_util_instalaciones"] == 0 ? 0 : $FE0;
		$Factor_Resultante = $FE * $inputs["factor_conservacion_instalaciones"];
		$Valor_Neto = $Factor_Resultante * $inputs["valor_nuevo_instalaciones"];
		$Valor_Parcial = $Valor_Neto * $inputs["cantidad_instalaciones"];
		$rowAefInstalaciones->factor_edad = $FE;
		$rowAefInstalaciones->factor_resultante = $Factor_Resultante;
		$rowAefInstalaciones->valor_neto = $Valor_Neto;
		$rowAefInstalaciones->valor_parcial = $Valor_Parcial;
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public static function updAefInstalaciones($inputs, &$subtotal_instalaciones_especiales, &$total_valor_fisico) {
		$rowAefInstalaciones = AefInstalaciones::find($inputs["idaefinstalacion"]);
		
		//$rowAefInstalaciones->idavaluoenfoquefisico = $inputs["idavaluoenfoquefisico4"];
		$rowAefInstalaciones->idobracomplementaria = $inputs["idobracomplementaria"];
		$rowAefInstalaciones->cantidad = $inputs["cantidad_instalaciones"];
		$rowAefInstalaciones->unidad = $inputs["unidad_instalaciones"];
		$rowAefInstalaciones->valor_nuevo = $inputs["valor_nuevo_instalaciones"];
		$rowAefInstalaciones->vida_util = $inputs["vida_util_instalaciones"];
		$rowAefInstalaciones->edad = $inputs["edad_instalaciones"];
		$rowAefInstalaciones->factor_conservacion = $inputs["factor_conservacion_instalaciones"];
		
		AefInstalaciones::updBeforeAefInstalaciones($inputs, $rowAefInstalaciones);

		$rowAefInstalaciones->idemp = 1;
		$rowAefInstalaciones->ip = $_SERVER['REMOTE_ADDR'];
		$rowAefInstalaciones->host = isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : '';
		$rowAefInstalaciones->modi_por = Auth::Id();
		$rowAefInstalaciones->modi_el = date('Y-m-d H:i:s');
		$rowAefInstalaciones->save();
		AefInstalaciones::updAfterAefInstalaciones($inputs["idavaluoenfoquefisico4"], $subtotal_instalaciones_especiales, $total_valor_fisico);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public static function updAfterAefInstalaciones($idavaluoenfoquefisico, &$subtotal_instalaciones_especiales, &$total_valor_fisico) {
		$Total = AefInstalaciones::select(DB::raw('sum(valor_parcial) AS nsuma'))->where('idavaluoenfoquefisico', '=', $idavaluoenfoquefisico)->first();
		$rowEnfoqueFisico = AvaluosFisico::find($idavaluoenfoquefisico);
		$rowEnfoqueFisico->subtotal_instalaciones_especiales = $Total->nsuma;
		$rowEnfoqueFisico->total_valor_fisico = AvaluosFisico::updBeforeAvaluoEnfoqueFisico($rowEnfoqueFisico);
		$rowEnfoqueFisico->save();
		$subtotal_instalaciones_especiales = $rowEnfoqueFisico->subtotal_instalaciones_especiales;
		$total_valor_fisico = $rowEnfoqueFisico->total_valor_fisico;
		AvaluosFisico::updAfterAvaluoEnfoqueFisico($rowEnfoqueFisico->idavaluo, $rowEnfoqueFisico->total_valor_fisico);
	}

	public static function getAjaxAefInstalacionesByFk($fk) {
		$pato = array();
		$rows = AefInstalaciones::select(
		'aef_instalaciones.idaefinstalacion', 
		'cat_obras_complementarias.obra_complementaria', 
		'aef_instalaciones.unidad', 
		'aef_instalaciones.cantidad', 
		'aef_instalaciones.valor_nuevo', 
		'aef_instalaciones.vida_util', 
		'aef_instalaciones.edad', 
		'aef_instalaciones.factor_edad', 
		'aef_instalaciones.factor_conservacion', 
		'aef_instalaciones.factor_resultante', 
		'aef_instalaciones.valor_neto', 
		'aef_instalaciones.valor_parcial')
						->leftJoin('cat_obras_complementarias', 'aef_instalaciones.idobracomplementaria', '=', 'cat_obras_complementarias.idobracomplementaria')
						->where('aef_instalaciones.idavaluoenfoquefisico', '=', $fk)
						->orderBy('aef_instalaciones.idaefinstalacion')
						->get();
		$count = count($rows);
		 foreach ($rows as $row) {
			 $pato[] = array(
				$row['idaefinstalacion'], 
				$row['obra_complementaria'], 
				$row['unidad'], 
				$row['cantidad'], 
				$row['valor_nuevo'], 
				$row['vida_util'], 
				$row['edad'], 
				$row['factor_edad'], 
				$row['factor_conservacion'], 
				$row['factor_resultante'], 
				$row['valor_neto'], 
				$row['valor_parcial'], 
				'<a class="btn btn-xs btn-info btnEdit"  title="Editar" onclick="$.editAefInstalaciones('.$row['idaefinstalacion'].');"><i class="glyphicon glyphicon-pencil"></i></a>', 
				'<a class="btn btn-xs btn-danger btnDel" title="Eliminar" onclick="$.delAefInstalaciones('.$row['idaefinstalacion'].');"><i class="glyphicon glyphicon-remove"></i></a>');
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
