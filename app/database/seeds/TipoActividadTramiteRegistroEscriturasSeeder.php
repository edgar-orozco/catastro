<?php

/**
 * Pobla la base de datos de usuarios para pruebas.
 * Class UsersSeeder
 */
class TipoActividadTramiteRegistroEscriturasSeeder extends Seeder {
    public function run()
    {
        $datos = [];

        //Cedula de campo
        $datos[] = [
            'nombre' => 'Generar Formato de Inspección',
            'orden' => 10,
            'presente' => 'Generando Formato',
            'pasado' => 'Formato de Inspeccion Generado',
            'manual' => true,
            'callback' => 'tramites/cedulaCampo',
            'getter' => '',
            'estatus_id' => 2
        ];

        //UploadShape
        $datos[] = [
            'nombre' => 'Subir Shapes',
            'orden' => 2,
            'presente' => 'Subiendo Shapes',
            'pasado' => 'Shapes Subidos',
            'manual' => true,
            'callback' => 'admin/CargaShapesControllerMpio',
            'getter' => '',
            'estatus_id' => 2
        ];

        //Manifestacion
        $datos[] = [
            'nombre' => 'Alta Manifestación',
            'orden' => 2,
            'presente' => 'Creando Manifestación',
            'pasado' => 'Manifestación Creada',
            'manual' => true,
            'callback' => 'ofvirtual/notario/manifestacion/tramite',
            'getter' => '',
            'estatus_id' => 2
        ];

        foreach($datos as $d) {
            $valuacion = new TipoActividadTramite($d);
            $valuacion->save();
        }
    }
}
