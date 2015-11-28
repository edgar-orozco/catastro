<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class FtiposIndicadoresTableSeeder extends Seeder {

	public function run()
	{
		DB::table('ftipos_indicadores')->delete();

		DB::table('ftipos_indicadores')->insert(
            array('cve_indicador' => 'A', 'descripcion' => 'DEMASIA','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );
	
		DB::table('ftipos_indicadores')->insert(
            array('cve_indicador' => 'B', 'descripcion' => 'CITATORIO','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );

		DB::table('ftipos_indicadores')->insert(
            array('cve_indicador' => 'C', 'descripcion' => 'PREDIO DUPLICADO POR CLAVE (ZZ-MMM-PPPP)','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );

		DB::table('ftipos_indicadores')->insert(
            array('cve_indicador' => 'D', 'descripcion' => 'PREDIO DUPLICADO POR NUMERO DE CUENTA','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );
	
		DB::table('ftipos_indicadores')->insert(
            array('cve_indicador' => 'E', 'descripcion' => 'VALOR CATASTRAL MUY BAJO','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );

		DB::table('ftipos_indicadores')->insert(
            array('cve_indicador' => 'F', 'descripcion' => 'FRACCIONAMIENTO ARCO IRIS','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );

		DB::table('ftipos_indicadores')->insert(
            array('cve_indicador' => 'I', 'descripcion' => 'INFORMACION DEPURADA','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );

		DB::table('ftipos_indicadores')->insert(
            array('cve_indicador' => 'L', 'descripcion' => 'LICENCIA DE CONSTRUCCION','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );

        DB::table('ftipos_indicadores')->insert(
            array('cve_indicador' => 'M', 'descripcion' => 'NUMERO DE NIVELES NO CONCUERDA O ES CERO','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );    

	   	DB::table('ftipos_indicadores')->insert(
            array('cve_indicador' => 'N', 'descripcion' => 'NOTIFICACION','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );  
	
	   	DB::table('ftipos_indicadores')->insert(
            array('cve_indicador' => 'O', 'descripcion' => 'ALTA POR OMISION EN EL PADRON','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        ); 

	   	DB::table('ftipos_indicadores')->insert(
            array('cve_indicador' => 'P', 'descripcion' => 'PERMISO DE CONSTRUCCION','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        ); 

	   	DB::table('ftipos_indicadores')->insert(
            array('cve_indicador' => 'R', 'descripcion' => 'TITULOS DE LA REFORMA AGRARIA NACIONAL','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );

	   	DB::table('ftipos_indicadores')->insert(
            array('cve_indicador' => 'V', 'descripcion' => 'PREDIO VALUADO POR LEY','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );

	   	DB::table('ftipos_indicadores')->insert(
            array('cve_indicador' => 'X', 'descripcion' => 'INFORMACION ACTUALIZADA','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );
	}

}