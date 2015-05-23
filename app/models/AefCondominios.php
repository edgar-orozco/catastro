<?php

class AefCondominios extends \Eloquent {

	protected $connection = 'corevat';
	protected $fillable = [];
	protected $table = 'aef_condominios';
	protected $primaryKey = 'idaefcondominio';
	public $timestamps = false;

	/*
	 * 
	 */
	public static function AefCondominiosByFk($idavaluoenfoquefisico) {
		return AefCondominios::select('*')
						->where('idavaluoenfoquefisico', '=', $idavaluoenfoquefisico)
						->orderBy('idaefcondominio')
						->get();
	}

}
