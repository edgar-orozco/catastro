<?php

class AefTerrenos extends \Eloquent {

	protected $connection = 'corevat';
	protected $fillable = [];
	protected $table = 'aef_terrenos';
	protected $primaryKey = 'idaefterreno';
	public $timestamps = false;

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public static function AefTerrenosByFk($idavaluoenfoquefisico) {
		return AefTerrenos::select('*')
						->where('idavaluoenfoquefisico', '=', $idavaluoenfoquefisico)
						->orderBy('idaefterreno')
						->get();
	}

	public static function insBeforeAefTerrenos($inputs, &$rowAefTerrenos) {
		$rowAvaluosFisico = AvaluosFisico::select('idavaluo')->where('idavaluoenfoquefisico', '=', $inputs["idavaluoenfoquefisico1"])->first();
		$rowAvaluosInmbueble = AvaluosInmueble::select('*')->where('idavaluo', '=', $rowAvaluosFisico->idavaluo)->first();
		$rowAvaluosMercado = AvaluosMercado::select('*')->where('idavaluo', '=', $rowAvaluosFisico->idavaluo)->first();
		
		$rowAefTerrenos->superficie = $rowAvaluosInmbueble->superficie_total_terreno;
		$rowAefTerrenos->valor_unitario_neto = $rowAvaluosMercado->valor_aplicado_m2 * $rowAefTerrenos->factor_resultante;
		$rowAefTerrenos->valor_parcial = $rowAvaluosInmbueble->superficie_total_terreno * $rowAefTerrenos->valor_unitario_neto * ($rowAefTerrenos->indiviso/100);
	}
	
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public static function insAefTerrenos($inputs, &$valor_terreno, &$total_valor_fisico) {
		$rowAefTerrenos = new AefTerrenos();
		$rowAefTerrenos->idavaluoenfoquefisico = $inputs["idavaluoenfoquefisico1"];

		$rowAefTerrenos->fraccion = $inputs["fraccion"];
		$rowAefTerrenos->irregular = $inputs["irregular"];
		$rowAefTerrenos->fk_top = $inputs["idfactortop"];
		$rowAefTerrenos->top = $inputs["top"];
		$rowAefTerrenos->fk_frente = $inputs["idfactorfrente"];
		$rowAefTerrenos->frente = $inputs["frente"];
		$rowAefTerrenos->fk_forma = $inputs["idfactorforma"];
		$rowAefTerrenos->forma = $inputs["forma"];
		$rowAefTerrenos->fk_otros = $inputs["idfactorotros"];
		$rowAefTerrenos->otros = $inputs["otros"];
		$rowAefTerrenos->indiviso = $inputs["indiviso_terrenos"];
		$rowAefTerrenos->factor_resultante = $rowAefTerrenos->irregular * $rowAefTerrenos->top * $rowAefTerrenos->frente * $rowAefTerrenos->forma * $rowAefTerrenos->otros;

		AefTerrenos::insBeforeAefTerrenos($inputs, $rowAefTerrenos);
		
		$rowAefTerrenos->idemp = 1;
		$rowAefTerrenos->ip = $_SERVER['REMOTE_ADDR'];
		$rowAefTerrenos->host = isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : '';
		$rowAefTerrenos->creado_por = Auth::Id();
		$rowAefTerrenos->creado_el = date('Y-m-d H:i:s');
		$rowAefTerrenos->save();
		
		AefTerrenos::insAfterAefTerrenos($inputs['idavaluoenfoquefisico1'], $valor_terreno, $total_valor_fisico);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public static function insAfterAefTerrenos($idavaluoenfoquefisico, &$valor_terreno, &$total_valor_fisico) {
		$rowAefTerrenos = AefTerrenos::select(DB::raw('sum(valor_parcial) AS valorpar'))->where('idavaluoenfoquefisico', '=', $idavaluoenfoquefisico)->first();
		$rowEnfoqueFisico = AvaluosFisico::find($idavaluoenfoquefisico);
		$rowEnfoqueFisico->valor_terreno = $rowAefTerrenos->valorpar;
		$rowEnfoqueFisico->total_valor_fisico = AvaluosFisico::updBeforeAvaluoEnfoqueFisico($rowEnfoqueFisico);
		$rowEnfoqueFisico->save();
		$total_valor_fisico = $rowEnfoqueFisico->total_valor_fisico;
		$valor_terreno = $rowAefTerrenos->valorpar;
		//AvaluosFisico::updAfterAvaluoEnfoqueFisico($rowEnfoqueFisico->idavaluo, $rowEnfoqueFisico->total_valor_fisico);
	}

	/**
	 * Show the form for editing the specified resource.
	 * Add Top Factor
	 * @param  int  $id 
	 * @return Response
	 */
	public static function updBeforeAefTerrenos($inputs, &$rowAefTerrenos) {
		$rowAvaluosFisico = AvaluosFisico::select('idavaluo')->where('idavaluoenfoquefisico', '=', $inputs["idavaluoenfoquefisico1"])->first();
		$rowAvaluosInmbueble = AvaluosInmueble::select('*')->where('idavaluo', '=', $rowAvaluosFisico->idavaluo)->first();
		$rowAefTerrenos->superficie = $rowAvaluosInmbueble->superficie_total_terreno;
		$rowAefTerrenos->valor_unitario_neto = $rowAvaluosFisico->valor_aplicado_m2 * $rowAefTerrenos->factor_resultante;
		$rowAefTerrenos->valor_parcial = $rowAvaluosInmbueble->superficie_total_terreno * $rowAefTerrenos->valor_unitario_neto * ($rowAefTerrenos->indiviso/100);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public static function updAefTerrenos($inputs, &$valor_terreno, &$total_valor_fisico) {
		$rowAefTerrenos = AefTerrenos::find($inputs["idaefterreno"]);
		
		$rowAefTerrenos->fraccion = $inputs["fraccion"];
		$rowAefTerrenos->irregular = $inputs["irregular"];
		$rowAefTerrenos->fk_top = $inputs["idfactortop"];
		$rowAefTerrenos->top = $inputs["top"];
		$rowAefTerrenos->fk_frente = $inputs["idfactorfrente"];
		$rowAefTerrenos->frente = $inputs["frente"];
		$rowAefTerrenos->fk_forma = $inputs["idfactorforma"];
		$rowAefTerrenos->forma = $inputs["forma"];
		$rowAefTerrenos->fk_otros = $inputs["idfactorotros"];
		$rowAefTerrenos->otros = $inputs["otros"];
		$rowAefTerrenos->indiviso = $inputs["indiviso_terrenos"];
		$rowAefTerrenos->factor_resultante = $rowAefTerrenos->irregular * $rowAefTerrenos->top * $rowAefTerrenos->frente * $rowAefTerrenos->forma * $rowAefTerrenos->otros;
		
		AefTerrenos::updBeforeAefTerrenos($inputs, $rowAefTerrenos);
		
		$rowAefTerrenos->ip = $_SERVER['REMOTE_ADDR'];
		$rowAefTerrenos->host = isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : '';
		$rowAefTerrenos->modi_por = Auth::Id();
		$rowAefTerrenos->modi_el = date('Y-m-d H:i:s');
		$rowAefTerrenos->save();
		
		AefTerrenos::updAfterAefTerrenos($inputs['idavaluoenfoquefisico1'], $valor_terreno, $total_valor_fisico);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public static function updAfterAefTerrenos($idavaluoenfoquefisico, &$valor_terreno, &$total_valor_fisico) {
		$rowAefTerrenos = AefTerrenos::select(DB::raw('sum(valor_parcial) AS valorpar'))->where('idavaluoenfoquefisico', '=', $idavaluoenfoquefisico)->first();
		$rowEnfoqueFisico = AvaluosFisico::find($idavaluoenfoquefisico);
		$rowEnfoqueFisico->valor_terreno = $rowAefTerrenos->valorpar;
		$rowEnfoqueFisico->total_valor_fisico = AvaluosFisico::updBeforeAvaluoEnfoqueFisico($rowEnfoqueFisico);
		$rowEnfoqueFisico->save();
		$valor_terreno = $rowEnfoqueFisico->valor_terreno;
		$total_valor_fisico = $rowEnfoqueFisico->total_valor_fisico;
		//AvaluosFisico::updAfterAvaluoEnfoqueFisico($rowEnfoqueFisico->idavaluo, $rowEnfoqueFisico->total_valor_fisico);
	}

	public static function setAefTerrenos($fk) {
		
	}

	public static function getAjaxAefTerrenosByFk($fk) {
		$pato = array();
		$rows = AefTerrenos::select(
		'aef_terrenos.idaefterreno', 
		'aef_terrenos.fraccion',
		'aef_terrenos.superficie',
		'aef_terrenos.irregular',
		'aef_terrenos.top',
		'aef_terrenos.frente',
		'aef_terrenos.forma',
		'aef_terrenos.otros',
		'aef_terrenos.factor_resultante',
		'aef_terrenos.valor_unitario_neto',
		'aef_terrenos.indiviso',
		'aef_terrenos.valor_parcial')
						->where('aef_terrenos.idavaluoenfoquefisico', '=', $fk)
						->orderBy('aef_terrenos.idaefterreno')
						->get();
		$count = count($rows);
		 foreach ($rows as $row) {
			 $pato[] = array(
				$row['idaefterreno'], 
				$row['fraccion'], 
				$row['superficie'], 
				$row['irregular'], 
				$row['top'], 
				$row['frente'], 
				$row['forma'], 
				$row['otros'], 
				$row['factor_resultante'], 
				$row['valor_unitario_neto'], 
				$row['indiviso'], 
				$row['valor_parcial'], 
				'<a class="btn btn-xs btn-info btnEdit"  title="Editar" onclick="$.editAefTerrenos('.$row['idaefterreno'].');"><i class="glyphicon glyphicon-pencil"></i></a>', 
				'<a class="btn btn-xs btn-danger btnDel" title="Eliminar" onclick="$.delAefTerrenos('.$row['idaefterreno'].');"><i class="glyphicon glyphicon-remove"></i></a>');
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
