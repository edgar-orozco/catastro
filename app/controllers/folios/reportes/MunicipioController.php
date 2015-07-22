<?php
/**
* 
*/
class folios_reportes_MunicipioController extends BaseController
{
	
	public function index()
	{
		$municipios = DB::table('municipios')
            ->join('folios_comprados', 'municipios.gid', '=', 'folios_comprados.municipio_id')
            ->join('folios_historial', 'folios_comprados.no_oficio_historial', '=', 'folios_historial.no_oficio')
            ->where('entrega_municipal', 1)
            ->selectRaw('municipios.gid as gid_mun, municipios.nombre_municipio AS municipio, SUM(folios_historial.cantidad_rusticos) AS rusticos, SUM(folios_historial.cantidad_urbanos) AS urbanos, SUM(folios_historial.total) AS total')
            ->groupBy('municipios.gid', 'municipios.nombre_municipio' )
            ->get();

		return View::make('folios.reportes.municipio.list', compact('municipios'));
	}

	public function municipio_detalles($id)
	{
		$peritos = DB::table('peritos')
            ->join('folios_comprados', 'peritos.id', '=', 'folios_comprados.perito_id')
            ->join('folios_historial', 'folios_comprados.no_oficio_historial', '=', 'folios_historial.no_oficio')
            ->where('entrega_municipal', 1)
            ->where('folios_comprados.municipio_id', $id)
            ->selectRaw('peritos.nombre as nombreP, peritos.corevat as corevat, SUM(folios_historial.cantidad_rusticos) AS rusticos, SUM(folios_historial.cantidad_urbanos) AS urbanos, SUM(folios_historial.total) AS total')
            ->groupBy('peritos.nombre', 'peritos.corevat' )
            ->get();

            return View::make('folios.reportes.municipio.details', compact('peritos'));
	}
}


?>