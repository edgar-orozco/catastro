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

	public static function clonarAvaluosFotos($idavaluoold, $idavaluonew) {
		$rowFotosOld = Avaluos::find($idavaluoold)->AvaluosFotos;
		$rowFotosNew = Avaluos::find($idavaluonew)->AvaluosFotos;
		$rowFotosNew->foto0 = $rowFotosOld->foto0;
		$rowFotosNew->foto1 = $rowFotosOld->foto1;
		$rowFotosNew->foto2 = $rowFotosOld->foto2;
		$rowFotosNew->foto3 = $rowFotosOld->foto3;
		$rowFotosNew->foto4 = $rowFotosOld->foto4;
		$rowFotosNew->foto5 = $rowFotosOld->foto5;
		$rowFotosNew->foto6 = $rowFotosOld->foto6;
		$rowFotosNew->foto7 = $rowFotosOld->foto7;
		$rowFotosNew->foto8 = $rowFotosOld->foto8;
		$rowFotosNew->foto9 = $rowFotosOld->foto9;
		
		$rowFotosNew->plano0 = $rowFotosOld->plano0;
		$rowFotosNew->plano1 = $rowFotosOld->plano1;
		$rowFotosNew->plano2 = $rowFotosOld->plano2;
		$rowFotosNew->plano3 = $rowFotosOld->plano3;
		$rowFotosNew->plano4 = $rowFotosOld->plano4;
		
		$rowFotosNew->ftitulo0 = $rowFotosOld->ftitulo0;
		$rowFotosNew->ftitulo1 = $rowFotosOld->ftitulo1;
		$rowFotosNew->ftitulo2 = $rowFotosOld->ftitulo2;
		$rowFotosNew->ftitulo3 = $rowFotosOld->ftitulo3;
		$rowFotosNew->ftitulo4 = $rowFotosOld->ftitulo4;
		$rowFotosNew->ftitulo5 = $rowFotosOld->ftitulo5;
		$rowFotosNew->ftitulo6 = $rowFotosOld->ftitulo6;
		$rowFotosNew->ftitulo7 = $rowFotosOld->ftitulo7;
		$rowFotosNew->ftitulo8 = $rowFotosOld->ftitulo8;
		$rowFotosNew->ftitulo9 = $rowFotosOld->ftitulo9;
		
		$rowFotosNew->ptitulo0 = $rowFotosOld->ptitulo0;
		$rowFotosNew->ptitulo1 = $rowFotosOld->ptitulo1;
		$rowFotosNew->ptitulo2 = $rowFotosOld->ptitulo2;
		$rowFotosNew->ptitulo3 = $rowFotosOld->ptitulo3;
		$rowFotosNew->ptitulo4 = $rowFotosOld->ptitulo4;
		
		$rowFotosNew->status_foto_plano = $rowFotosOld->status_foto_plano;
		$rowFotosNew->idemp = $rowFotosOld->idemp;
		$rowFotosNew->ip = $rowFotosOld->ip;
		$rowFotosNew->host = $rowFotosOld->host;
		$rowFotosNew->creado_por = $rowFotosOld->creado_por;
		$rowFotosNew->creado_el = $rowFotosOld->creado_el;
		$rowFotosNew->modi_por = $rowFotosOld->modi_por;
		$rowFotosNew->modi_el = $rowFotosOld->modi_el;
		$rowFotosNew->save();
	}
}
