<?php

class AefTerrenos extends \Eloquent {

	protected $connection = 'corevat';
	protected $fillable = [];
	protected $table = 'aef_terrenos';
	protected $primaryKey = 'idaefterreno';
	public $timestamps = false;

	/*
	 * 
	 */
	public static function AefTerrenosByFk($idavaluoenfoquefisico) {
		return AefTerrenos::select('*')
						->where('idavaluoenfoquefisico', '=', $idavaluoenfoquefisico)
						->orderBy('idaefterreno')
						->get();
	}

}
