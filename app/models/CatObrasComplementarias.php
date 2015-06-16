<?php

class CatObrasComplementarias extends \Eloquent {

	protected $connection = 'corevat';
	protected $fillable = [];
	protected $table = 'cat_obras_complementarias';
	protected $primaryKey = 'idobracomplementaria';
	public $timestamps = false;

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public static function comboList() {
		return CatObrasComplementarias::orderBy('obra_complementaria')->where('status_obra_complementaria', 1)->lists('obra_complementaria', 'idobracomplementaria');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public static function getIdByDescripcion($value) {
		$row = CatObrasComplementarias::select('idobracomplementaria')
				->where('obra_complementaria', '=', $value)
				->where('status_obra_complementaria', '=', 1)
				->first();
		return $row->idobracomplementaria;
	}
}
