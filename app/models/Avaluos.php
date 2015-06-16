<?php

class Avaluos extends \Eloquent {

	protected $connection = 'corevat';
	protected $fillable = [];
	protected $table = 'avaluos';
	protected $primaryKey = 'idavaluo';
	public $timestamps = false;

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function AvaluosZona() {
		return $this->hasOne('AvaluosZona', 'idavaluo', 'idavaluo');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function AvaluosInmueble() {
		return $this->hasOne('AvaluosInmueble', 'idavaluo', 'idavaluo');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function AvaluosMercado() {
		return $this->hasOne('AvaluosMercado', 'idavaluo', 'idavaluo');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function AvaluosFisico() {
		return $this->hasOne('AvaluosFisico', 'idavaluo', 'idavaluo');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function AvaluosConclusiones() {
		return $this->hasOne('AvaluosConclusiones', 'idavaluo', 'idavaluo');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function AvaluosFotos() {
		return $this->hasOne('AvaluosFotos', 'idavaluo', 'idavaluo');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getAvaluo($id) {
		return Avaluos::select('avaluos.*', 'estados.estado', 'municipios.municipio', 'cat_tipo_inmueble.tipo_inmueble', 'cat_regimen_propiedad.regimen_propiedad')
						->leftJoin('estados', 'avaluos.idestado', '=', 'estados.idestado')
						->leftJoin('municipios', 'avaluos.idmunicipio', '=', 'municipios.idmunicipio')
						->leftJoin('cat_tipo_inmueble', 'avaluos.idtipoinmueble', '=', 'cat_tipo_inmueble.idtipoinmueble')
						->leftJoin('cat_regimen_propiedad', 'avaluos.idregimenpropiedad', '=', 'cat_regimen_propiedad.idregimenpropiedad')
						->where('avaluos.idavaluo', '=', $id)
						->orderBy('avaluos.idavaluo')
						->get();
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  array  $row
	 * @return Response
	 */
	private static function setAvaluo(&$row, $inputs) {
		$row->proposito = $inputs["proposito"];
		$row->finalidad = $inputs["finalidad"];
		$row->idmunicipio = $inputs["idmunicipio"];
		$row->idestado = $inputs["idestado"];
		$row->idestado = $inputs["idestado"];
		$row->fecha_reporte = $inputs["fecha_reporte"];
		$row->fecha_avaluo = $inputs["fecha_avaluo"];
		$row->serie = $inputs["serie"];
		$row->folio = 0;
		$row->foliocoretemp = $inputs["foliocoretemp"];
		$row->idtipoinmueble = $inputs["idtipoinmueble"];
		$row->ubicacion = $inputs["ubicacion"];
		$row->conjunto = $inputs["conjunto"];
		$row->colonia = $inputs["colonia"];
		$row->cp = $inputs["cp"];
		$row->latitud = $inputs["lat0"] . "°" . $inputs["lat1"] . "'" . $inputs["lat2"];
		$row->lat0 = strlen($inputs["lat0"]) == 0 ? 0 : $inputs["lat0"];
		$row->lat1 = strlen($inputs["lat1"]) == 0 ? 0 : $inputs["lat1"];
		$row->lat2 = strlen($inputs["lat2"]) == 0 ? 0 : $inputs["lat2"];
		$row->longitud = $inputs["lon0"] . "°" . $inputs["lon1"] . "'" . $inputs["lon2"];
		$row->lon0 = strlen($inputs["lon0"]) == 0 ? 0 : $inputs["lon0"];
		$row->lon1 = strlen($inputs["lon1"]) == 0 ? 0 : $inputs["lon1"];
		$row->lon2 = strlen($inputs["lon2"]) == 0 ? 0 : $inputs["lon2"];
		$row->altitud = $inputs["altitud"];
		$row->idregimenpropiedad = $inputs["idregimenpropiedad"];
		$row->cuenta_predial = $inputs["cuenta_predial"];
		$row->cuenta_catastral = $inputs["cuenta_catastral"];
		$row->nombre_solicitante = $inputs["nombre_solicitante"];
		$row->nombre_propietario = $inputs["nombre_propietario"];
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public static function insAvaluo($inputs) {
		$row = new Avaluos();
		Avaluos::setAvaluo($row, $inputs);
		$row->iduser = 1; //Auth::id()
		$row->idemp = 1; //Auth::id()
		$row->ip = $_SERVER['REMOTE_ADDR'];
		$row->host = isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : '';
		$row->creado_por = 1;
		$row->creado_el = date('Y-m-d H:i:s');
		$row->save();
		AvaluosZona::insAvaluoZona($row->idavaluo);
		AvaluosInmueble::insAvaluoInmueble($row->idavaluo);
		AvaluosMercado::insAvaluoMercado($row->idavaluo);
		AvaluosFisico::insAvaluoFisico($row->idavaluo);
		AvaluosConclusiones::insAvaluoConclusiones($row->idavaluo);
		AvaluosFotos::insAvaluoFotos($row->idavaluo);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public static function updAvaluo($id, $inputs) {
		$row = Avaluos::find($id);
		$row->iduser = 1; //Auth::id()
		Avaluos::setAvaluo($row, $inputs);
		$row->modi_por = 1; //Auth::id()
		$row->modi_el = date('Y-m-d H:i:s');
		$row->save();
	}

}
