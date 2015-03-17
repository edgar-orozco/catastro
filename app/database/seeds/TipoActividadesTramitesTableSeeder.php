<?php


class TipoActividadesTramitesTableSeeder extends Seeder {

	public function run()
	{
        TipoActividadTramite::create([
            'nombre' => 'Devolver con observaciones',
            'orden' => '1'
        ]);
        TipoActividadTramite::create([
            'nombre' => 'Solicitar inspección',
            'orden' => '2'
        ]);
        TipoActividadTramite::create([
            'nombre' => 'Solicitar actualización',
            'orden' => '3'
        ]);
        TipoActividadTramite::create([
            'nombre' => 'Solicitar aplicación de multa',
            'orden' => '4'
        ]);
        TipoActividadTramite::create([
            'nombre' => 'Solicitar modificación al padrón',
            'orden' => '5'
        ]);

        TipoActividadTramite::create([
            'nombre' => 'Finalizar trámite',
            'orden' => '6'
        ]);

	}

}