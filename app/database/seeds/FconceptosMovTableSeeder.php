<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class FconceptosMovTableSeeder extends Seeder {

	public function run()
	{
		DB::table('fconceptos_mov')->delete();

		DB::table('fconceptos_mov')->insert(
            array('desc_concepto_mov' => 'ACTUALIZACION DEL REGISTRO','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );

		DB::table('fconceptos_mov')->insert(
            array('desc_concepto_mov' => 'REGISTRO DE ESCRITURA PRIVADA','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );

		DB::table('fconceptos_mov')->insert(
            array('desc_concepto_mov' => 'ACTUALIZACION DE DATOS DE DOMICILIO','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );
	
		DB::table('fconceptos_mov')->insert(
            array('desc_concepto_mov' => 'ACTUALIZAciON DE DATOS DE INSCRIPCION EN EL REGISTRO PUBLICO','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );

		DB::table('fconceptos_mov')->insert(
            array('desc_concepto_mov' => 'ACTUALIZACION DE CLAVE CATASTRAL','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );
	}

}