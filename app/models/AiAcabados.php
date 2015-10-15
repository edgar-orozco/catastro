<?php

class AiAcabados extends \Eloquent {
	
	protected $connection = 'corevat';
	protected $fillable = ['fk_cat_acabados', 'fk_cat_pisos', 'fk_cat_aplanados', 'fk_cat_plafones'];
	protected $table = 'ai_acabados';
	protected $primaryKey = 'id';
	public $timestamps = false;

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $idavaluo
	 * @return Response
	 */
	public static function AiAcabadosByFk($fk) {
		$pato = array();
		$rows = AiAcabados::select('ai_acabados.*', 'cat_acabados.nombre', 'cat_aplanados.aplanado', 'cat_pisos.piso', 'cat_plafones.plafon')
						->leftJoin('cat_acabados',  'ai_acabados.fk_cat_acabados',  '=', 'cat_acabados.id')
						->leftJoin('cat_aplanados', 'ai_acabados.fk_cat_aplanados', '=', 'cat_aplanados.idaplanado')
						->leftJoin('cat_pisos',     'ai_acabados.fk_cat_pisos',     '=', 'cat_pisos.idpiso')
						->leftJoin('cat_plafones',  'ai_acabados.fk_cat_plafones',  '=', 'cat_plafones.idplafon')
						->where('ai_acabados.idavaluoinmueble', '=', $fk)
						->orderBy('ai_acabados.id')
						->get();
		$count = count($rows);
		 foreach ($rows as $row) {
			 $pato[] = array(
				$row['id'], 
				$row['nombre'], 
				$row['aplanado'], 
				$row['piso'], 
				$row['plafon'], 
				'<a class="btn btn-xs btn-info btnEdit"  title="Editar" onclick="$.editAiAcabados('.$row['id'].');"><i class="glyphicon glyphicon-pencil"></i></a>&nbsp;'. 
				'<a class="btn btn-xs btn-danger btnDel" title="Eliminar" onclick="$.delAiAcabados('.$row['id'].');"><i class="glyphicon glyphicon-remove"></i></a>'
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
	public static function insAiAcabados($inputs) {
		$row = new AiAcabados();
		$row->idavaluoinmueble = $inputs['idavaluoinmueble3'];
		$row->fk_cat_acabados = $inputs['fk_cat_acabados'];
		$row->fk_cat_aplanados = $inputs['fk_cat_aplanados'];
		$row->fk_cat_pisos = $inputs['fk_cat_pisos'];
		$row->fk_cat_plafones = $inputs['fk_cat_plafones'];
		$row->created_at = $inputs["created_at"];
		$row->save();
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $idavaluo
	 * @return Response
	 */
	public static function updAiAcabados($inputs) {
		$row = AiAcabados::find($inputs['idaiacabado']);
		$row->fk_cat_acabados = $inputs['fk_cat_acabados'];
		$row->fk_cat_aplanados = $inputs['fk_cat_aplanados'];
		$row->fk_cat_pisos = $inputs['fk_cat_pisos'];
		$row->fk_cat_plafones = $inputs['fk_cat_plafones'];
		$row->updated_at = $inputs["updated_at"];
		$row->save();
	}

}