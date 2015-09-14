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
		$pato = array();
		$rows = AiMedidasColindancias::select('ai_medidas_colindancias.*', 'cat_orientaciones.orientacion')
						->leftJoin('cat_orientaciones', 'ai_medidas_colindancias.idorientacion', '=', 'cat_orientaciones.idorientacion')
						->where('ai_medidas_colindancias.idavaluoinmueble', '=', $fk)
						->orderBy('ai_medidas_colindancias.idaimedidacolindancia')
						->get();
		$count = count($rows);
		 foreach ($rows as $row) {
			 $pato[] = array(
				$row['idaimedidacolindancia'], 
				$row['orientacion'], 
				$row['unidad_medida'], 
				$row['medidas'], 
				$row['colindancia'], 
				'<a class="btn btn-xs btn-info btnEdit"  title="Editar" onclick="$.editAiMedidasColindancias('.$row['idaimedidacolindancia'].');"><i class="glyphicon glyphicon-pencil"></i></a>&nbsp;'. 
				'<a class="btn btn-xs btn-danger btnDel" title="Eliminar" onclick="$.delAiMedidasColindancias('.$row['idaimedidacolindancia'].');"><i class="glyphicon glyphicon-remove"></i></a>'
			);
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
	 * @param  int  $idavaluo
	 * @return Response
	 */
	public static function getOrientacionFromMedCol($fk) {
		$rows = AiMedidasColindancias::select('cat_orientaciones.orientacion', 'ai_medidas_colindancias.unidad_medida', 
				'ai_medidas_colindancias.medidas', 'ai_medidas_colindancias.colindancia')
						->leftJoin('cat_orientaciones', 'ai_medidas_colindancias.idorientacion', '=', 'cat_orientaciones.idorientacion')
						->where('ai_medidas_colindancias.idavaluoinmueble', '=', $fk)
						->orderBy('ai_medidas_colindancias.idaimedidacolindancia')
						->get();
		return $rows;
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
		$row->medidas = $inputs['medidas'];
		$row->unidad_medida = $inputs['unidad_medida'];
		$row->colindancia = $inputs['colindancia'];
		$row->created_at = $inputs["created_at"];
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
		$row->medidas = $inputs['medidas'];
		$row->unidad_medida = $inputs['unidad_medida'];
		$row->colindancia = $inputs['colindancia'];
		$row->updated_at = $inputs["updated_at"];
		$row->save();
	}

}
