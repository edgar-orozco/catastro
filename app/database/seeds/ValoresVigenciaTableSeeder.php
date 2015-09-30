<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class ValoresVigenciaTableSeeder extends Seeder {

	public function run()
	{
		DB::table('valores_vigencia')->delete();

		DB::table('valores_vigencia')->insert(
            array('anio_ini' => 1993, 'anio_fin' => 1993, 'porcentaje_cobro' => 0.5, 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );

		DB::table('valores_vigencia')->insert(
            array('anio_ini' => 1994, 'anio_fin' => 2015, 'porcentaje_cobro' => 1, 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );

	}

}