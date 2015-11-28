<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class FtiposConstruccionTableSeeder extends Seeder {

	public function run()
	{
		DB::table('ftipos_construccion')->delete();

		DB::table('ftipos_construccion')->insert(
            array('cve_tipo_construccion' => '1', 'descripcion' => 'ANTIGUAS','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );

		DB::table('ftipos_construccion')->insert(
            array('cve_tipo_construccion' => '2', 'descripcion' => 'MODERNAS','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );

		DB::table('ftipos_construccion')->insert(
            array('cve_tipo_construccion' => '3', 'descripcion' => 'EDIFICIOS MODERNOS','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );
	
		DB::table('ftipos_construccion')->insert(
            array('cve_tipo_construccion' => '4', 'descripcion' => 'CONSTRUCCIONES ESPECIALES','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );	

		DB::table('ftipos_construccion')->insert(
            array('cve_tipo_construccion' => '5', 'descripcion' => 'EDIFICIOS DE CONSTRUCCIONES ESPECIALES','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );

		DB::table('ftipos_construccion')->insert(
            array('cve_tipo_construccion' => '6', 'descripcion' => 'RUINAS','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );
	
		DB::table('ftipos_construccion')->insert(
            array('cve_tipo_construccion' => '7', 'descripcion' => 'INTERES SOCIAL','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );

	}

}