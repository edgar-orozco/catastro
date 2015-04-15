<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class TipoImagenesTableSeeder extends Seeder {

	public function run()
	{
		DB::table('tipoimagenes')->delete();
		
        DB::table('tipoimagenes')->insert(
            array('id_tipoimagen' => '1', 'descripcion' => 'FRONTAL', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s") )
        );

        DB::table('tipoimagenes')->insert(
            array('id_tipoimagen' => '2', 'descripcion' => 'LATERAL', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s") )
        );
        

		
	}

}