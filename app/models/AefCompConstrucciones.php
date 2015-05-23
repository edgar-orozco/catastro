<?php

class AefCompConstrucciones extends \Eloquent {

	protected $connection = 'corevat';
	protected $fillable = [];
	protected $table = 'aef_comp_construcciones';
	protected $primaryKey = 'idaefcompconstruccion';
	public $timestamps = false;

	/*
	 * 
	 */
	public static function AefCompConstruccionesByFk($idavaluoenfoquefisico) {
		return AefCompConstrucciones::select('*')
						->where('idavaluoenfoquefisico', '=', $idavaluoenfoquefisico)
						->orderBy('idaefcompconstruccion')
						->get();
	}

}
