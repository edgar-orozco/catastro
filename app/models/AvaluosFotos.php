<?php

class AvaluosFotos extends \Eloquent {

	protected $connection = 'corevat';
	protected $fillable = [];
	protected $table = 'avaluo_fotos_planos';
	protected $primaryKey = 'idavaluofotosplano';
	public $timestamps = false;

	public static function insAvaluoFotos($idavaluo) {
		$row = new AvaluosFotos();
		$row->idavaluo = $idavaluo;
		$row->foto0 = $row->foto1 = $row->foto2 = $row->foto3 = $row->foto4 = $row->foto5 = $row->foto6 = $row->foto7 = $row->foto8 = $row->foto9 = '';
		$row->plano0 = $row->plano1 = $row->plano2 = $row->plano3 = $row->plano4 = '';
		$row->ftitulo0 = $row->ftitulo1 = $row->ftitulo2 = $row->ftitulo3 = $row->ftitulo4 = $row->ftitulo5 = $row->ftitulo6 = $row->ftitulo7 = $row->ftitulo8 = $row->ftitulo9 = '';
		$row->ptitulo0 = $row->ptitulo1 = $row->ptitulo2 = $row->ptitulo3 = $row->ptitulo4 = '';
		$row->idemp = 1;
		$row->ip = $_SERVER['REMOTE_ADDR'];
		$row->host = isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : '';
		$row->creado_por = Auth::id();
		$row->creado_el = date('Y-m-d H:i:s');
		$row->save();
	}

}
