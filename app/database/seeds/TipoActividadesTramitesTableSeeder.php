<?php


class TipoActividadesTramitesTableSeeder extends Seeder {

	public function run()
	{

        DB::statement("ALTER SEQUENCE tipoactividades_tramites_id_seq RESTART WITH 1");
        DB::statement("TRUNCATE TABLE tipoactividades_tramites CASCADE");

        //Estatus iniciado
        $ei = EstatusTramite::where('pasado','Iniciado')->first();
        //Estatus en proceso
        $ep = EstatusTramite::where('presente','En proceso')->first();
        //Estatus finalizado
        $ef = EstatusTramite::where('pasado','Finalizado')->first();
        //Estatus finalizado con observaciones
        $efo = EstatusTramite::where('pasado','Finalizado con observaciones')->first();

        TipoActividadTramite::create([
            'nombre' => 'Iniciar trámite',
            'presente' => 'Se inicia el trámite',
            'pasado' => 'Trámite iniciado',
            'orden' => 0,
            'estatus_id' => $ei->id,
            'manual' => false
        ]);


        TipoActividadTramite::create([
            'nombre' => 'Devolver con observaciones',
            'presente' => 'Se devuelve con observaciones',
            'pasado' => 'Devuelto con observaciones',
            'orden' => '1',
            'estatus_id'=> $ep->id,
            'manual' => true
            //'callback' => 'Tramite@devolver'
        ]);

        TipoActividadTramite::create([
            'nombre' => 'Solicitar inspección',
            'presente' => 'Se solicita insepcción',
            'pasado' => 'Inspección solicitada',
            'estatus_id'=> $ep->id,
            'orden' => '2',
            'manual' => true
        ]);

        TipoActividadTramite::create([
            'nombre' => 'Solicitar actualización',
            'presente' => 'Se solicita actualización',
            'pasado' => 'Actualización solicitada',
            'estatus_id'=> $ep->id,
            'orden' => '3',
            'manual' => true
        ]);

        TipoActividadTramite::create([
            'nombre' => 'Solicitar aplicación de multa',
            'presente' => 'Se solicita aplicación de multa',
            'pasado' => 'Aplicación de multa solicitada',
            'estatus_id'=> $ep->id,
            'orden' => '4',
            'manual' => true
        ]);

        TipoActividadTramite::create([
            'nombre' => 'Solicitar modificación al padrón',
            'presente' => 'Se solicita modificación al padrón',
            'pasado' => 'Modificación al padrón solicitada',
            'orden' => '5',
            'estatus_id'=> $ep->id,
            'manual' => true
        ]);

        TipoActividadTramite::create([
            'nombre' => 'Finalizar trámite',
            'presente' => 'Se finaliza el trámite',
            'pasado' => 'Trámite finalizado',
            'orden' => '6',
            'estatus_id'=> $ef->id,
            'manual' => true
        ]);

        TipoActividadTramite::create([
            'nombre' => 'Finalizar con observaciones',
            'presente' => 'Se finaliza con observaciones',
            'pasado' => 'Trámite finalizado con observaciones',
            'orden' => '7',
            'estatus_id'=> $efo->id,
            'manual' => true
        ]);

	}

}