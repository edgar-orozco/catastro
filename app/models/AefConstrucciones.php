<?php

class AefConstrucciones extends \Eloquent {

	protected $connection = 'corevat';
	protected $fillable = [];
	protected $table = 'aef_construcciones';
	protected $primaryKey = 'idaefconstruccion';
	public $timestamps = false;

	/*
	 * 
	 */
	public static function AefConstruccionesByFk($idavaluoenfoquefisico) {
		return AefConstrucciones::select('*')
						->leftjoin('cat_tipo', 'aef_construcciones.idtipo', '=', 'cat_tipo.idtipo')
						->where('idavaluoenfoquefisico', '=', $idavaluoenfoquefisico)
						->orderBy('idaefconstruccion')
						->get();
	}

}
