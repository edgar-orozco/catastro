<?php

class AemHomologacion extends \Eloquent {

	protected $connection = 'corevat';
	protected $fillable = [];
	protected $table = 'aem_homologacion';
	protected $primaryKey = 'idaemhomologacion';
	public $timestamps = false;

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public static function updAemHomologacion($inputs) {
		$row = AemHomologacion::find($inputs["idaemhomologacion"]);
		
		$row->zona = $inputs["zona_aemhomologacion"];
		$row->ubicacion = $inputs["ubicacion_aemhomologacion"];
		$row->frente = $inputs["frente"];
		$row->forma = $inputs["forma"];
		$row->valor_unitario_negociable = $inputs["valor_unitario_negociable"];
		$row->in_promedio = isset($inputs["in_promedio_aemhomologacion"]) ? 1 : 0;
		$row->fk_zona = $inputs["idfactorzona_aemhomologacion"];
		$row->fk_ubicacion = $inputs["idfactorubicacion_aemhomologacion"];
		$row->fk_frente = $inputs["idfactorfrente"];
		$row->fk_forma = $inputs["idfactorforma"];

		$row->updated_at = $inputs["updated_at"];
		$row->save();
	}

	public static function getAjaxAemHomologacionByFk($fk) {
		$pato = array();
		$rows = AemHomologacion::select('aem_homologacion.idaemhomologacion', 'aem_homologacion.comparable', 'aem_homologacion.superficie_terreno', 'aem_homologacion.valor_unitario', 'aem_homologacion.zona', 'aem_homologacion.ubicacion', 'aem_homologacion.frente', 'aem_homologacion.forma', 'aem_homologacion.superficie', 'aem_homologacion.valor_unitario_negociable', 'aem_homologacion.valor_unitario_resultante_m2')
				->where('aem_homologacion.idavaluoenfoquemercado', '=', $fk)
				->orderBy('aem_homologacion.idaemcompterreno')
				->get();
		$count = count($rows);
		$i = 0;
		foreach ($rows as $row) {
			$pato[] = array(
				++$i,
				$row['idaemhomologacion'],
				$row['comparable'],
				$row['superficie_terreno'],
				$row['valor_unitario'],
				$row['zona'],
				$row['ubicacion'],
				$row['frente'],
				$row['forma'],
				$row['superficie'],
				$row['valor_unitario_negociable'],
				$row['valor_unitario_resultante_m2'],
				'<a class="btn btn-xs btn-info btnEdit"  title="Editar" onclick="$.editAemHomologacion(' . $row['idaemhomologacion'] . ');"><i class="glyphicon glyphicon-pencil"></i></a>');
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
