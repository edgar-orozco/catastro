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
	public static function insAemCompTerrenos($inputs, &$idaemcompterreno) {
		$rowAemCompTerrenos = new AemCompTerrenos();
		$rowAemCompTerrenos->idavaluoenfoquemercado = $inputs['idAem'];
		$rowAemCompTerrenos->ubicacion = $inputs['ubicacion'];
		$rowAemCompTerrenos->precio = $inputs['precio'];
		$rowAemCompTerrenos->superficie_terreno = $inputs['superficie_terreno'];
		$rowAemCompTerrenos->superficie_construida = 0.00;
		$precio = (float) $inputs['precio'];
		$superficie_terreno = (float) $inputs['superficie_terreno'];
		$rowAemCompTerrenos->precio_unitario_m2_terreno = ( (float) $inputs['superficie_terreno'] <= 0 ? 0.00 : ( round($precio / $superficie_terreno, 4) ) );
		$rowAemCompTerrenos->precio_unitario_m2_construccion = 0.00;
		$rowAemCompTerrenos->observaciones = $inputs['observaciones'];
		$rowAemCompTerrenos->idemp = 1;
		$rowAemCompTerrenos->ip = $_SERVER['REMOTE_ADDR'];
		$rowAemCompTerrenos->host = isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : '';
		$rowAemCompTerrenos->creado_por = 1;
		$rowAemCompTerrenos->creado_el = date('Y-m-d H:i:s');
		$rowAemCompTerrenos->save();
		AemHomologacion::insAemHomologacion($rowAemCompTerrenos->idavaluoenfoquemercado, $rowAemCompTerrenos->idaemcompterreno, $rowAemCompTerrenos->ubicacion, $rowAemCompTerrenos->superficie_terreno, $rowAemCompTerrenos->precio_unitario_m2_terreno);
		$idaemcompterreno = $rowAemCompTerrenos->idaemcompterreno;
	}

	public static function updAemCompTerrenos($inputs) {
		$rowAemCompTerrenos = AemCompTerrenos::find($inputs['idTable']);
		$rowAemCompTerrenos->ubicacion = $inputs['ubicacion'];
		$rowAemCompTerrenos->precio = $inputs['precio'];
		$rowAemCompTerrenos->superficie_terreno = $inputs['superficie_terreno'];
		$precio = (float) $inputs['precio'];
		$superficie_terreno = (float) $inputs['superficie_terreno'];
		$rowAemCompTerrenos->precio_unitario_m2_terreno = ( (float) $inputs['superficie_terreno'] <= 0 ? 0.00 : ( round($precio / $superficie_terreno, 4) ) );
		$rowAemCompTerrenos->observaciones = $inputs['observaciones'];
		$rowAemCompTerrenos->ip = $_SERVER['REMOTE_ADDR'];
		$rowAemCompTerrenos->host = isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : '';
		$rowAemCompTerrenos->modi_por = 1;
		$rowAemCompTerrenos->modi_el = date('Y-m-d H:i:s');
		$rowAemCompTerrenos->save();
		
		$rowAemHomologacion = AemCompTerrenos::find($inputs['idTable'])->AemHomologacion;
		$rowAemHomologacion->valor_unitario = $rowAemCompTerrenos->precio_unitario_m2_terreno;
		$rowAemHomologacion->superficie_terreno = $rowAemCompTerrenos->superficie_terreno;
		
		$rowAvaluoEnfoqueMercado = AvaluosMercado::find($rowAemCompTerrenos->idavaluoenfoquemercado);
		$rowAvaluoInmueble = Avaluos::find($rowAvaluoEnfoqueMercado->idavaluo)->AvaluosInmueble;
		if ($rowAvaluoInmueble->superficie_total_terreno > 0) {
			$rowAemHomologacion->superficie =round(  pow($rowAemHomologacion->superficie_terreno / $rowAvaluoInmueble->superficie_total_terreno, 1 / 6), 2);
			$rowAemHomologacion->valor_unitario_resultante_m2 = $rowAemHomologacion->valor_unitario *
					$rowAemHomologacion->zona * $rowAemHomologacion->ubicacion * $rowAemHomologacion->frente *
					$rowAemHomologacion->forma * $rowAemHomologacion->superficie *
					$rowAemHomologacion->valor_unitario_negociable;
		}
		$rowAemHomologacion->save();
		AvaluosMercado::updateAemValorUnitario($rowAemCompTerrenos->idavaluoenfoquemercado);
		
	}
}
