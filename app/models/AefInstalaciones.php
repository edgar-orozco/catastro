<?php

class AefInstalaciones extends \Eloquent {

	protected $connection = 'corevat';
	protected $fillable = [];
	protected $table = 'aef_instalaciones';
	protected $primaryKey = 'idaefinstalacion';
	public $timestamps = false;

	/*
	 * 
	 */
	public static function AefInstalacionesByFk($idavaluoenfoquefisico) {
		return AefInstalaciones::select('*')
						->where('idavaluoenfoquefisico', '=', $idavaluoenfoquefisico)
						->orderBy('idaefinstalacion')
						->get();
	}

}
