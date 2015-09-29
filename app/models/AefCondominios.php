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
	public static function insAefCondominios($inputs, &$subtotal_area_condominio, &$total_valor_fisico) {
		$rowAefCondominios = new AefCondominios();
		$rowAefCondominios->idavaluoenfoquefisico = $inputs["idavaluoenfoquefisico3"];
		$rowAefCondominios->created_at = $inputs["created_at"];
		AefCondominios::setAefCondominios($rowAefCondominios, $inputs);		
		$rowAefCondominios->save();
		$rowAef = AvaluosFisico::find($rowAefCondominios->idavaluoenfoquefisico);
		$subtotal_area_condominio = $rowAef->subtotal_area_condominio;
		$total_valor_fisico = $rowAef->total_valor_fisico;
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $inputs
	 * @return Response
	 */
	public static function updAefCondominios($inputs, &$subtotal_area_condominio, &$total_valor_fisico) {
		$rowAefCondominios = AefCondominios::find($inputs["idaefcondominio"]);
		$rowAefCondominios->updated_at = $inputs["updated_at"];
		AefCondominios::setAefCondominios($rowAefCondominios, $inputs);
		$rowAefCondominios->save();
		$rowAef = AvaluosFisico::find($rowAefCondominios->idavaluoenfoquefisico);
		$subtotal_area_condominio = $rowAef->subtotal_area_condominio;
		$total_valor_fisico = $rowAef->total_valor_fisico;
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $inputs
	 * @return Response
	 */
	public static function setAefCondominios(&$rowAefCondominios, $inputs) {
		$rowAefCondominios->descripcion = $inputs["descripcion"];
		$rowAefCondominios->unidad = $inputs["unidad"];
		$rowAefCondominios->cantidad = $inputs["cantidad_condominios"];
		$rowAefCondominios->valor_nuevo = $inputs["valor_nuevo_condominios"];
		$rowAefCondominios->vida_remanente = $inputs["vida_remanente"];
		$rowAefCondominios->factor_edad = $inputs["factor_edad_condominios"];
		$rowAefCondominios->vida_remanente = $inputs["vida_remanente"];
		$rowAefCondominios->factor_conservacion = $inputs["factor_conservacion_condominios"];
		$rowAefCondominios->indiviso = $inputs["indiviso_condominios"];
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $inputs
	 * @return Response
	 */
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
