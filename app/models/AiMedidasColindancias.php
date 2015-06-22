<?php

class AiMedidasColindancias extends \Eloquent {

	protected $connection = 'corevat';
	protected $fillable = [];
	protected $table = 'ai_medidas_colindancias';
	protected $primaryKey = 'idaimedidacolindancia';
	public $timestamps = false;

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $idavaluo
	 * @return Response
	 */
	public static function AiMedidasColindanciasByFk($fk) {
		return AiMedidasColindancias::select('ai_medidas_colindancias.*', 'cat_orientaciones.orientacion')
						->leftJoin('cat_orientaciones', 'ai_medidas_colindancias.idorientacion', '=', 'cat_orientaciones.idorientacion')
						->where('ai_medidas_colindancias.idavaluoinmueble', '=', $fk)
						->orderBy('ai_medidas_colindancias.idaimedidacolindancia')
						->get();
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $idavaluo
	 * @return Response
	 */
	public static function insAiMedidasColindancias($inputs) {
		$row = new AiMedidasColindancias();
		$row->idavaluoinmueble = $inputs['idavaluoinmueble2'];
		$row->idorientacion = $inputs['idorientacion'];
		$row->medida = $inputs['medida'];
		$row->colindancia = $inputs['colindancia'];
		$row->idemp = 1;
		$row->ip = $_SERVER['REMOTE_ADDR'];
		$row->host = isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : '';
		$row->creado_por = 1;
		$row->creado_el = date('Y-m-d H:i:s');
		$row->save();
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $idavaluo
	 * @return Response
	 */
	public static function updAiMedidasColindancias($inputs) {
		$row = AiMedidasColindancias::find($inputs['idaimedidacolindancia']);
		$row->idorientacion = $inputs['idorientacion'];
		$row->medida = $inputs['medida'];
		$row->colindancia = $inputs['colindancia'];
		$row->ip = $_SERVER['REMOTE_ADDR'];
		$row->host = isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : '';
		$row->modi_por = 1;
		$row->modi_el = date('Y-m-d H:i:s');
		$row->save();
	}

}
