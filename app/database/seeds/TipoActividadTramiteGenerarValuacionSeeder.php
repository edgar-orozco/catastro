<?php

/**
 * Pobla la base de datos de usuarios para pruebas.
 * Class UsersSeeder
 */
class TipoActividadTramiteGenerarValuacionSeeder extends Seeder {
    public function run()
    {
        $datos = [];

        //Valuación
        $datos[] = [
            'nombre' => 'Generar Valuación',
            'orden' => 2,
            'presente' => 'Generando valuación',
            'pasado' => 'Valuación generada',
            'manual' => true,
            'callback' => 'tramites/valor/create',
            'getter' => 'tramites/valor/show-grid',
            'estatus_id' => 2
        ];

        //Fusion de predios
        $datos[] = [
            'nombre' => 'Agregar cuentas relacionadas',
            'orden' => 2,
            'presente' => 'Agregando cuentas relacionadas',
            'pasado' => 'Cuentas relacionadas agregadas',
            'manual' => true,
            'callback' => 'tramites/predio-fusionado',
            'getter' => 'tramites/predio-fusionado/show-grid',
            'estatus_id' => 2
        ];

        foreach($datos as $d) {
            $valuacion = new TipoActividadTramite($d);
            $valuacion->save();
        }
    }
}