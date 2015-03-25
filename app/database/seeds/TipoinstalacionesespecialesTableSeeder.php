<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class TipoinstalacionesespecialesTableSeeder extends Seeder {

	public function run()
	{
		DB::table('tipoinstalacionesespeciales')->delete();
		
        DB::table('tipoinstalacionesespeciales')->insert(
            array('descripcion' => 'BOMBA HIDRÁULICA', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s") )
        );
        DB::table('tipoinstalacionesespeciales')->insert(
            array('descripcion' => 'POZO DE AGUA', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s") )
        );
        DB::table('tipoinstalacionesespeciales')->insert(
            array('descripcion' => 'ALBERCA', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s") )
        );
        DB::table('tipoinstalacionesespeciales')->insert(
            array('descripcion' => 'ESPECTACULARES', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s") )
        ); 
        DB::table('tipoinstalacionesespeciales')->insert(
            array('descripcion' => 'SISTEMA DE INCENDIO', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s") )
        );

        DB::table('tipoinstalacionesespeciales')->insert(
            array('descripcion' => 'SISTEMA DE ALARMAS', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s") )
        );

        DB::table('tipoinstalacionesespeciales')->insert(
            array('descripcion' => 'CÁMARAS DE VIGILANCIA', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s") )
        );

        DB::table('tipoinstalacionesespeciales')->insert(
            array('descripcion' => 'SISTEMA DE RIEGO', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s") )
        );

        DB::table('tipoinstalacionesespeciales')->insert(
            array('descripcion' => 'ANTENA DE COMUNICACIONES', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s") )
        );

		
	}

}