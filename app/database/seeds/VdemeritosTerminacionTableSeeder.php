<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class VdemeritosTerminacionTableSeeder extends Seeder {

	public function run()
	{
			DB::table('vdemeritos_terminacion')->delete();

			DB::table('vdemeritos_terminacion')->insert(
            array('porc_min' => 0.81, 'porc_max' => 1, 'demerito' => 0, 'anio_vigencia' => 2015,'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );

			DB::table('vdemeritos_terminacion')->insert(
            array('porc_min' => 0.61, 'porc_max' => 0.80, 'demerito' => 0.4, 'anio_vigencia' => 2015,'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );

			DB::table('vdemeritos_terminacion')->insert(
            array('porc_min' => 0.10, 'porc_max' => 0.60, 'demerito' => 0.2, 'anio_vigencia' => 2015,'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );
	}

}