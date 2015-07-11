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
	public static function insAemInformacion($inputs, &$idaeminformacion) {
		$rowAemInformacion = new AemInformacion();
		$rowAemInformacion->idavaluoenfoquemercado = $inputs['idAem'];
		$rowAemInformacion->ubicacion = $inputs['ubicacion'];
		$rowAemInformacion->edad = $inputs['edad']=='' ? $inputs['edad'] : 0.00;
		$rowAemInformacion->telefono = $inputs['telefono'];
		$rowAemInformacion->observaciones = $inputs['observaciones'];
		$rowAemInformacion->idemp = 1;
		$rowAemInformacion->ip = $_SERVER['REMOTE_ADDR'];
		$rowAemInformacion->host = isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : '';
		$rowAemInformacion->creado_por = 1;
		$rowAemInformacion->creado_el = date('Y-m-d H:i:s');
		$rowAemInformacion->save();
		
		$rowAemAnalisis = new AemAnalisis();
		$rowAemAnalisis->idavaluoenfoquemercado = $rowAemInformacion->idavaluoenfoquemercado;
		$rowAemAnalisis->idaeminformacion = $rowAemInformacion->idaeminformacion;
		$idaeminformacion = $rowAemInformacion->idaeminformacion;
		$rowAemAnalisis->save();
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public static function updInformacion($inputs) {
		$rowAemInformacion = AemInformacion::find($inputs['idTable']);
		$rowAemInformacion->ubicacion = $inputs['ubicacion'];
		// $rowAemInformacion->edad = $inputs['edad']=='' ? $inputs['edad'] : 0.00;
		$rowAemInformacion->edad = $inputs['edad'];
		$rowAemInformacion->telefono = $inputs['telefono'];
		$rowAemInformacion->observaciones = $inputs['observaciones'];
		$rowAemInformacion->idemp = 1;
		$rowAemInformacion->ip = $_SERVER['REMOTE_ADDR'];
		$rowAemInformacion->host = isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : '';
		$rowAemInformacion->modi_por = 1;
		$rowAemInformacion->modi_el = date('Y-m-d H:i:s');
		$rowAemInformacion->save();
	}
}
