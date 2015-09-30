<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class ValoresAlbercasTableSeeder extends Seeder {

	public function run()
	{
		DB::table('valores_albercas')->delete();

		 DB::table('valores_albercas')->insert(
            array('categoria' => '1', 'factor1' => 950, 'factor2' => 900, 'factor3' => 850, 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );

		DB::table('valores_albercas')->insert(
            array('categoria' => '2', 'factor1' => 1200, 'factor2' => 1100, 'factor3' => 1000, 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );

		DB::table('valores_albercas')->insert(
            array('categoria' => '3', 'factor1' => 1500, 'factor2' => 1400, 'factor3' => 1300, 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );

	}

}