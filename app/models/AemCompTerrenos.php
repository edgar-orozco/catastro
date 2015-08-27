<?php

class AemCompTerrenos extends \Eloquent {

	protected $connection = 'corevat';
	protected $fillable = [];
	protected $table = 'aem_comp_terrenos';
	protected $primaryKey = 'idaemcompterreno';
	public $timestamps = false;

	public function AemHomologacion() {
		return $this->hasOne('AemHomologacion', 'idaemcompterreno', 'idaemcompterreno');
	}
	public static function getAemCompTerrenosByFk($idavaluoenfoquemercado) {
		return AemCompTerrenos::select('*')
						->where('idavaluoenfoquemercado', '=', $idavaluoenfoquemercado)
						->orderBy('idaemcompterreno')
						->get();
	}

	public static function getAemHomologacionByFk($idavaluoenfoquemercado) {
		return AemHomologacion::select('aem_homologacion.*')
						->join('aem_comp_terrenos', 'aem_homologacion.idaemcompterreno', '=', 'aem_comp_terrenos.idaemcompterreno')
						->where('aem_comp_terrenos.idavaluoenfoquemercado', '=', $idavaluoenfoquemercado)
						->orderBy('aem_homologacion.idaemhomologacion')
						->get();
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public static function insAemCompTerrenos($inputs) {
		$rowAemCompTerrenos = new AemCompTerrenos();
		$rowAemCompTerrenos->idavaluoenfoquemercado = $inputs['idavaluoenfoquemercado1'];
		$rowAemCompTerrenos->ubicacion = $inputs['ubicacion_aemcompterreno'];
		$rowAemCompTerrenos->precio = $inputs['precio'];
		$rowAemCompTerrenos->superficie_terreno = $inputs['superficie_terreno_aemcompterreno'];
		$rowAemCompTerrenos->observaciones = $inputs['observaciones_aemcompterreno'];
		$rowAemCompTerrenos->superficie_construida = 0.00;
		$rowAemCompTerrenos->precio_unitario_m2_terreno = ( $rowAemCompTerrenos->superficie_terreno <= 0 ? 0.00 : ( round($rowAemCompTerrenos->precio / $rowAemCompTerrenos->superficie_terreno, 2) ) );
		$rowAemCompTerrenos->precio_unitario_m2_construccion = 0.00;
		$rowAemCompTerrenos->idemp = 1;
		$rowAemCompTerrenos->ip = $_SERVER['REMOTE_ADDR'];
		$rowAemCompTerrenos->host = isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : '';
		$rowAemCompTerrenos->creado_por = Auth::Id();
		$rowAemCompTerrenos->creado_el = date('Y-m-d H:i:s');
		$rowAemCompTerrenos->save();
		
		AemHomologacion::insAemHomologacion($rowAemCompTerrenos->idavaluoenfoquemercado, $rowAemCompTerrenos->idaemcompterreno, $rowAemCompTerrenos->ubicacion, $rowAemCompTerrenos->superficie_terreno, $rowAemCompTerrenos->precio_unitario_m2_terreno);
	}
	
	public static function updAemCompTerrenos($inputs) {
		$rowAemCompTerrenos = AemCompTerrenos::find($inputs['idaemcompterreno']);
		$rowAemCompTerrenos->ubicacion = $inputs['ubicacion_aemcompterreno'];
		// PRECIO DE OFERTA
		$rowAemCompTerrenos->precio = $inputs['precio'];
		// SUPERFICIE DEL TERRENO
		$rowAemCompTerrenos->superficie_terreno = $inputs['superficie_terreno_aemcompterreno'];
		$rowAemCompTerrenos->observaciones = $inputs['observaciones_aemcompterreno'];
		$rowAemCompTerrenos->precio_unitario_m2_terreno = ( $rowAemCompTerrenos->superficie_terreno <= 0 ? 0.00 : ( round($rowAemCompTerrenos->precio / $rowAemCompTerrenos->superficie_terreno, 2) ) );

		$rowAemCompTerrenos->ip = $_SERVER['REMOTE_ADDR'];
		$rowAemCompTerrenos->host = isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : '';
		$rowAemCompTerrenos->modi_por = Auth::Id();
		$rowAemCompTerrenos->modi_el = date('Y-m-d H:i:s');
		$rowAemCompTerrenos->save();
		
		$rowAemHomologacion = AemCompTerrenos::find($inputs['idaemcompterreno'])->AemHomologacion;
		$rowAemHomologacion->valor_unitario = $rowAemCompTerrenos->precio_unitario_m2_terreno;
		$rowAemHomologacion->superficie_terreno = $rowAemCompTerrenos->superficie_terreno;
		

		// aqui hay que volver a calcular aem_homologacion.valor_unitario_resultante_m2
		// avaluo_enfoque_mercado.valor_unitario_promedio Y avaluo_enfoque_mercado.valor_aplicado_m2
		
		$rowAvaluoEnfoqueMercado = AvaluosMercado::find($rowAemCompTerrenos->idavaluoenfoquemercado);
		$rowAvaluoInmueble = Avaluos::find($rowAvaluoEnfoqueMercado->idavaluo)->AvaluosInmueble;
		if ($rowAvaluoInmueble->superficie_total_terreno > 0) {
			$rowAemHomologacion->superficie = round( pow($rowAemHomologacion->superficie_terreno / $rowAvaluoInmueble->superficie_total_terreno, 0.166666666666667 ), 2);
			$rowAemHomologacion->valor_unitario_resultante_m2 = $rowAemHomologacion->valor_unitario *
					$rowAemHomologacion->zona * $rowAemHomologacion->ubicacion * $rowAemHomologacion->frente *
					$rowAemHomologacion->forma * $rowAemHomologacion->superficie *
					$rowAemHomologacion->valor_unitario_negociable;
		}
		$rowAemHomologacion->save();
		
		AvaluosMercado::updateAemValorUnitario($rowAemCompTerrenos->idavaluoenfoquemercado);
		
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $idavaluo
	 * @return Response
	 */
	public static function getAjaxAemCompTerrenosByFk($fk) {
		$pato = array();
		$rows = AemCompTerrenos::select(
		'aem_comp_terrenos.idaemcompterreno', 
		'aem_comp_terrenos.ubicacion', 
		'aem_comp_terrenos.precio', 
		'aem_comp_terrenos.superficie_terreno', 
		'aem_comp_terrenos.precio_unitario_m2_terreno',
		'aem_comp_terrenos.observaciones'
		)
						->where('aem_comp_terrenos.idavaluoenfoquemercado', '=', $fk)
						->orderBy('aem_comp_terrenos.idaemcompterreno')
						->get();
		$count = count($rows);
		$i = 0;
		 foreach ($rows as $row) {
			 $pato[] = array(
				++$i,
				$row['idaemcompterreno'], 
				$row['ubicacion'], 
				$row['precio'], 
				$row['superficie_terreno'], 
				$row['precio_unitario_m2_terreno'], 
				$row['observaciones'], 
				'<a class="btn btn-xs btn-info btnEdit"  title="Editar" onclick="$.editAemCompTerrenos('.$row['idaemcompterreno'].');"><i class="glyphicon glyphicon-pencil"></i></a>', 
				'<a class="btn btn-xs btn-danger btnDel" title="Eliminar" onclick="$.delAemCompTerrenos('.$row['idaemcompterreno'].');"><i class="glyphicon glyphicon-remove"></i></a>');
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
