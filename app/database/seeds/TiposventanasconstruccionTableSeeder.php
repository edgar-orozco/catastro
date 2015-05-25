<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class TiposventanasconstruccionTableSeeder extends Seeder {

	public function run()
	{
		DB::table('tiposventanasconstruccion')->delete();
		
        DB::table('tiposventanasconstruccion')->insert(
            array('descripcion' => 'MADERA', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s") )
        );
         DB::table('tiposventanasconstruccion')->insert(
            array('descripcion' => 'HERRERÍA', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s") )
        );
         DB::table('tiposventanasconstruccion')->insert(
            array('descripcion' => 'ALUMINIO', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s") )
        );
         
        DB::table('tiposventanasconstruccion')->insert(
            array('descripcion' => 'SIN VENTANAS', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s") )
        );
	}

}