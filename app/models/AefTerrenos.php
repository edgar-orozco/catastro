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

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public static function insAefTerrenos($inputs, &$valor_terreno, &$total_valor_fisico) {
		$rowAefTerrenos = new AefTerrenos();
		$rowAefTerrenos->idavaluoenfoquefisico = $inputs["idavaluoenfoquefisico1"];
		$rowAefTerrenos->created_at = $inputs["created_at"];
		AefTerrenos::setAefTerrenos($rowAefTerrenos, $inputs);
		$rowAefTerrenos->save();
		$rowAef = AvaluosFisico::find($rowAefTerrenos->idavaluoenfoquefisico);
		$valor_terreno = $rowAef->valor_terreno;
		$total_valor_fisico = $rowAef->total_valor_fisico;
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public static function updAefTerrenos($inputs, &$valor_terreno, &$total_valor_fisico) {
		$rowAefTerrenos = AefTerrenos::find($inputs["idaefterreno"]);
		$rowAefTerrenos->updated_at = $inputs["updated_at"];
		AefTerrenos::setAefTerrenos($rowAefTerrenos, $inputs);
		$rowAefTerrenos->save();
		$rowAef = AvaluosFisico::find($rowAefTerrenos->idavaluoenfoquefisico);
		$valor_terreno = $rowAef->valor_terreno;
		$total_valor_fisico = $rowAef->total_valor_fisico;
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public static function setAefTerrenos($rowAefTerrenos, $inputs) {
		$rowAefTerrenos->fraccion = $inputs["fraccion"];
		$rowAefTerrenos->irregular = $inputs["irregular"];
		$rowAefTerrenos->fk_top = $inputs["idfactortop"];
		$rowAefTerrenos->top = $inputs["top_terrenos"];
		$rowAefTerrenos->fk_frente = $inputs["idfactorfrente"];
		$rowAefTerrenos->frente = $inputs["frente"];
		$rowAefTerrenos->fk_forma = $inputs["idfactorforma"];
		$rowAefTerrenos->forma = $inputs["forma"];
		// [103713434] $rowAefTerrenos->fk_otros = $inputs["idfactorotros"];
		$rowAefTerrenos->otros = $inputs["otros"];
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
		'avaluo_enfoque_mercado.valor_aplicado_m2',
		'aef_terrenos.valor_unitario_neto',
		'aef_terrenos.indiviso',
		'aef_terrenos.valor_parcial')
						->leftJoin('avaluo_enfoque_fisico', 'aef_terrenos.idavaluoenfoquefisico', '=', 'avaluo_enfoque_fisico.idavaluoenfoquefisico')
						->leftJoin('avaluo_enfoque_mercado', 'avaluo_enfoque_mercado.idavaluo', '=', 'avaluo_enfoque_fisico.idavaluo')
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
				$row['valor_aplicado_m2'],
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

	public static function clonarAefTerrenos($idavaluoenfoquefisicoold, $idavaluoenfoquefisiconew) {
		$rowsAefTerrenosOld = AefTerrenos::select('*')->where('idavaluoenfoquefisico', '=', $idavaluoenfoquefisicoold)->get();
		foreach ($rowsAefTerrenosOld as $rowAefTerrenosOld) {
			AefTerrenos::clonarAefTerrenosIns($idavaluoenfoquefisiconew, $rowAefTerrenosOld);
		}
		
	}
	
	private static function clonarAefTerrenosIns($idavaluoenfoquefisiconew, $rowAefTerrenosOld) {
		$rowAefTerrenosNew = new AefTerrenos();
		$rowAefTerrenosNew->idavaluoenfoquefisico = $idavaluoenfoquefisiconew;
		$rowAefTerrenosNew->fraccion = $rowAefTerrenosOld->fraccion;
		$rowAefTerrenosNew->superficie = $rowAefTerrenosOld->superficie;
		$rowAefTerrenosNew->irregular = $rowAefTerrenosOld->irregular;
		$rowAefTerrenosNew->top = $rowAefTerrenosOld->top;
		$rowAefTerrenosNew->frente = $rowAefTerrenosOld->frente;
		$rowAefTerrenosNew->forma = $rowAefTerrenosOld->forma;
		$rowAefTerrenosNew->otros = $rowAefTerrenosOld->otros;
		$rowAefTerrenosNew->factor_resultante = $rowAefTerrenosOld->factor_resultante;
		$rowAefTerrenosNew->valor_unitario_neto = $rowAefTerrenosOld->valor_unitario_neto;
		$rowAefTerrenosNew->indiviso = $rowAefTerrenosOld->indiviso;
		$rowAefTerrenosNew->valor_parcial = $rowAefTerrenosOld->valor_parcial;
		$rowAefTerrenosNew->in_promedio = $rowAefTerrenosOld->in_promedio;
		$rowAefTerrenosNew->fk_frente = $rowAefTerrenosOld->fk_frente;
		$rowAefTerrenosNew->fk_forma = $rowAefTerrenosOld->fk_forma;
		$rowAefTerrenosNew->fk_top = $rowAefTerrenosOld->fk_top;
		$rowAefTerrenosNew->fk_otros = $rowAefTerrenosOld->fk_otros;
		$rowAefTerrenosNew->save();
	}
}
