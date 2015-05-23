<?php

class AemInformacion extends \Eloquent {

	protected $connection = 'corevat';
	protected $fillable = [];
	protected $table = 'aem_informacion';
	protected $primaryKey = 'idaeminformacion';
	public $timestamps = false;

	public function AemAnalisis() {
		return $this->hasOne('AemAnalisis', 'idaeminformacion', 'idaeminformacion');
	}

	/*
	 * LA LLAVE FORANEA ES idavaluoenfoquemercado
	 */
	public static function AemInformacionByFk($idavaluoenfoquemercado) {
		return AemInformacion::select('*')
						->where('idavaluoenfoquemercado', '=', $idavaluoenfoquemercado)
						->orderBy('idaeminformacion')
						->get();
	}

	/*
	 * LA LLAVE FORANEA ES idavaluoenfoquemercado
	 */
	public static function AemAnalisisByFk($idavaluoenfoquemercado) {
		return AemAnalisis::select('aem_analisis.*')
						->join('aem_informacion', 'aem_analisis.idaeminformacion', '=', 'aem_informacion.idaeminformacion')
						->where('aem_informacion.idavaluoenfoquemercado', '=', $idavaluoenfoquemercado)
						->orderBy('aem_analisis.idaemanalisis')
						->get();
	}

}
