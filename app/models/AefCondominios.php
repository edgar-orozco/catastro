<?php

class AefCondominios extends \Eloquent {

	protected $connection = 'corevat';
	protected $fillable = [];
	protected $table = 'aef_condominios';
	protected $primaryKey = 'idaefcondominio';
	public $timestamps = false;

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public static function AefCondominiosByFk($idavaluoenfoquefisico) {
		return AefCondominios::select('*')
						->where('idavaluoenfoquefisico', '=', $idavaluoenfoquefisico)
						->orderBy('idaefcondominio')
						->get();
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public static function insBeforoAefCondominios($inputs, &$rowAefCondominios) {
		$fe_v1 = 0.1;
		$fe_v2 = 0.9;
		$FE = 0;
		if ( $inputs["vida_remanente"] > 0 ) {
			$FE = (
					( 
						($fe_v1 * $inputs["vida_remanente"]) + 
						( $fe_v2 * $inputs["vida_remanente"] - $inputs["edad_condominios"] ) 
					) / $inputs["vida_remanente"]
				);
		}

		$FR = $inputs["factor_conservacion_condominios"] * $FE;
        $rowAefCondominios->factor_edad = $FE;
        $rowAefCondominios->factor_resultante = $FR;
        $rowAefCondominios->valor_parcial = $inputs["cantidad_condominios"] * $inputs["valor_nuevo_condominios"] * ($inputs["indiviso_condominios"]/100);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public static function insAefCondominios($inputs, &$subtotal_area_condominio, &$total_valor_fisico) {
		$rowAefCondominios = new AefCondominios();
		AefCondominios::insBeforoAefCondominios($inputs, $rowAefCondominios);
		$rowAefCondominios->idavaluoenfoquefisico = $inputs["idavaluoenfoquefisico3"];

		$rowAefCondominios->descripcion = $inputs["descripcion"];
		$rowAefCondominios->unidad = $inputs["unidad"];
		$rowAefCondominios->cantidad = $inputs["cantidad_condominios"];
		$rowAefCondominios->valor_nuevo = $inputs["valor_nuevo_condominios"];
		$rowAefCondominios->vida_remanente = $inputs["vida_remanente"];
		$rowAefCondominios->edad = $inputs["edad_condominios"];
		$rowAefCondominios->factor_conservacion = $inputs["factor_conservacion_condominios"];
		$rowAefCondominios->indiviso = $inputs["indiviso_condominios"];
		
		$rowAefCondominios->idemp = 1;
		$rowAefCondominios->ip = $_SERVER['REMOTE_ADDR'];
		$rowAefCondominios->host = isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : '';
		$rowAefCondominios->creado_por = Auth::Id();
		$rowAefCondominios->creado_el = date('Y-m-d H:i:s');
		$rowAefCondominios->save();
		AefCondominios::insAfterAefCondominios($inputs["idavaluoenfoquefisico3"], $subtotal_area_condominio, $total_valor_fisico);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public static function insAfterAefCondominios($idavaluoenfoquefisico, &$subtotal_area_condominio, &$total_valor_fisico) {
		$Total = AefCondominios::select(DB::raw('sum(valor_parcial) AS nsuma'))->where('idavaluoenfoquefisico', '=', $idavaluoenfoquefisico)->first();
		$rowEnfoqueFisico = AvaluosFisico::find($idavaluoenfoquefisico);
		$rowEnfoqueFisico->subtotal_area_condominio = $Total->nsuma;
		$rowEnfoqueFisico->total_valor_fisico = AvaluosFisico::updBeforeAvaluoEnfoqueFisico($rowEnfoqueFisico);
		$rowEnfoqueFisico->save();
		$subtotal_area_condominio = $rowEnfoqueFisico->subtotal_area_condominio;
		$total_valor_fisico = $rowEnfoqueFisico->total_valor_fisico;
		AvaluosFisico::updAfterAvaluoEnfoqueFisico($rowEnfoqueFisico->idavaluo, $rowEnfoqueFisico->total_valor_fisico);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public static function updBeforeAefCondominios($inputs, &$rowAefCondominios) {
		$fe_v1 = 0.1;
		$fe_v2 = 0.9;
		$FE = 0;
		if ( $inputs["vida_remanente"] > 0 ) {
			$FE = (
					( 
						($fe_v1 * $inputs["vida_remanente"]) + 
						( $fe_v2 * $inputs["vida_remanente"] - $inputs["edad_condominios"] ) 
					) / $inputs["vida_remanente"]
				);
		}

		$FR = $inputs["factor_conservacion_condominios"] * $FE;
        $rowAefCondominios->factor_edad = $FE;
        $rowAefCondominios->factor_resultante = $FR;
        $rowAefCondominios->valor_parcial = $inputs["cantidad_condominios"] * $inputs["valor_nuevo_condominios"] * ($inputs["indiviso_condominios"]/100);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $inputs
	 * @return Response
	 */
	public static function updAefCondominios($inputs, &$subtotal_area_condominio, &$total_valor_fisico) {
		$rowAefCondominios = AefCondominios::find($inputs["idaefcondominio"]);
		AefCondominios::updBeforeAefCondominios($inputs, $rowAefCondominios);
		
		$rowAefCondominios->descripcion = $inputs["descripcion"];
		$rowAefCondominios->unidad = $inputs["unidad"];
		$rowAefCondominios->cantidad = $inputs["cantidad_condominios"];
		$rowAefCondominios->valor_nuevo = $inputs["valor_nuevo_condominios"];
		$rowAefCondominios->vida_remanente = $inputs["vida_remanente"];
		$rowAefCondominios->edad = $inputs["edad_condominios"];
		$rowAefCondominios->factor_conservacion = $inputs["factor_conservacion_condominios"];
		$rowAefCondominios->indiviso = $inputs["indiviso_condominios"];
		
		$rowAefCondominios->idemp = 1;
		$rowAefCondominios->ip = $_SERVER['REMOTE_ADDR'];
		$rowAefCondominios->host = isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : '';
		$rowAefCondominios->modi_por = Auth::Id();
		$rowAefCondominios->modi_el = date('Y-m-d H:i:s');
		$rowAefCondominios->save();
		AefCondominios::updAfterAefCondominios($inputs["idavaluoenfoquefisico3"], $subtotal_area_condominio, $total_valor_fisico);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public static function updAfterAefCondominios($idavaluoenfoquefisico, &$subtotal_area_condominio, &$total_valor_fisico) {
		$Total = AefCondominios::select(DB::raw('sum(valor_parcial) AS nsuma'))->where('idavaluoenfoquefisico', '=', $idavaluoenfoquefisico)->first();
		$rowEnfoqueFisico = AvaluosFisico::find($idavaluoenfoquefisico);
		$rowEnfoqueFisico->subtotal_area_condominio = $Total->nsuma;
		$rowEnfoqueFisico->total_valor_fisico = AvaluosFisico::updBeforeAvaluoEnfoqueFisico($rowEnfoqueFisico);
		$rowEnfoqueFisico->save();
		$subtotal_area_condominio = $rowEnfoqueFisico->subtotal_area_condominio;
		$total_valor_fisico = $rowEnfoqueFisico->total_valor_fisico;
		AvaluosFisico::updAfterAvaluoEnfoqueFisico($rowEnfoqueFisico->idavaluo, $rowEnfoqueFisico->total_valor_fisico);
	}

	public static function getAjaxAefCondominiosByFk($fk) {
		$pato = array();
		$rows = AefCondominios::select(
		'aef_condominios.idaefcondominio', 
		'aef_condominios.descripcion', 
		'aef_condominios.unidad', 
		'aef_condominios.cantidad', 
		'aef_condominios.valor_nuevo', 
		'aef_condominios.vida_remanente', 
		'aef_condominios.edad', 
		'aef_condominios.factor_edad', 
		'aef_condominios.factor_conservacion', 
		'aef_condominios.factor_resultante', 
		'aef_condominios.indiviso', 
		'aef_condominios.valor_parcial')
						->where('aef_condominios.idavaluoenfoquefisico', '=', $fk)
						->orderBy('aef_condominios.idaefcondominio')
						->get();
		$count = count($rows);
		 foreach ($rows as $row) {
			 $pato[] = array(
				$row['idaefcondominio'], 
				$row['descripcion'], 
				$row['unidad'], 
				$row['cantidad'], 
				$row['valor_nuevo'], 
				$row['vida_remanente'], 
				$row['edad'], 
				$row['factor_edad'], 
				$row['factor_conservacion'], 
				$row['factor_resultante'], 
				$row['indiviso'], 
				$row['valor_parcial'], 
				'<a class="btn btn-xs btn-info btnEdit"  title="Editar" onclick="$.editAefCondominios('.$row['idaefcondominio'].');"><i class="glyphicon glyphicon-pencil"></i></a>', 
				'<a class="btn btn-xs btn-danger btnDel" title="Eliminar" onclick="$.delAefCondominios('.$row['idaefcondominio'].');"><i class="glyphicon glyphicon-remove"></i></a>');
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
