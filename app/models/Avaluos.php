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
	public static function getAvaluo($idavaluo) {
		return Avaluos::select('avaluos.*', 'usuarios.foto', 'usuarios.nombres', 'usuarios.apellidos', 'usuarios.cedulaprofesional',
				'usuarios.registro', 'usuarios.registro_colegio', 'usuarios.status_usuario', 
				'estados.estado', 'municipios.municipio', 'cat_tipo_inmueble.tipo_inmueble', 'cat_regimen_propiedad.regimen_propiedad',
				'avaluo_inmueble.superficie_construccion', 'avaluo_inmueble.superficie_terreno',
				'avaluo_conclusiones.valor_fisico', 'avaluo_conclusiones.valor_mercado', 'avaluo_conclusiones.valor_concluido')
						->leftJoin('usuarios', 'avaluos.iduser', '=', 'usuarios.iduser')
						->leftJoin('estados', 'avaluos.idestado', '=', 'estados.idestado')
						->leftJoin('municipios', 'avaluos.idmunicipio', '=', 'municipios.idmunicipio')
						->leftJoin('cat_tipo_inmueble', 'avaluos.idtipoinmueble', '=', 'cat_tipo_inmueble.idtipoinmueble')
						->leftJoin('cat_regimen_propiedad', 'avaluos.idregimenpropiedad', '=', 'cat_regimen_propiedad.idregimenpropiedad')
						->leftJoin('avaluo_inmueble', 'avaluos.idavaluo', '=', 'avaluo_inmueble.idavaluo')
						->leftJoin('avaluo_conclusiones', 'avaluos.idavaluo', '=', 'avaluo_conclusiones.idavaluo')
						->where('avaluos.idavaluo', '=', $idavaluo)
						->orderBy('avaluos.idavaluo')
						->first();
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
		$municipios = Municipios::where('clave', $inputs["idmunicipio"])->first();
		$row->idmunicipio = $municipios->idmunicipio;
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
		
		$row->cuenta_catastral = $inputs["cuenta_catastral"];
		
		// DIVIDIMOS LA CUENTA CATASTRAL PARA POSTERIORMENTE INCORPORAR LA LETRA "U" O "R"
		// QUE SON LOS POSIBLES VALORES DEL COMBO "Serie" DE LA UI.
		if ( $inputs["cuenta_predial"] =='' )  {
			$row->cuenta_predial = strtoupper($inputs["cuenta_predial"]);
		} else {
			$a = preg_split("/-/", $inputs["cuenta_predial"]);
			$row->cuenta_predial = $a[0]."-".$inputs["serie"]."-".$a[2];
		}
		
		$row->nombre_solicitante = $inputs["nombre_solicitante"];
		$row->nombre_propietario = $inputs["nombre_propietario"];
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public static function insAvaluo(&$inputs) {
		$row = new Avaluos();
		Avaluos::setAvaluo($row, $inputs);
		$row->iduser = Auth::id();
		$row->idemp = 1; //Auth::id()
		$row->ip = $_SERVER['REMOTE_ADDR'];
		$row->host = isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : '';
		$row->creado_por = Auth::id(); // 1;
		$row->creado_el = date('Y-m-d H:i:s');
		$row->cuenta_catastral = strtoupper($inputs["cuenta_catastral"]);
		$row->save();
		AvaluosZona::insAvaluoZona($row->idavaluo);
		AvaluosInmueble::insAvaluoInmueble($row->idavaluo);
		AvaluosMercado::insAvaluoMercado($row->idavaluo);
		AvaluosFisico::insAvaluoFisico($row->idavaluo);
		AvaluosConclusiones::insAvaluoConclusiones($row->idavaluo);
		AvaluosFotos::insAvaluoFotos($row->idavaluo);
		$inputs["idavaluo"] = $row->idavaluo;
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
		$row->modi_por = Auth::id();
		$row->modi_el = date('Y-m-d H:i:s');
		$row->save();
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $idavaluo
	 * @return Response
	 */
	public static function getAiMedidasColindanciasByIdForPdf($idavaluoinmueble) {
		return AvaluosZona::select('ai_medidas_colindancias.*', 'ori.orientacion AS orientacion')
						->leftJoin('cat_orientaciones AS ori', 'ai_medidas_colindancias.idorientacion', '=', 'ori.idorientacion')
						->where('ai_medidas_colindancias.idavaluoinmueble', '=', $idavaluoinmueble)
						->orderBy('ai_medidas_colindancias.idaimedidacolindancia')
						->get();
	}
/*
	public static function getFoliosDisponibles($id) {
		$pato = array();
		$perito = PeritoUsuario::select('*')->where('user_id', '=', $id)->first();
		$folios = FoliosComprados::select('*')->where('perito_id', '=', $perito->perito_id)->get();
		foreach ($folios as $folio) {
			$pato[] = array($folio['numero_folio'], $folio['numero_folio']);
		}
		return $pato;
	}
*/
}
/*
		$rows = AiMedidasColindancias::select('ai_medidas_colindancias.*', 'cat_orientaciones.orientacion')
						->leftJoin('cat_orientaciones', 'ai_medidas_colindancias.idorientacion', '=', 'cat_orientaciones.idorientacion')
						->where('ai_medidas_colindancias.idavaluoinmueble', '=', $fk)
						->orderBy('ai_medidas_colindancias.idaimedidacolindancia')
						->get();
						
		 foreach ($rows as $row) {
			 $pato[] = array(
				$row['idaimedidacolindancia'], 
				$row['idorientacion'], 
				$row['orientacion'], 
				$row['unidad_medida'], 
				$row['medidas'], 
				$row['medida'], 
				$row['colindancia'], 
				'<a class="btn btn-xs btn-info btnEdit"  title="Editar" onclick="$.editAiMedidasColindancias('.$row['idaimedidacolindancia'].');"><i class="glyphicon glyphicon-pencil"></i></a>', 
				'<a class="btn btn-xs btn-danger btnDel" title="Eliminar" onclick="$.delAiMedidasColindancias('.$row['idaimedidacolindancia'].');"><i class="glyphicon glyphicon-remove"></i></a>');
		 }
*/