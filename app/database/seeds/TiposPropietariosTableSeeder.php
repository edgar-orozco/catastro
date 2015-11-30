<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class TiposPropietariosTableSeeder extends Seeder {

	public function run()
	{
		 DB::table('tipos_propietarios')->delete();

		DB::table('tipos_propietarios')->insert(
            array('cve_tipo_propietario' => 'P','descripcion' => 'PARTICULAR','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        	);
		DB::table('tipos_propietarios')->insert(
            array('cve_tipo_propietario' => 'E','descripcion' => 'ESTATAL','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        	);
		DB::table('tipos_propietarios')->insert(
            array('cve_tipo_propietario' => 'M','descripcion' => 'MUNICIPAL','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        	);
		DB::table('tipos_propietarios')->insert(
            array('cve_tipo_propietario' => 'F','descripcion' => 'FEDERAL','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        	);
		DB::table('tipos_propietarios')->insert(
            array('cve_tipo_propietario' => 'D','descripcion' => 'DESCONOCIDO','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        	);
		DB::table('tipos_propietarios')->insert(
            array('cve_tipo_propietario' => 'S','descripcion' => 'SIN DEFINIR','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );
	}

}