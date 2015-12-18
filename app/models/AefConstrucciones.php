<?php

class AefConstrucciones extends \Eloquent {

	protected $connection = 'corevat';
	protected $fillable = [];
	protected $table = 'aef_construcciones';
	protected $primaryKey = 'idaefconstruccion';
	public $timestamps = false;

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public static function AefConstruccionesByFk($idavaluoenfoquefisico) {
		return AefConstrucciones::select('*')
						->leftjoin('cat_tipo', 'aef_construcciones.idtipo', '=', 'cat_tipo.idtipo')
						->where('idavaluoenfoquefisico', '=', $idavaluoenfoquefisico)
						->orderBy('idaefconstruccion')
						->get();
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public static function insAefConstrucciones($inputs) {
		$rowAefConstrucciones = new AefConstrucciones();
		$rowAefConstrucciones->idavaluoenfoquefisico = $inputs["idavaluoenfoquefisico2"];
		$rowAefConstrucciones->created_at = $inputs["created_at"];
		AefConstrucciones::setAefConstrucciones($rowAefConstrucciones, $inputs);
		$rowAefConstrucciones->save();
	}
	
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public static function updAefConstrucciones($inputs) {
		$rowAefConstrucciones = AefConstrucciones::find($inputs["idaefconstruccion"]);
		$rowAefConstrucciones->updated_at = $inputs["updated_at"];
		AefConstrucciones::setAefConstrucciones($rowAefConstrucciones, $inputs);
		$rowAefConstrucciones->save();
	}
	
	public static function setAefConstrucciones(&$rowAefConstrucciones, $inputs) {
		$rowAefConstrucciones->idtipo = $inputs["idtipo"];
		$rowAefConstrucciones->edad = $inputs["edad_construcciones"];
		$rowAefConstrucciones->superficie_m2 = $inputs["superficie_m2_construcciones"];
		$rowAefConstrucciones->valor_nuevo = $inputs["valor_nuevo_construcciones"];
		$rowAefConstrucciones->factor_edad = $inputs["factor_edad_construcciones"];
		$rowAefConstrucciones->fk_conservacion = $inputs["idfactorconservacion"];
		$rowAefConstrucciones->factor_conservacion = $inputs["factor_conservacion_construcciones"];
	}

	public static function getAjaxAefConstruccionesByFk($fk) {
		$pato = array();
		$rows = AefConstrucciones::select(
		'aef_construcciones.idaefconstruccion', 
		'cat_tipo.tipo',
		'aef_construcciones.edad',
		'aef_construcciones.superficie_m2',
		'aef_construcciones.valor_nuevo',
		'aef_construcciones.factor_edad',
		'aef_construcciones.factor_conservacion',
		'aef_construcciones.factor_resultante',
		'aef_construcciones.valor_neto',
		'aef_construcciones.valor_parcial_construccion')
						->leftJoin('cat_tipo', 'aef_construcciones.idtipo', '=', 'cat_tipo.idtipo')
						->where('aef_construcciones.idavaluoenfoquefisico', '=', $fk)
						->orderBy('aef_construcciones.idaefconstruccion')
						->get();
		$count = count($rows);
		 foreach ($rows as $row) {
			 $pato[] = array(
				$row['idaefconstruccion'], 
				$row['tipo'], 
				$row['edad'], 
				$row['superficie_m2'], 
				$row['valor_nuevo'], 
				$row['factor_edad'], 
				$row['factor_conservacion'], 
				$row['factor_resultante'], 
				$row['valor_neto'], 
				$row['valor_parcial_construccion'], 
				'<a class="btn btn-xs btn-info btnEdit"  title="Editar" onclick="$.editAefConstrucciones('.$row['idaefconstruccion'].');"><i class="glyphicon glyphicon-pencil"></i></a>', 
				'<a class="btn btn-xs btn-danger btnDel" title="Eliminar" onclick="$.delAefConstrucciones('.$row['idaefconstruccion'].');"><i class="glyphicon glyphicon-remove"></i></a>');
		 }
		$res = array(
			"draw" => 1,
			"recordsTotal" => $count,
			"recordsFiltered" => $count,
			"data" => $pato
		);
		return $res;
	}

	public static function clonarAefConstrucciones($idavaluoenfoquefisicoold, $idavaluoenfoquefisiconew) {
		$rowsAefConstruccionesOld = AefConstrucciones::select('*')->where('idavaluoenfoquefisico', '=', $idavaluoenfoquefisicoold)->get();
		foreach ($rowsAefConstruccionesOld as $rowAefConstruccionesOld) {
			AefConstrucciones::clonarAefConstruccionesIns($idavaluoenfoquefisiconew, $rowAefConstruccionesOld);
		}
		
	}
	
	private static function clonarAefConstruccionesIns($idavaluoenfoquefisiconew, $rowAefConstruccionesOld) {
		$rowAefConstruccionesNew = new AefConstrucciones();
		$rowAefConstruccionesNew->idavaluoenfoquefisico = $idavaluoenfoquefisiconew;
		$rowAefConstruccionesNew->idtipo = $rowAefConstruccionesOld->idtipo;
		$rowAefConstruccionesNew->edad = $rowAefConstruccionesOld->edad;
		$rowAefConstruccionesNew->superficie_m2 = $rowAefConstruccionesOld->superficie_m2;
		$rowAefConstruccionesNew->fe_v1 = $rowAefConstruccionesOld->fe_v1;
		$rowAefConstruccionesNew->fe_v2 = $rowAefConstruccionesOld->fe_v2;
		$rowAefConstruccionesNew->fe_v3 = $rowAefConstruccionesOld->fe_v3;
		$rowAefConstruccionesNew->factor_edad = $rowAefConstruccionesOld->factor_edad;
		$rowAefConstruccionesNew->factor_conservacion = $rowAefConstruccionesOld->factor_conservacion;
		$rowAefConstruccionesNew->factor_resultante = $rowAefConstruccionesOld->factor_resultante;
		$rowAefConstruccionesNew->valor_neto = $rowAefConstruccionesOld->valor_neto;
		$rowAefConstruccionesNew->valor_parcial_construccion = $rowAefConstruccionesOld->valor_parcial_construccion;
		$rowAefConstruccionesNew->valor_nuevo = $rowAefConstruccionesOld->valor_nuevo;
		$rowAefConstruccionesNew->fk_conservacion = $rowAefConstruccionesOld->fk_conservacion;
		$rowAefConstruccionesNew->save();
	}

	public static function subtotalSuperficie($idavaluoenfoquefisico) {
		$pato = AefConstrucciones::select(DB::raw('sum(superficie_m2) as subtotal'))->where('idavaluoenfoquefisico', '=', $idavaluoenfoquefisico)->get();
		if ( is_null($pato) ) {
			return 0;
		} else {
			return $pato[0]->subtotal;
		}
	}
	
	
	
}
