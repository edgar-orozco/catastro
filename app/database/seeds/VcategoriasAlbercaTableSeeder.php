<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class VcategoriasAlbercaTableSeeder extends Seeder {

	public function run()
	{
		DB::table('vcategorias_alberca')->delete();

		 DB::table('vcategorias_alberca')->insert(
            array('categoria' => '1', 'descripcion' => 'Económica', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );


		 DB::table('vcategorias_alberca')->insert(
            array('categoria' => '2', 'descripcion' => 'Mediana', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );

		 DB::table('vcategorias_alberca')->insert(
            array('categoria' => '3', 'descripcion' => 'Lujo', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );

	}

}