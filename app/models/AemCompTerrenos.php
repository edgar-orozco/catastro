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
}
