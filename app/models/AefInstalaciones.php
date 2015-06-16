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
		$Factor_Edad = $inputs["vida_util"] == 0 ? 0 : (($fe_v1 * $inputs["vida_util"] + $fe_v2 * ($inputs["vida_util"] - $inputs["edad"]))) / $inputs["vida_util"];
		$Factor_Resultante = $Factor_Edad * $inputs["factor_conservacion"];
		$Valor_Neto = $Factor_Resultante * $inputs["valor_nuevo"];
		$Valor_Parcial = $Valor_Neto * $inputs["cantidad"];
		$rowAefInstalaciones->factor_edad = $Factor_Edad;
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
	public static function insAefInstalaciones($inputs, &$idaefinstalacion) {
		$rowAefInstalaciones = new AefInstalaciones();
		$rowAefInstalaciones->idavaluoenfoquefisico = $inputs["idAef"];
		$rowAefInstalaciones->idobracomplementaria = $inputs["idobracomplementaria"];
		$rowAefInstalaciones->cantidad = $inputs["cantidad"];
		$rowAefInstalaciones->unidad = $inputs["unidad"];
		$rowAefInstalaciones->valor_nuevo = $inputs["valor_nuevo"];
		$rowAefInstalaciones->vida_util = $inputs["vida_util"];
		$rowAefInstalaciones->edad = $inputs["edad"];
		$rowAefInstalaciones->factor_conservacion = $inputs["factor_conservacion"];

		AefInstalaciones::insBeforoAefInstalaciones($inputs, $rowAefInstalaciones);

		$rowAefInstalaciones->idemp = 1;
		$rowAefInstalaciones->ip = $_SERVER['REMOTE_ADDR'];
		$rowAefInstalaciones->host = isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : '';
		$rowAefInstalaciones->creado_por = 1;
		$rowAefInstalaciones->creado_el = date('Y-m-d H:i:s');
		$rowAefInstalaciones->save();
		AefInstalaciones::insAfterAefInstalaciones($inputs["idAef"]);
		$idaefinstalacion = $rowAefInstalaciones->idaefinstalacion;
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public static function insAfterAefInstalaciones($idavaluoenfoquefisico) {
		$Total = AefInstalaciones::select(DB::raw('sum(valor_parcial) AS nsuma'))->where('idavaluoenfoquefisico', '=', $idavaluoenfoquefisico)->first();
		$rowEnfoqueFisico = AvaluosFisico::find($idavaluoenfoquefisico);
		$rowEnfoqueFisico->subtotal_instalaciones_especiales = $Total->nsuma;
		$rowEnfoqueFisico->total_valor_fisico = AvaluosFisico::updBeforeAvaluoEnfoqueFisico($rowEnfoqueFisico);
		$rowEnfoqueFisico->save();
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
		$Factor_Edad = $inputs["vida_util"] == 0 ? 0 : (($fe_v1 * $inputs["vida_util"] + $fe_v2 * ($inputs["vida_util"] - $inputs["edad"]))) / $inputs["vida_util"];
		$Factor_Resultante = $Factor_Edad * $inputs["factor_conservacion"];
		$Valor_Neto = $Factor_Resultante * $inputs["valor_nuevo"];
		$Valor_Parcial = $Valor_Neto * $inputs["cantidad"];
		$rowAefInstalaciones->factor_edad = $Factor_Edad;
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
	public static function updAefInstalaciones($inputs) {
		$rowAefInstalaciones = AefInstalaciones::find($inputs["idTable"]);
		
		$rowAefInstalaciones->idobracomplementaria = $inputs["idobracomplementaria"];
		$rowAefInstalaciones->cantidad = $inputs["cantidad"];
		$rowAefInstalaciones->unidad = $inputs["unidad"];
		$rowAefInstalaciones->valor_nuevo = $inputs["valor_nuevo"];
		$rowAefInstalaciones->vida_util = $inputs["vida_util"];
		$rowAefInstalaciones->edad = $inputs["edad"];
		$rowAefInstalaciones->factor_conservacion = $inputs["factor_conservacion"];
		
		AefInstalaciones::updBeforeAefInstalaciones($inputs, $rowAefInstalaciones);

		$rowAefInstalaciones->idemp = 1;
		$rowAefInstalaciones->ip = $_SERVER['REMOTE_ADDR'];
		$rowAefInstalaciones->host = isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : '';
		$rowAefInstalaciones->modi_por = 1;
		$rowAefInstalaciones->modi_el = date('Y-m-d H:i:s');
		$rowAefInstalaciones->save();
		AefInstalaciones::updAfterAefInstalaciones($inputs["idAef"]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public static function updAfterAefInstalaciones($idavaluoenfoquefisico) {
		$Total = AefInstalaciones::select(DB::raw('sum(valor_parcial) AS nsuma'))->where('idavaluoenfoquefisico', '=', $idavaluoenfoquefisico)->first();
		$rowEnfoqueFisico = AvaluosFisico::find($idavaluoenfoquefisico);
		$rowEnfoqueFisico->subtotal_instalaciones_especiales = $Total->nsuma;
		$rowEnfoqueFisico->total_valor_fisico = AvaluosFisico::updBeforeAvaluoEnfoqueFisico($rowEnfoqueFisico);
		$rowEnfoqueFisico->save();
		AvaluosFisico::updAfterAvaluoEnfoqueFisico($rowEnfoqueFisico->idavaluo, $rowEnfoqueFisico->total_valor_fisico);
	}

}
