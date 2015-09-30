<?php

class VtiposConstruccionTableSeeder extends Seeder {

	public function run()
	{
		DB::table('vtipos_construccion')->delete();

		 DB::table('vtipos_construccion')->insert(
            array('tipo_construccion' => '01', 'descripcion' => 'Antiguas', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );

		  DB::table('vtipos_construccion')->insert(
            array('tipo_construccion' => '02', 'descripcion' => 'Modernas', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );

		  DB::table('vtipos_construccion')->insert(
            array('tipo_construccion' => '03', 'descripcion' => 'Edificios Modernos', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );

		   DB::table('vtipos_construccion')->insert(
            array('tipo_construccion' => '04', 'descripcion' => 'Construcciones Especiales', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );

		    DB::table('vtipos_construccion')->insert(
            array('tipo_construccion' => '05', 'descripcion' => 'Edificios con Construcciones Especiales', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );
	}

}