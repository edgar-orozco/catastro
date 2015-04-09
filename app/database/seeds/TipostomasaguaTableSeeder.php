<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class TipostomasaguaTableSeeder extends Seeder {

	public function run()
	{
				
        DB::table('tipostomasagua')->insert(
            array('descripcion' => 'PRINCIPAL', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s") )
        );

         DB::table('tipostomasagua')->insert(
            array('descripcion' => 'DERIVADA', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s") )
        );
	}

}