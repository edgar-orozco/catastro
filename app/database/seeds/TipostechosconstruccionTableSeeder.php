<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class TipostechosconstruccionTableSeeder extends Seeder {

	public function run()
	{
		DB::table('tipostechosconstruccion')->delete();
		
        DB::table('tipostechosconstruccion')->insert(
            array('descripcion' => 'LOZA', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s") )
        );
         DB::table('tipostechosconstruccion')->insert(
            array('descripcion' => 'LÁMINA ZINC', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s") )
        );
         DB::table('tipostechosconstruccion')->insert(
            array('descripcion' => 'LÁMINA ASBESTO', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s") )
        );
         DB::table('tipostechosconstruccion')->insert(
            array('descripcion' => 'LÁMINA TRASLÚCIDA', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s") )
        );
         DB::table('tipostechosconstruccion')->insert(
            array('descripcion' => 'POLICARBONATO', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s") )
        );
	}

}