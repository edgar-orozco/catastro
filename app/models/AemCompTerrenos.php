<?php

class AemCompTerrenos extends \Eloquent {

	protected $connection = 'corevat';
	protected $fillable = [];
	protected $table = 'aem_comp_terrenos';
	protected $primaryKey = 'idaemcompterreno';
	public $timestamps = false;

	public function AemHomologacion() {
		return $this->hasOne('AemHomologacion', 'idaemcompterreno', 'idaemcompterreno');
	}

	/*
	 * 
	 */
	public static function AemCompTerrenosByFk($idavaluoenfoquemercado) {
		return AemCompTerrenos::select('*')
						->where('idavaluoenfoquemercado', '=', $idavaluoenfoquemercado)
						->orderBy('idaemcompterreno')
						->get();
	}

	/*
	 * LA LLAVE FORANEA ES idavaluoenfoquemercado
	 */
	public static function AemHomologacionByFk($idavaluoenfoquemercado) {
		return AemHomologacion::select('aem_homologacion.*')
						->join('aem_comp_terrenos', 'aem_homologacion.idaemcompterreno', '=', 'aem_comp_terrenos.idaemcompterreno')
						->where('aem_comp_terrenos.idavaluoenfoquemercado', '=', $idavaluoenfoquemercado)
						->orderBy('aem_homologacion.idaemhomologacion')
						->get();
	}

}
