<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class FtiposEstadosConservacionTableSeeder extends Seeder {

	public function run()
	{
		DB::table('ftipos_estados_conservacion')->delete();

		DB::table('ftipos_estados_conservacion')->insert(
            array('cve_edo_conservacion' => '0', 'descripcion' => 'SIN DEFINIR','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );

		DB::table('ftipos_estados_conservacion')->insert(
            array('cve_edo_conservacion' => '1', 'descripcion' => 'BUENO','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );

		DB::table('ftipos_estados_conservacion')->insert(
            array('cve_edo_conservacion' => '2', 'descripcion' => 'REGULAR','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );

		DB::table('ftipos_estados_conservacion')->insert(
            array('cve_edo_conservacion' => '3', 'descripcion' => 'MALO','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );
	}

}