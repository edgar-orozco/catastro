<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class FtiposClasesConstruccionTableSeeder extends Seeder {

	public function run()
	{
		DB::table('ftipos_clases_construccion')->delete();

		DB::table('ftipos_clases_construccion')->insert(
            array('cve_clase_construccion' => '1', 'descripcion' => 'CORRIENTE','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );

		DB::table('ftipos_clases_construccion')->insert(
            array('cve_clase_construccion' => '2', 'descripcion' => 'ECONOMICA','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );	

		DB::table('ftipos_clases_construccion')->insert(
            array('cve_clase_construccion' => '3', 'descripcion' => 'INTERES SOCIAL','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );

		DB::table('ftipos_clases_construccion')->insert(
            array('cve_clase_construccion' => '4', 'descripcion' => 'POPULAR','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );

		DB::table('ftipos_clases_construccion')->insert(
            array('cve_clase_construccion' => '5', 'descripcion' => 'MEDIO','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );
	
		DB::table('ftipos_clases_construccion')->insert(
            array('cve_clase_construccion' => '6', 'descripcion' => 'BUENO','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );

		DB::table('ftipos_clases_construccion')->insert(
            array('cve_clase_construccion' => '7', 'descripcion' => 'SUPERIOR','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );
	}

}