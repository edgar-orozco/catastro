<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class VdemeritosAntiguedadTableSeeder extends Seeder {

	public function run()
	{
		DB::table('vdemeritos_antiguedad')->delete();

		DB::table('vdemeritos_antiguedad')->insert(
            array('anio_min' => 0, 'anio_max' => 10, 'demerito' => 0, 'anio_vigencia' => 2015,'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );

        DB::table('vdemeritos_antiguedad')->insert(
            array('anio_min' => 11, 'anio_max' => 20, 'demerito' => 0.1, 'anio_vigencia' => 2015,'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );

        DB::table('vdemeritos_antiguedad')->insert(
            array('anio_min' => 21, 'anio_max' => 30, 'demerito' => 0.2, 'anio_vigencia' => 2015,'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );

        DB::table('vdemeritos_antiguedad')->insert(
            array('anio_min' => 31, 'anio_max' => 1000, 'demerito' => 0.3, 'anio_vigencia' => 2015,'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );
	}

}