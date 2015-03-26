<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class TiposmurosconstruccionTableSeeder extends Seeder {

	public function run()
	{
		DB::table('tiposmurosconstruccion')->delete();
		
        DB::table('tiposmurosconstruccion')->insert(
            array('descripcion' => 'LADRILLO', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s") )
        );
        DB::table('tiposmurosconstruccion')->insert(
            array('descripcion' => 'BLOCK', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s") )
        );
        DB::table('tiposmurosconstruccion')->insert(
            array('descripcion' => 'LÁMINA', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s") )
        );
        DB::table('tiposmurosconstruccion')->insert(
            array('descripcion' => 'TABLA', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s") )
        );
        DB::table('tiposmurosconstruccion')->insert(
            array('descripcion' => 'CEMENTO', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s") )
        );
        DB::table('tiposmurosconstruccion')->insert(
            array('descripcion' => 'ADOBE', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s") )
        );
	}

}