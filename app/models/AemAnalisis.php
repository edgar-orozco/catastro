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
		$rowAemAnalisis = AemAnalisis::find($inputs["idaemanalisis"]);

		$rowAemAnalisis->precio_venta = $inputs['precio_venta'] == '' ? 0.00 : $inputs['precio_venta'];
		$rowAemAnalisis->superficie_terreno = $inputs['superficie_terreno_aemanalisis'] == '' ? 0.00 : $inputs['superficie_terreno_aemanalisis'];
		$rowAemAnalisis->superficie_construccion = $inputs['superficie_construccion_aemanalisis'] == '' ? 0.00 : $inputs['superficie_construccion_aemanalisis'];

		$rowAemAnalisis->fk_zona = $inputs["idfactorzona_aemanalisis"];
		$rowAemAnalisis->factor_zona = $inputs["factor_zona"];

		$rowAemAnalisis->fk_ubicacion = $inputs["idfactorubicacion_aemanalisis"];
		$rowAemAnalisis->factor_ubicacion = $inputs["factor_ubicacion"];

		$rowAemAnalisis->factor_edad = $inputs['factor_edad'] == '' ? 0.00 : $inputs['factor_edad'];

		$rowAemAnalisis->fk_conservacion = $inputs["idfactorconservacion"];
		$rowAemAnalisis->factor_conservacion = $inputs["factor_conservacion"];

		$rowAemAnalisis->factor_negociacion = $inputs['factor_negociacion'] == '' ? 0.00 : $inputs['factor_negociacion'];

		$rowAemAnalisis->in_promedio = isset($inputs["in_promedio_aemanalisis"]) ? 1 : 0;

		$rowAemAnalisis->updated_at = $inputs["updated_at"];
		
		$rowAemAnalisis->save();

	}

	public static function getAjaxAemAnalisisByFk($fk) {
		$pato = array();
		$rows = AemAnalisis::select(
						'aem_analisis.idaemanalisis', 'aem_analisis.precio_venta', 'aem_analisis.superficie_terreno', 'aem_analisis.superficie_construccion', 'aem_analisis.valor_unitario_m2', 'aem_analisis.factor_zona', 'aem_analisis.factor_ubicacion', 'aem_analisis.factor_superficie', 'aem_analisis.factor_edad', 'aem_analisis.factor_conservacion', 'aem_analisis.factor_negociacion', 'aem_analisis.factor_resultante', 'aem_analisis.valor_unitario_resultante_m2')
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
				'<a class="btn btn-xs btn-info btnEdit"  title="Editar" onclick="$.editAemAnalisis(' . $row['idaemanalisis'] . ');"><i class="glyphicon glyphicon-pencil"></i></a>');
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
