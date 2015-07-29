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
	public static function insBeforoAefConstrucciones($inputs, &$rowAefConstrucciones) {
		$rowAvaluosFisico = AvaluosFisico::select('*')->where('idavaluoenfoquefisico', '=', $inputs["idAef"])->first();
		$rowAvaluosInmueble = AvaluosInmueble::select('*')->where('idavaluo', '=', $rowAvaluosFisico->idavaluo)->first();
		if ( $rowAvaluosInmueble->superficie_construccion > 0 ) {
			$rowAefConstrucciones->superficie_m2 = $rowAvaluosInmueble->superficie_construccion;
			$rowAefConstrucciones->edad = $rowAvaluosInmueble->indiviso_accesoria;
			$rowAefConstrucciones->fe_v1 = 0.9;
			$rowAefConstrucciones->fe_v2 = 80;
			$rowAefConstrucciones->fe_v3 = 0.1;
			$Factor_Edad = ( ($rowAefConstrucciones->fe_v2*$rowAefConstrucciones->fe_v3) + $rowAefConstrucciones->fe_v1*($rowAefConstrucciones->fe_v2 - $rowAefConstrucciones->edad) ) / $rowAefConstrucciones->fe_v2;
			$Factor_Resultante = $Factor_Edad * $rowAefConstrucciones->factor_conservacion;
			$Valor_Neto = $rowAefConstrucciones->valor_nuevo * $rowAefConstrucciones->factor_conservacion * $Factor_Resultante;
			$Valor_Parcial = $rowAefConstrucciones->superficie_m2 * $Valor_Neto;
			$rowAefConstrucciones->factor_edad = $Factor_Edad;
			$rowAefConstrucciones->factor_resultante = $Factor_Resultante;
			$rowAefConstrucciones->valor_neto = $Valor_Neto;
			$rowAefConstrucciones->valor_parcial_construccion = $Valor_Parcial;
		}
	}
	
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public static function insAefConstrucciones($inputs, &$idaefconstruccion) {
		$rowAefConstrucciones = new AefConstrucciones();
		AefConstrucciones::insBeforoAefConstrucciones($inputs, $rowAefConstrucciones);
		$rowAefConstrucciones->idavaluoenfoquefisico = $inputs["idAef"];
		$rowAefConstrucciones->idtipo = $inputs["idtipo"];
		$rowAefConstrucciones->valor_nuevo = $inputs["valor_nuevo"];
		$rowCatFactoresConservacion = CatFactoresConservacion::find($inputs["idfactorconservacion"]);
		$rowAefConstrucciones->factor_conservacion = $rowCatFactoresConservacion->valor_factor_conservacion;
		$rowAefConstrucciones->idemp = 1;
		$rowAefConstrucciones->ip = $_SERVER['REMOTE_ADDR'];
		$rowAefConstrucciones->host = isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : '';
		$rowAefConstrucciones->creado_por = 1;
		$rowAefConstrucciones->creado_el = date('Y-m-d H:i:s');
		$rowAefConstrucciones->save();
		AefConstrucciones::insAfterConstrucciones($rowAefConstrucciones->idavaluoenfoquefisico);
		$idaefconstruccion = $rowAefConstrucciones->idaefconstruccion;
	}
	
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public static function insAfterConstrucciones($idavaluoenfoquefisico) {
		$rowAefConstrucciones = AefConstrucciones::select(DB::raw('sum(valor_parcial_construccion) AS nsuma, sum(superficie_m2) AS msuma'))->where('idavaluoenfoquefisico', '=', $idavaluoenfoquefisico)->first();
		$rowEnfoqueFisico = AvaluosFisico::find($idavaluoenfoquefisico);
		$rowEnfoqueFisico->valor_construccion = $rowAefConstrucciones->nsuma;
		$rowEnfoqueFisico->total_metros_construccion = $rowAefConstrucciones->msuma;
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
	public static function updBeforeAefConstrucciones($inputs, &$rowAefConstrucciones) {
		$rowAvaluosFisico = AvaluosFisico::select('*')->where('idavaluoenfoquefisico', '=', $inputs["idAef"])->first();
		$rowAvaluosInmueble = AvaluosInmueble::select('*')->where('idavaluo', '=', $rowAvaluosFisico->idavaluo)->first();
		if ( $rowAvaluosInmueble->superficie_construccion > 0 ) {
			$rowAefConstrucciones->superficie_m2 = $rowAvaluosInmueble->superficie_construccion;
			$rowAefConstrucciones->edad = $rowAvaluosInmueble->indiviso_accesoria;
			$rowAefConstrucciones->fe_v1 = 0.9;
			$rowAefConstrucciones->fe_v2 = 80;
			$rowAefConstrucciones->fe_v3 = 0.1;
			$Factor_Edad = ( ($rowAefConstrucciones->fe_v2*$rowAefConstrucciones->fe_v3) + $rowAefConstrucciones->fe_v1*($rowAefConstrucciones->fe_v2 - $rowAefConstrucciones->edad) ) / $rowAefConstrucciones->fe_v2;
			$Factor_Resultante = $Factor_Edad * $rowAefConstrucciones->factor_conservacion;
			$Valor_Neto = $rowAefConstrucciones->valor_nuevo * $rowAefConstrucciones->factor_conservacion * $Factor_Resultante;
			$Valor_Parcial = $rowAefConstrucciones->superficie_m2 * $Valor_Neto;
			$rowAefConstrucciones->factor_edad = $Factor_Edad;
			$rowAefConstrucciones->factor_resultante = $Factor_Resultante;
			$rowAefConstrucciones->valor_neto = $Valor_Neto;
			$rowAefConstrucciones->valor_parcial_construccion = $Valor_Parcial;
		}
	}
	
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public static function updAefConstrucciones($inputs) {
		$rowAefConstrucciones = AefConstrucciones::find($inputs["idTable"]);
		$rowAefConstrucciones->idtipo = $inputs["idtipo"];
		$rowAefConstrucciones->valor_nuevo = $inputs["valor_nuevo"];
		$rowCatFactoresConservacion = CatFactoresConservacion::find($inputs["idfactorconservacion"]);
		$rowAefConstrucciones->factor_conservacion = $rowCatFactoresConservacion->valor_factor_conservacion;
		AefConstrucciones::updBeforeAefConstrucciones($inputs, $rowAefConstrucciones);
		$rowAefConstrucciones->ip = $_SERVER['REMOTE_ADDR'];
		$rowAefConstrucciones->host = isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : '';
		$rowAefConstrucciones->modi_por = 1;
		$rowAefConstrucciones->modi_el = date('Y-m-d H:i:s');
		$rowAefConstrucciones->save();
		AefConstrucciones::updAfterAefConstrucciones($inputs['idAef']);
	}
	
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public static function updAfterAefConstrucciones($idavaluoenfoquefisico) {
		$rowAefConstrucciones = AefConstrucciones::select(DB::raw('sum(valor_parcial_construccion) AS nsuma, sum(superficie_m2) AS msuma'))->where('idavaluoenfoquefisico', '=', $idavaluoenfoquefisico)->first();
		$rowEnfoqueFisico = AvaluosFisico::find($idavaluoenfoquefisico);
		$rowEnfoqueFisico->valor_construccion = $rowAefConstrucciones->nsuma;
		$rowEnfoqueFisico->total_metros_construccion = $rowAefConstrucciones->msuma;
		$rowEnfoqueFisico->total_valor_fisico = AvaluosFisico::updBeforeAvaluoEnfoqueFisico($rowEnfoqueFisico);
		$rowEnfoqueFisico->save();
		AvaluosFisico::updAfterAvaluoEnfoqueFisico($rowEnfoqueFisico->idavaluo, $rowEnfoqueFisico->total_valor_fisico);
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

}
