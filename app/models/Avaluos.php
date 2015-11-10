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
				'avaluo_conclusiones.valor_fisico', 'avaluo_conclusiones.valor_mercado', 'avaluo_conclusiones.valor_concluido', 
				'cat_finalidad.finalidad', 'a.titulo_persona AS titulo_solicitante', 'b.titulo_persona AS titulo_propietario')
						->leftJoin('usuarios', 'avaluos.iduser', '=', 'usuarios.iduser')
						->leftJoin('estados', 'avaluos.idestado', '=', 'estados.idestado')
						->leftJoin('municipios', 'avaluos.idmunicipio', '=', 'municipios.idmunicipio')
						->leftJoin('cat_tipo_inmueble', 'avaluos.idtipoinmueble', '=', 'cat_tipo_inmueble.idtipoinmueble')
						->leftJoin('cat_regimen_propiedad', 'avaluos.idregimenpropiedad', '=', 'cat_regimen_propiedad.idregimenpropiedad')
						->leftJoin('avaluo_inmueble', 'avaluos.idavaluo', '=', 'avaluo_inmueble.idavaluo')
						->leftJoin('avaluo_conclusiones', 'avaluos.idavaluo', '=', 'avaluo_conclusiones.idavaluo')
				
						->leftJoin('cat_finalidad', 'avaluos.fk_finalidad', '=', 'cat_finalidad.idfinalidad')
						->leftJoin('cat_titulo_persona AS a', 'avaluos.fk_titulo_solicitante', '=', 'a.idtitulopersona')
						->leftJoin('cat_titulo_persona AS b', 'avaluos.fk_titulo_propietario', '=', 'b.idtitulopersona')
				
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
		$row->fk_finalidad = $inputs["fk_finalidad"];
		$row->finalidad = $inputs["finalidad"];
		
		$municipios = Municipios::where('clave', $inputs["idmunicipio"])->first();
		$row->idmunicipio = $municipios->idmunicipio;
		//$row->idmunicipio = $inputs["idmunicipio"];
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
		
		$row->latitud = $inputs["latitud"];
		$row->longitud = $inputs["longitud"];
		$row->tp_coordenada = $inputs["tp_coordenada"];
		$row->sistema_coordenadas = isset($inputs["sistema_coordenadas"]) ? $inputs["sistema_coordenadas"] : '';
		$row->datum = isset($inputs["datum"]) ? $inputs["datum"] : '';
		
		$row->lat0 = 0;
		$row->lat1 = 0;
		$row->lat2 = 0;
		$row->lon0 = 0;
		$row->lon1 = 0;
		$row->lon2 = 0;
		$row->altitud = 0;
		
		$row->idregimenpropiedad = $inputs["idregimenpropiedad"];
		
		//if (  $inputs["cuenta_catastral"] != '' ) {
		// CLAVE CATASTRAL
			$a = preg_split("/-/", $inputs["cuenta_catastral"]);
			for ($b = strlen($inputs["clave_zona"]); $b<3; $b++) {$inputs["clave_zona"] = '0' . $inputs["clave_zona"];}
			for ($b = strlen($inputs["clave_manzana"]); $b<4; $b++) {$inputs["clave_manzana"] = '0' . $inputs["clave_manzana"];}
			for ($b = strlen($inputs["clave_predio"]); $b<6; $b++) {$inputs["clave_predio"] = '0' . $inputs["clave_predio"];}
			$row->cuenta_catastral = $a[0] . "-" . $a[1] . "-" . $inputs["clave_zona"] . "-" . $inputs["clave_manzana"] . "-" . $inputs["clave_predio"];
		//}
		
		if ( $inputs["cuenta_predial"] == '' )  {
			$row->cuenta_predial = strtoupper($inputs["cuenta_predial"]);
		} else {
			$a = preg_split("/-/", $inputs["cuenta_predial"]);
			for ($b = strlen($inputs["numero_cuenta"]); $b<6; $b++) {$inputs["numero_cuenta"] = '0' . $inputs["numero_cuenta"];}
			$row->cuenta_predial = $a[0] . "-" . $inputs["serie"] . "-" . $inputs["numero_cuenta"];
		}
		
		$row->fk_titulo_solicitante = $inputs["fk_titulo_solicitante"];
		$row->nombre_solicitante = $inputs["nombre_solicitante"];
		$row->fk_titulo_propietario = $inputs["fk_titulo_propietario"];
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
		$row->save();
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
		Avaluos::setAvaluo($row, $inputs);
		$row->updated_at = $inputs["updated_at"];
		$row->save();
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public static function clonarAvaluo($idavaluo, $folio) {
		$rowAvaluo = Avaluos::find($idavaluo);
		$newAvaluo = new Avaluos();
		$newAvaluo->foliocoretemp = $folio;
		Avaluos::clonarAvaluoUpd($rowAvaluo, $newAvaluo);
		$newAvaluo->save();
		$newAvaluo->idavaluo;
		AvaluosZona::clonarAvaluosZona($idavaluo, $newAvaluo->idavaluo);
		AvaluosInmueble::clonarAvaluosInmueble($idavaluo, $newAvaluo->idavaluo);
		AvaluosMercado::clonarAvaluosMercado($idavaluo, $newAvaluo->idavaluo);
		AvaluosFisico::clonarAvaluosFisico($idavaluo, $newAvaluo->idavaluo);
		AvaluosConclusiones::clonarAvaluosConclusiones($idavaluo, $newAvaluo->idavaluo);
		//AvaluosFotos::clonarAvaluosFotos($idavaluo, $newAvaluo->idavaluo);
		return $newAvaluo->idavaluo;
	}

	private static function clonarAvaluoUpd($rowAvaluo, &$newAvaluo) {
		$newAvaluo->iduser = $rowAvaluo->iduser;
		$newAvaluo->proposito = $rowAvaluo->proposito;
		$newAvaluo->finalidad = $rowAvaluo->finalidad;
		$newAvaluo->idmunicipio = $rowAvaluo->idmunicipio;
		$newAvaluo->idestado = $rowAvaluo->idestado;
		$newAvaluo->fecha_reporte = $rowAvaluo->fecha_reporte;
		$newAvaluo->fecha_avaluo = $rowAvaluo->fecha_avaluo;
		$newAvaluo->serie = $rowAvaluo->serie;
		$newAvaluo->folio = $rowAvaluo->folio;
		$newAvaluo->idtipoinmueble = $rowAvaluo->idtipoinmueble;
		$newAvaluo->ubicacion = $rowAvaluo->ubicacion;
		$newAvaluo->conjunto = $rowAvaluo->conjunto;
		$newAvaluo->colonia = $rowAvaluo->colonia;
		$newAvaluo->cp = $rowAvaluo->cp;
		$newAvaluo->latitud = $rowAvaluo->latitud;
		$newAvaluo->lat0 = $rowAvaluo->lat0;
		$newAvaluo->lat1 = $rowAvaluo->lat1;
		$newAvaluo->lat2 = $rowAvaluo->lat2;
		$newAvaluo->longitud = $rowAvaluo->longitud;
		$newAvaluo->lon0 = $rowAvaluo->lon0;
		$newAvaluo->lon1 = $rowAvaluo->lon1;
		$newAvaluo->lon2 = $rowAvaluo->lon2;
		$newAvaluo->altitud = $rowAvaluo->altitud;
		$newAvaluo->idregimenpropiedad = $rowAvaluo->idregimenpropiedad;
		$newAvaluo->cuenta_predial = $rowAvaluo->cuenta_predial;
		$newAvaluo->cuenta_catastral = $rowAvaluo->cuenta_catastral;
		$newAvaluo->nombre_solicitante = $rowAvaluo->nombre_solicitante;
		$newAvaluo->nombre_propietario = $rowAvaluo->nombre_propietario;
		$newAvaluo->fk_titulo_solicitante = $rowAvaluo->fk_titulo_solicitante;
		$newAvaluo->fk_titulo_propietario = $rowAvaluo->fk_titulo_propietario;
		$newAvaluo->fk_finalidad = $rowAvaluo->fk_finalidad;
		$newAvaluo->tp_coordenada = $rowAvaluo->tp_coordenada;
		$newAvaluo->sistema_coordenadas = $rowAvaluo->sistema_coordenadas;
		$newAvaluo->datum = $rowAvaluo->datum;
		$newAvaluo->estatus = 'false';
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