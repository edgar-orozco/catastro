<?php

class EstatusTramitesTableSeeder extends Seeder {

	public function run()
	{

        DB::statement("ALTER SEQUENCE estatus_tramites_id_seq RESTART WITH 1");
        DB::statement("TRUNCATE TABLE estatus_tramites CASCADE");

        EstatusTramite::create([
            'nombre' => 'Iniciar',
            'descripcion' => 'Es cuando comienza el trámite',
            'presente' => 'Iniciando',
            'pasado' => 'Iniciado',
            'orden' => 0
        ]);
        EstatusTramite::create([
            'nombre' => 'Procesar',
            'descripcion' => 'Es cuando se está trabajando en el trámite',
            'presente' => 'En proceso',
            'pasado' => 'En proceso',
            'orden' => 1
        ]);
        EstatusTramite::create([
            'nombre' => 'Finalizar',
            'descripcion' => 'Es cuando el proceso se está concluyendo',
            'presente' => 'Finalizando',
            'pasado' => 'Finalizado',
            'orden' => 2
        ]);
        EstatusTramite::create([
            'nombre' => 'Finalizar con observaciones',
            'descripcion' => 'Es cuando el proceso se está concluyendo con observaciones',
            'presente' => 'Finalizando con observaciones',
            'pasado' => 'Finalizado observado',
            'orden' => 3
        ]);
	}

}