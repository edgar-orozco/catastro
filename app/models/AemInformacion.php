<?php

class AemInformacion extends \Eloquent {

	protected $connection = 'corevat';
	protected $fillable = [];
	protected $table = 'aem_informacion';
	protected $primaryKey = 'idaeminformacion';
	public $timestamps = false;

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function AemAnalisis() {
		return $this->hasOne('AemAnalisis', 'idaeminformacion', 'idaeminformacion');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public static function getAemInformacionByFk($idavaluoenfoquemercado) {
		return AemInformacion::select('*')
						->where('idavaluoenfoquemercado', '=', $idavaluoenfoquemercado)
						->orderBy('idaeminformacion')
						->get();
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public static function getAemAnalisisByFk($idavaluoenfoquemercado) {
		return AemAnalisis::select('aem_analisis.*')
						->join('aem_informacion', 'aem_analisis.idaeminformacion', '=', 'aem_informacion.idaeminformacion')
						->where('aem_informacion.idavaluoenfoquemercado', '=', $idavaluoenfoquemercado)
						->orderBy('aem_analisis.idaemanalisis')
						->get();
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public static function insAemInformacion($inputs) {
		$rowAemInformacion = new AemInformacion();
		$rowAemInformacion->idavaluoenfoquemercado = $inputs['idavaluoenfoquemercado3'];
		$rowAemInformacion->ubicacion = $inputs['ubicacion_aeminformacion'];
		$rowAemInformacion->edad = $inputs['edad'];
		$rowAemInformacion->telefono = $inputs['telefono'];
		$rowAemInformacion->observaciones = $inputs['observaciones_aeminformacion'];
		$rowAemInformacion->created_at = $inputs["created_at"];
		$rowAemInformacion->save();
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $inputs
	 * @return Response
	 */
	public static function updInformacion($inputs) {
		$rowAemInformacion = AemInformacion::find($inputs['idaeminformacion']);
		$rowAemInformacion->ubicacion = $inputs['ubicacion_aeminformacion'];
		$rowAemInformacion->edad = $inputs['edad'];
		$rowAemInformacion->telefono = $inputs['telefono'];
		$rowAemInformacion->observaciones = $inputs['observaciones_aeminformacion'];
		$rowAemInformacion->updated_at = $inputs["updated_at"];
		$rowAemInformacion->save();
	}
	
	public static function getAjaxAemInformacionByFk($fk) {
		$pato = array();
		$rows = AemInformacion::select(
		'aem_informacion.idaeminformacion', 
		'aem_informacion.ubicacion',
		'aem_informacion.edad',
		'aem_informacion.telefono',
		'aem_informacion.observaciones')
						->where('aem_informacion.idavaluoenfoquemercado', '=', $fk)
						->orderBy('aem_informacion.idaeminformacion')
						->get();
		$count = count($rows);
		$i = 0;
		 foreach ($rows as $row) {
			 $pato[] = array(
				++$i,
				$row['idaeminformacion'], 
				$row['ubicacion'], 
				$row['edad'], 
				$row['telefono'], 
				$row['observaciones'],
				'<a class="btn btn-xs btn-info btnEdit"  title="Editar" onclick="$.editAemInformacion('.$row['idaeminformacion'].');"><i class="glyphicon glyphicon-pencil"></i></a>', 
				'<a class="btn btn-xs btn-danger btnDel" title="Eliminar" onclick="$.delAemInformacion('.$row['idaeminformacion'].');"><i class="glyphicon glyphicon-remove"></i></a>');
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
