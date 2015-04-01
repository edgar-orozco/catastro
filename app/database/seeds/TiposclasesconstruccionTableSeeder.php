<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class TiposclasesconstruccionTableSeeder extends Seeder {

	public function run()
	{
		DB::table('tiposclasesconstruccion')->delete();
		
        DB::table('tiposclasesconstruccion')->insert(
            array('descripcion' => 'PRECARIA', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s") )
        );
          DB::table('tiposclasesconstruccion')->insert(
            array('descripcion' => 'ECONÓMICA', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s") )
        );
          DB::table('tiposclasesconstruccion')->insert(
            array('descripcion' => 'MEDIA', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s") )
        );
          DB::table('tiposclasesconstruccion')->insert(
            array('descripcion' => 'ALTA', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s") )
        );
	}

}