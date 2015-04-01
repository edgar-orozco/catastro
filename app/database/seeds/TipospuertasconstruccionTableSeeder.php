<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class TipospuertasconstruccionTableSeeder extends Seeder {

	public function run()
	{
		DB::table('tipospuertasconstruccion')->delete();
		
        DB::table('tipospuertasconstruccion')->insert(
            array('descripcion' => 'MADERA', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s") )
        );
         DB::table('tipospuertasconstruccion')->insert(
            array('descripcion' => 'HERRERÍA', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s") )
        );
         DB::table('tipospuertasconstruccion')->insert(
            array('descripcion' => 'ALUMINIO', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s") )
        );
	}

}