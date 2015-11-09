<?php

class AvaluosConclusiones extends \Eloquent {

	protected $connection = 'corevat';
	protected $fillable = [];
	protected $table = 'avaluo_conclusiones';
	protected $primaryKey = 'idavaluoconclusion';
	public $timestamps = false;

	public static function insAvaluoConclusiones($idavaluo) {
		$row = new AvaluosConclusiones();
		$row->idavaluo = $idavaluo;
		$row->valor_fisico = $row->valor_mercado = $row->valor_concluido = 0.00;
		$row->leyenda = $row->sello = $row->firma = '';
		$row->factor_seleccion_valor = 0;
		$row->idemp = 1;
		$row->ip = $_SERVER['REMOTE_ADDR'];
		$row->host = isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : '';
		$row->creado_por = Auth::id();
		$row->creado_el = date('Y-m-d H:i:s');
		$row->save();
	}

	public static function avaluoConclusionesBeforeUpdate(&$row) {
		if ($row->factor_seleccion_valor == 1) {
			$row->valor_concluido = $row->valor_fisico;
		} else {
			$row->valor_concluido = $row->valor_mercado;
		}
	}

	public static function clonarAvaluosConclusiones($idavaluoold, $idavaluonew) {
		$rowConclusionesOld = Avaluos::find($idavaluoold)->AvaluosConclusiones;
		$rowConclusionesNew = Avaluos::find($idavaluonew)->AvaluosConclusiones;
		$rowConclusionesNew->valor_fisico = $rowConclusionesOld->valor_fisico;
		$rowConclusionesNew->valor_mercado = $rowConclusionesOld->valor_mercado;
		$rowConclusionesNew->factor_seleccion_valor = $rowConclusionesOld->factor_seleccion_valor;
		$rowConclusionesNew->valor_concluido = $rowConclusionesOld->valor_concluido;
		$rowConclusionesNew->leyenda = $rowConclusionesOld->leyenda;
		$rowConclusionesNew->sello = $rowConclusionesOld->sello;
		$rowConclusionesNew->firma = $rowConclusionesOld->firma;
		$rowConclusionesNew->idemp = $rowConclusionesOld->idemp;
		$rowConclusionesNew->ip = $rowConclusionesOld->ip;
		$rowConclusionesNew->host = $rowConclusionesOld->host;
		$rowConclusionesNew->creado_por = $rowConclusionesOld->creado_por;
		$rowConclusionesNew->creado_el = $rowConclusionesOld->creado_el;
		$rowConclusionesNew->modi_por = $rowConclusionesOld->modi_por;
		$rowConclusionesNew->modi_el = $rowConclusionesOld->modi_el;
		$rowConclusionesNew->save();
	}
}
