<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class VcategoriasConstruccionTableSeeder extends Seeder {

	public function run()
	{
		DB::table('vcategorias_construccion')->delete();

		 DB::table('vcategorias_construccion')->insert(
            array('categoria' => '01', 'descripcion' => 'Económica', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );

		  DB::table('vcategorias_construccion')->insert(
            array('categoria' => '02', 'descripcion' => 'Media', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );

		   DB::table('vcategorias_construccion')->insert(
            array('categoria' => '03', 'descripcion' => 'Superior', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );

		 DB::table('vcategorias_construccion')->insert(
            array('categoria' => '04', 'descripcion' => 'Interés Social', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );

		 DB::table('vcategorias_construccion')->insert(
            array('categoria' => '05', 'descripcion' => 'Popular', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );

		 DB::table('vcategorias_construccion')->insert(
            array('categoria' => '06', 'descripcion' => 'Medio', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );

		 DB::table('vcategorias_construccion')->insert(
            array('categoria' => '07', 'descripcion' => 'Bueno', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );

		 DB::table('vcategorias_construccion')->insert(
            array('categoria' => '08', 'descripcion' => 'Superior', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );

		 DB::table('vcategorias_construccion')->insert(
            array('categoria' => '09', 'descripcion' => 'Interés Social', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );

		 DB::table('vcategorias_construccion')->insert(
            array('categoria' => '10', 'descripcion' => 'Medio', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );

		 DB::table('vcategorias_construccion')->insert(
            array('categoria' => '11', 'descripcion' => 'Superior', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );

		 DB::table('vcategorias_construccion')->insert(
            array('categoria' => '12', 'descripcion' => 'Corriente', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );

		 DB::table('vcategorias_construccion')->insert(
            array('categoria' => '13', 'descripcion' => 'Medio', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );

		 DB::table('vcategorias_construccion')->insert(
            array('categoria' => '14', 'descripcion' => 'Bueno', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );

		 DB::table('vcategorias_construccion')->insert(
            array('categoria' => '15', 'descripcion' => 'Medio', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );

		 DB::table('vcategorias_construccion')->insert(
            array('categoria' => '16', 'descripcion' => 'Bueno', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );
	}

}