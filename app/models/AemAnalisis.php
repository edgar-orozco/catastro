<?php

class AemAnalisis extends \Eloquent {

	protected $connection = 'corevat';
	protected $fillable = [];
	protected $table = 'aem_analisis';
	protected $primaryKey = 'idaemanalisis';
	public $timestamps = false;

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public static function updAemAnalisis($inputs) {
		$rowAemAnalisis = AemAnalisis::find($inputs["idTable"]);
		$rowCatFactoresZonas = CatFactoresZonas::find($inputs["idfactorzona"]);
		$rowAemAnalisis->factor_zona = $rowCatFactoresZonas->valor_factor_zona;
		$rowCatFactoresUbicacion = CatFactoresUbicacion::find($inputs["idfactorubicacion"]);
		$rowAemAnalisis->factor_ubicacion = $rowCatFactoresUbicacion->valor_factor_ubicacion;
		$rowCatFactoresConservacion = CatFactoresConservacion::find($inputs["idfactorconservacion"]);
		$rowAemAnalisis->factor_conservacion = $rowCatFactoresConservacion->valor_factor_conservacion;
		
		$rowAemAnalisis->in_promedio = isset($inputs["in_promedio"]) ? 1 : 0;
		$rowAemAnalisis->precio_venta = $inputs['precio_venta']=='' ? 0.00 : $inputs['precio_venta'];
		$rowAemAnalisis->superficie_terreno = $inputs['superficie_terreno']=='' ? 0.00 : $inputs['superficie_terreno'];
		$rowAemAnalisis->superficie_construccion = $inputs['superficie_construccion']=='' ? 0.00 : $inputs['superficie_construccion'];
		$rowAemAnalisis->factor_superficie = $inputs['factor_superficie']=='' ? 0.00 : $inputs['factor_superficie'];
		$rowAemAnalisis->factor_edad = $inputs['factor_edad']=='' ? 0.00 : $inputs['factor_edad'];
		$rowAemAnalisis->factor_negociacion = $inputs['factor_negociacion']=='' ? 0.00 : $inputs['factor_negociacion'];
		
		$rowAemAnalisis->valor_unitario_m2 = $rowAemAnalisis->superficie_construccion==0 ? 0 : round($rowAemAnalisis->precio_venta/$rowAemAnalisis->superficie_construccion, 2);
		
		$rowAemAnalisis->factor_resultante = $rowAemAnalisis->factor_zona * $rowAemAnalisis->factor_ubicacion *
				$rowAemAnalisis->factor_superficie * $rowAemAnalisis->factor_edad * $rowAemAnalisis->factor_conservacion * 
				$rowAemAnalisis->factor_negociacion;
		
		$rowAemAnalisis->valor_unitario_resultante_m2 = $rowAemAnalisis->valor_unitario_m2 * $rowAemAnalisis->factor_resultante;
		
		$rowAemAnalisis->save();
		
		AemAnalisis::aemAnalisisAfterUpdate($rowAemAnalisis->idavaluoenfoquemercado, $rowAemAnalisis->in_promedio);
	}
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public static function aemAnalisisAfterUpdate($idavaluoenfoquemercado, $in_promedio) {
		$PRD = $PRDTerr = $PRDMin = $PRDMax = $PRR = $PRRMin = $PRRMax = 0; 
		if ( $in_promedio == 1 ) {
			// Obtenemos el Promedio Terreno
			$PRDTerr = AemAnalisis::select(DB::raw('avg(superficie_terreno) AS avg'))->groupBy('idavaluoenfoquemercado')->where('idavaluoenfoquemercado', '=', $idavaluoenfoquemercado)->where('in_promedio', '=', 1)->first();
			// Obtenemos el Promedio Construccion
			$PRDConst = AemAnalisis::select(DB::raw('avg(superficie_construccion) AS avg'))->groupBy('idavaluoenfoquemercado')->where('idavaluoenfoquemercado', '=', $idavaluoenfoquemercado)->where('in_promedio', '=', 1)->first();

			// Obtenemos el Promedio Directo
			$PRD = AemAnalisis::select(DB::raw('avg(valor_unitario_m2) AS avg'))->groupBy('idavaluoenfoquemercado')->where('idavaluoenfoquemercado', '=', $idavaluoenfoquemercado)->where('in_promedio', '=', 1)->first();
			// Obtenemos el Mínimo Directo
			$PRDMin = AemAnalisis::select(DB::raw('min(valor_unitario_m2) AS min'))->where('idavaluoenfoquemercado', '=', $idavaluoenfoquemercado)->where('in_promedio', '=', 1)->first();
			// Obtenemos el Maximo Directo
			$PRDMax = AemAnalisis::select(DB::raw('max(valor_unitario_m2) AS max'))->where('idavaluoenfoquemercado', '=', $idavaluoenfoquemercado)->where('in_promedio', '=', 1)->first();

			// Obtenemos el Promedio Resultante
			$PRR = AemAnalisis::select(DB::raw('avg(valor_unitario_resultante_m2) AS avg'))->groupBy('idavaluoenfoquemercado')->where('idavaluoenfoquemercado', '=', $idavaluoenfoquemercado)->where('in_promedio', '=', 1)->first();
			// Obtenemos el Mínimo Resultante
			$PRRMin = AemAnalisis::select(DB::raw('min(valor_unitario_resultante_m2) AS min'))->where('idavaluoenfoquemercado', '=', $idavaluoenfoquemercado)->where('in_promedio', '=', 1)->first();
			// Obtenemos el Mínimo Resultante
			$PRRMax = AemAnalisis::select(DB::raw('max(valor_unitario_resultante_m2) AS max'))->where('idavaluoenfoquemercado', '=', $idavaluoenfoquemercado)->where('in_promedio', '=', 1)->first();

			$vcm0 = $PRR->avg * $PRRMax->max;
			$vcm1 = $PRDConst->avg * $PRD->avg;
			
			$rowAem = AvaluosMercado::find($idavaluoenfoquemercado);
			$rowAem->promedio_directo = $PRD->avg;
			$rowAem->minimo_directo = $PRDMin->min;
			$rowAem->maximo_directo = $PRDMax->max;
			
			$rowAem->promedio_analisis = $PRR->avg;
			$rowAem->minimo_analisis = $PRRMin->min;
			$rowAem->maximo_analisis = $PRRMax->max;

			$rowAiM = Avaluos::find($rowAem->idavaluo)->AvaluosInmueble;
			
			$rowAem->valor_comparativo_mercado = round(($rowAiM->superficie_vendible * $PRR->avg),-1);
			
			$rowAem->save();

			$rowConclu = Avaluos::find($rowAem->idavaluo)->AvaluosConclusiones;
			
			$rowConclu->valor_mercado = $rowAem->valor_comparativo_mercado;
			
			$rowConclu->save();


		}
		
	}

	public static function getAjaxAemAnalisisByFk($fk) {
		$pato = array();
		$rows = AemAnalisis::select(
		'aem_analisis.idaemanalisis', 
		'aem_analisis.precio_venta',
		'aem_analisis.superficie_terreno',
		'aem_analisis.superficie_construccion',
		'aem_analisis.valor_unitario_m2',
		'aem_analisis.factor_zona',
		'aem_analisis.factor_ubicacion',
		'aem_analisis.factor_superficie',
		'aem_analisis.factor_edad',
		'aem_analisis.factor_conservacion',
		'aem_analisis.factor_negociacion',
		'aem_analisis.factor_resultante',
		'aem_analisis.valor_unitario_resultante_m2')
						->where('aem_analisis.idavaluoenfoquemercado', '=', $fk)
						->orderBy('aem_analisis.idaeminformacion')
						->get();
		$count = count($rows);
		$i = 0;
		 foreach ($rows as $row) {
			 $pato[] = array(
				++$i,
				$row['idaemanalisis'], 
				$row['precio_venta'], 
				$row['superficie_terreno'], 
				$row['superficie_construccion'], 
				$row['valor_unitario_m2'],
				$row['factor_zona'], 
				$row['factor_ubicacion'], 
				$row['factor_superficie'], 
				$row['factor_edad'],
				$row['factor_conservacion'], 
				$row['factor_negociacion'], 
				$row['factor_resultante'], 
				$row['valor_unitario_resultante_m2'],
				'<a class="btn btn-xs btn-info btnEdit"  title="Editar" onclick="$.editAemAnalisis('.$row['idaemanalisis'].');"><i class="glyphicon glyphicon-pencil"></i></a>');
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
