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
	
	public static function getAemCompTerreno($id) {
		return AemCompTerrenos::select('*')->where('idaemcompterreno', '=', $id)->get();
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
		$rowAemCompTerrenos->created_at = $inputs["created_at"];
		$rowAemCompTerrenos->save();
		
	}
	
	public static function updAemCompTerrenos($inputs) {
		$rowAemCompTerrenos = AemCompTerrenos::find($inputs['idaemcompterreno']);
		$rowAemCompTerrenos->ubicacion = $inputs['ubicacion_aemcompterreno'];
		$rowAemCompTerrenos->precio = $inputs['precio'];
		$rowAemCompTerrenos->superficie_terreno = $inputs['superficie_terreno_aemcompterreno'];
		$rowAemCompTerrenos->observaciones = $inputs['observaciones_aemcompterreno'];
		$rowAemCompTerrenos->precio_unitario_m2_terreno = ( $rowAemCompTerrenos->superficie_terreno <= 0 ? 0.00 : ( round($rowAemCompTerrenos->precio / $rowAemCompTerrenos->superficie_terreno, 2) ) );
		$rowAemCompTerrenos->updated_at = $inputs["updated_at"];;

		$rowAemCompTerrenos->save();
		
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
				'<a class="btn btn-xs btn-info btnEdit"  title="Editar" onclick="$.editAemCompTerrenos('.$row['idaemcompterreno'].');"><i class="glyphicon glyphicon-pencil"></i></a>&nbsp;'. 
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

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public static function clonarAemCompTerrenos($idavaluoenfoquemercadoold, $idavaluoenfoquemercadonew) {
		$rowsAemCompTerrenosOld = AemCompTerrenos::select('*')->where('idavaluoenfoquemercado', '=', $idavaluoenfoquemercadoold)->get();
		foreach ($rowsAemCompTerrenosOld as $rowAemCompTerrenosOld) {
			AemCompTerrenos::clonarAemCompTerrenosIns($idavaluoenfoquemercadonew, $rowAemCompTerrenosOld);
		}
		
	}
	
	private static function clonarAemCompTerrenosIns($idavaluoenfoquemercadonew, $rowAemCompTerrenosOld) {
		$rowAemCompTerrenosNew = new AemCompTerrenos();
		$rowAemCompTerrenosNew->idavaluoenfoquemercado          = $idavaluoenfoquemercadonew;
		$rowAemCompTerrenosNew->ubicacion                       = $rowAemCompTerrenosOld->ubicacion;
		$rowAemCompTerrenosNew->precio                          = $rowAemCompTerrenosOld->precio;
		$rowAemCompTerrenosNew->superficie_terreno              = $rowAemCompTerrenosOld->superficie_terreno;
		$rowAemCompTerrenosNew->observaciones                   = $rowAemCompTerrenosOld->observaciones;
		$rowAemCompTerrenosNew->superficie_construida           = $rowAemCompTerrenosOld->superficie_construida;
		$rowAemCompTerrenosNew->precio_unitario_m2_terreno      = $rowAemCompTerrenosOld->precio_unitario_m2_terreno;
		$rowAemCompTerrenosNew->precio_unitario_m2_construccion = $rowAemCompTerrenosOld->precio_unitario_m2_construccion;
		$rowAemCompTerrenosNew->save();
		AemCompTerrenos::clonarAemHomologacionUpd($rowAemCompTerrenosOld->idaemcompterreno, $rowAemCompTerrenosNew->idaemcompterreno);
	}
	
	private static function clonarAemHomologacionUpd($idaemcompterrenoold, $idaemcompterrenonew) {
		$rowAemHomologacionOld = AemCompTerrenos::find($idaemcompterrenoold)->AemHomologacion;
		$rowAemHomologacionNew = AemCompTerrenos::find($idaemcompterrenonew)->AemHomologacion;
		$rowAemHomologacionNew->comparable = $rowAemHomologacionOld->comparable;
		$rowAemHomologacionNew->superficie_terreno = $rowAemHomologacionOld->superficie_terreno;
		$rowAemHomologacionNew->superficie_construccion = $rowAemHomologacionOld->superficie_construccion;
		$rowAemHomologacionNew->valor_unitario = $rowAemHomologacionOld->valor_unitario;
		$rowAemHomologacionNew->zona = $rowAemHomologacionOld->zona;
		$rowAemHomologacionNew->ubicacion = $rowAemHomologacionOld->ubicacion;
		$rowAemHomologacionNew->frente = $rowAemHomologacionOld->frente;
		$rowAemHomologacionNew->forma = $rowAemHomologacionOld->forma;
		$rowAemHomologacionNew->superficie = $rowAemHomologacionOld->superficie;
		$rowAemHomologacionNew->valor_unitario_negociable = $rowAemHomologacionOld->valor_unitario_negociable;
		$rowAemHomologacionNew->valor_unitario_resultante_m2 = $rowAemHomologacionOld->valor_unitario_resultante_m2;
		$rowAemHomologacionNew->in_promedio = $rowAemHomologacionOld->in_promedio;
		$rowAemHomologacionNew->fk_zona = $rowAemHomologacionOld->fk_zona;
		$rowAemHomologacionNew->fk_ubicacion = $rowAemHomologacionOld->fk_ubicacion;
		$rowAemHomologacionNew->fk_frente = $rowAemHomologacionOld->fk_frente;
		$rowAemHomologacionNew->fk_forma = $rowAemHomologacionOld->fk_forma;
		$rowAemHomologacionNew->save();
	}
}
