<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class OpcionSinDefinirTableSeeder extends Seeder {

	public function run()
	{
		
		 DB::table('tiposclasesconstruccion')->insert(
            array('id_tcc' => '100','descripcion' => 'SIN DEFINIR', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s") )
        );

        DB::table('tiposestadosconservacion')->insert(
            array('id_tec' => '100','descripcion' => 'SIN DEFINIR', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s") )
        );

          DB::table('tiposmurosconstruccion')->insert(
            array('id_tmc' => '100','descripcion' => 'SIN DEFINIR', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s") )
        );

         
            DB::table('tipospisosconstruccion')->insert(
            array('id_tpic' => '100','descripcion' => 'SIN DEFINIR', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s") )
        );

            DB::table('tipospuertasconstruccion')->insert(
            array('id_tpuc' => '100','descripcion' => 'SIN DEFINIR', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s") )
        );

          DB::table('tipostechosconstruccion')->insert(
            array('id_ttc' => '100','descripcion' => 'SIN DEFINIR', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s") )
        );

           DB::table('tiposusosconstruccion')->insert(
            array('id_tuc' => '100','descripcion' => 'SIN DEFINIR', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s") )
        );

         DB::table('tiposventanasconstruccion')->insert(
            array('id_tvc' => '100','descripcion' => 'SIN DEFINIR', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s") )
        );
	}

}