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
	public static function insAefInstalaciones($inputs, &$subtotal_instalaciones_especiales, &$total_valor_fisico) {
		$rowAefInstalaciones = new AefInstalaciones();
		$rowAefInstalaciones->idavaluoenfoquefisico = $inputs["idavaluoenfoquefisico4"];
		$rowAefInstalaciones->created_at = $inputs["created_at"];
		AefInstalaciones::setAefInstalaciones($rowAefInstalaciones, $inputs);
		$rowAefInstalaciones->save();
		$rowAef = AvaluosFisico::find($rowAefInstalaciones->idavaluoenfoquefisico);
		$subtotal_instalaciones_especiales = $rowAef->subtotal_instalaciones_especiales;
		$total_valor_fisico = $rowAef->total_valor_fisico;
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public static function updAefInstalaciones($inputs, &$subtotal_instalaciones_especiales, &$total_valor_fisico) {
		$rowAefInstalaciones = AefInstalaciones::find($inputs["idaefinstalacion"]);
		$rowAefInstalaciones->updated_at = $inputs["updated_at"];
		AefInstalaciones::setAefInstalaciones($rowAefInstalaciones, $inputs);
		$rowAefInstalaciones->save();
		$rowAef = AvaluosFisico::find($rowAefInstalaciones->idavaluoenfoquefisico);
		$subtotal_instalaciones_especiales = $rowAef->subtotal_instalaciones_especiales;
		$total_valor_fisico = $rowAef->total_valor_fisico;
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public static function setAefInstalaciones(&$rowAefInstalaciones, $inputs) {
		$rowAefInstalaciones->idobracomplementaria = $inputs["idobracomplementaria"];
		$rowAefInstalaciones->cantidad = $inputs["cantidad_instalaciones"];
		$rowAefInstalaciones->unidad = $inputs["unidad_instalaciones"];
		$rowAefInstalaciones->valor_nuevo = $inputs["valor_nuevo_instalaciones"];
		$rowAefInstalaciones->vida_util = $inputs["vida_util_instalaciones"];
		$rowAefInstalaciones->edad = $inputs["edad_instalaciones"];
		$rowAefInstalaciones->factor_edad = $inputs["factor_edad_instalaciones"];		
		$rowAefInstalaciones->factor_conservacion = $inputs["factor_conservacion_instalaciones"];		
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
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

	public static function clonarAefInstalaciones($idavaluoenfoquefisicoold, $idavaluoenfoquefisiconew) {
		$rowsAefInstalacionesOld = AefInstalaciones::select('*')->where('idavaluoenfoquefisico', '=', $idavaluoenfoquefisicoold)->get();
		foreach ($rowsAefInstalacionesOld as $rowAefInstalacionesOld) {
			AefInstalaciones::clonarAefInstalacionesIns($idavaluoenfoquefisiconew, $rowAefInstalacionesOld);
		}
		
	}
	
	private static function clonarAefInstalacionesIns($idavaluoenfoquefisiconew, $rowAefInstalacionesOld) {
		$rowAefInstalacionesNew = new AefCondominios();
		$rowAefInstalacionesNew->idavaluoenfoquefisico = $idavaluoenfoquefisiconew;
		$rowAefInstalacionesNew->idobracomplementaria = $rowAefInstalacionesOld->idobracomplementaria;
		$rowAefInstalacionesNew->descripcion = $rowAefInstalacionesOld->descripcion;
		$rowAefInstalacionesNew->cantidad = $rowAefInstalacionesOld->cantidad;
		$rowAefInstalacionesNew->unidad = $rowAefInstalacionesOld->unidad;
		$rowAefInstalacionesNew->valor_nuevo = $rowAefInstalacionesOld->valor_nuevo;
		$rowAefInstalacionesNew->vida_util = $rowAefInstalacionesOld->vida_util;
		$rowAefInstalacionesNew->edad = $rowAefInstalacionesOld->edad;
		$rowAefInstalacionesNew->fe_v1 = $rowAefInstalacionesOld->fe_v1;
		$rowAefInstalacionesNew->fe_v2 = $rowAefInstalacionesOld->fe_v2;
		$rowAefInstalacionesNew->factor_edad = $rowAefInstalacionesOld->factor_edad;
		$rowAefInstalacionesNew->factor_conservacion = $rowAefInstalacionesOld->factor_conservacion;
		$rowAefInstalacionesNew->factor_resultante = $rowAefInstalacionesOld->factor_resultante;
		$rowAefInstalacionesNew->valor_neto = $rowAefInstalacionesOld->valor_neto;
		$rowAefInstalacionesNew->valor_parcial = $rowAefInstalacionesOld->valor_parcial;
		$rowAefInstalacionesNew->save();
	}

}
