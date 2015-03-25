<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class TipogirosTableSeeder extends Seeder {

	public function run()
	{
		DB::table('tipogiros')->delete();
		
        DB::table('tipogiros')->insert(
            array('descripcion' => 'COMERCIO', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s") )
        );


        DB::table('tipogiros')->insert(
            array('descripcion' => 'GOBIERNO', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s") )
        );

        DB::table('tipogiros')->insert(
            array('descripcion' => 'SERVICIOS EDUCATIVOS', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s") )
        );


        DB::table('tipogiros')->insert(
            array('descripcion' => 'SERVICIOS MÉDICOS', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s") )
        );


        DB::table('tipogiros')->insert(
            array('descripcion' => 'BANCO', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s") )
        );


        DB::table('tipogiros')->insert(
            array('descripcion' => 'HOTEL', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s") )
        );


        DB::table('tipogiros')->insert(
            array('descripcion' => 'IGLESIA', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s") )
        );


        DB::table('tipogiros')->insert(
            array('descripcion' => 'RESTAURANTE', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s") )
        );


        DB::table('tipogiros')->insert(
            array('descripcion' => 'ESTACIONAMIENTO', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s") )
        );


        DB::table('tipogiros')->insert(
            array('descripcion' => 'CINE', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s") )
        );

          DB::table('tipogiros')->insert(
            array('descripcion' => 'CLUB', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s") )
        );


        DB::table('tipogiros')->insert(
            array('descripcion' => 'PASTIZAL', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s") )
        );


        DB::table('tipogiros')->insert(
            array('descripcion' => 'OFICINA DE SERVICIOS PROFESIONALES', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s") )
        );


        DB::table('tipogiros')->insert(
            array('descripcion' => 'INDUSTRIAL', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s") )
        );


        DB::table('tipogiros')->insert(
            array('descripcion' => 'GANADERÍA', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s") )
        );


        DB::table('tipogiros')->insert(
            array('descripcion' => 'AGRÍCOLA', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s") )
        );


        DB::table('tipogiros')->insert(
            array('descripcion' => 'SERVICIOS PÚBLICOS', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s") )
        );


        DB::table('tipogiros')->insert(
            array('descripcion' => 'HABITACIONAL', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s") )
        );
	}

}