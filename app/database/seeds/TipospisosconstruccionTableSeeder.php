<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class TipospisosconstruccionTableSeeder extends Seeder {

	public function run()
	{
		DB::table('tipospisosconstruccion')->delete();
		
        DB::table('tipospisosconstruccion')->insert(
            array('descripcion' => 'CEMENTO', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s") )
        );
         DB::table('tipospisosconstruccion')->insert(
            array('descripcion' => 'LOSETA CERÁMICA', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s") )
        );
         DB::table('tipospisosconstruccion')->insert(
            array('descripcion' => 'MOSAICO', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s") )
        );
         DB::table('tipospisosconstruccion')->insert(
            array('descripcion' => 'TERRENO NATURAL', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s") )
        );
         DB::table('tipospisosconstruccion')->insert(
            array('descripcion' => 'MADERA', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s") )
        );
         DB::table('tipospisosconstruccion')->insert(
            array('descripcion' => 'LOSETA VINÍLICA O SIMILAR', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s") )
        );
	}

}