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

}
