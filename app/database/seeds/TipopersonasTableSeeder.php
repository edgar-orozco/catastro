<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class TipopersonasTableSeeder extends Seeder {

	public function run()
	{

		 DB::table('tipopersonas')->insert(
            array('nombre' => 'FISICA', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s") )
        );

		  DB::table('tipopersonas')->insert(
            array('nombre' => 'MORAL', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s") )
        );

	}

}