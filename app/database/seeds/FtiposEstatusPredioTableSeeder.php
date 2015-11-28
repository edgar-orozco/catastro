<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class FtiposEstatusPredioTableSeeder extends Seeder {

	public function run()
	{
		DB::table('ftipos_estatus_predio')->delete();

		DB::table('ftipos_estatus_predio')->insert(
            array('cve_estatus_predio' => 'C', 'descripcion' => 'CANCELADO','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );

		DB::table('ftipos_estatus_predio')->insert(
            array('cve_estatus_predio' => 'E', 'descripcion' => 'EXENTO','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );

		DB::table('ftipos_estatus_predio')->insert(
            array('cve_estatus_predio' => 'V', 'descripcion' => 'VIGENTE','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );
	}

}