<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class TiposestadosconservacionTableSeeder extends Seeder {

	public function run()
	{
		DB::table('tiposestadosconservacion')->delete();
		
        DB::table('tiposestadosconservacion')->insert(
            array('descripcion' => 'BUENO', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s") )
        );
         DB::table('tiposestadosconservacion')->insert(
            array('descripcion' => 'REGULAR', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s") )
        );
          DB::table('tiposestadosconservacion')->insert(
            array('descripcion' => 'MALO', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s") )
        );
         DB::table('tiposestadosconservacion')->insert(
            array('descripcion' => 'RUINOSO, SUSCEPTIBLES DE REPARACIÓN', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s") )
        );
	}

}