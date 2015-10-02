<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class VelementosConstruccionTableSeeder extends Seeder {

	public function run()
	{
		DB::table('velementos_construccion')->delete();

		 DB::table('velementos_construccion')->insert(
            array('elemento' => '01', 'descripcion' => 'Cimentación', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );

		  DB::table('velementos_construccion')->insert(
            array('elemento' => '02', 'descripcion' => 'Estructuras', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );

		  DB::table('velementos_construccion')->insert(
            array('elemento' => '03', 'descripcion' => 'Techos Y Entrepisos', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );

		  DB::table('velementos_construccion')->insert(
            array('elemento' => '04', 'descripcion' => 'Muros', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );

		  DB::table('velementos_construccion')->insert(
            array('elemento' => '05', 'descripcion' => 'Hidráulica', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );

		  DB::table('velementos_construccion')->insert(
            array('elemento' => '06', 'descripcion' => 'Sanitaria', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );

		  DB::table('velementos_construccion')->insert(
            array('elemento' => '07', 'descripcion' => 'Eléctrica', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );

		   DB::table('velementos_construccion')->insert(
            array('elemento' => '08', 'descripcion' => 'Especial', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );

		     DB::table('velementos_construccion')->insert(
            array('elemento' => '09', 'descripcion' => 'Puertas y Ventanas', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );

		   DB::table('velementos_construccion')->insert(
            array('elemento' => '10', 'descripcion' => 'Pisos, Lambrines y Varios', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );

		   DB::table('velementos_construccion')->insert(
            array('elemento' => '11', 'descripcion' => 'Barandales, Escaleras y Portones', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );

		  DB::table('velementos_construccion')->insert(
            array('elemento' => '12', 'descripcion' => 'Puertas y Ventanas', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );

		  DB::table('velementos_construccion')->insert(
            array('elemento' => '13', 'descripcion' => 'Barandales, Escaleras y Rejas', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );

		  DB::table('velementos_construccion')->insert(
            array('elemento' => '14', 'descripcion' => 'Fachadas', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );

		  DB::table('velementos_construccion')->insert(
            array('elemento' => '15', 'descripcion' => 'Aplanados Interiores', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );

		   DB::table('velementos_construccion')->insert(
            array('elemento' => '16', 'descripcion' => 'Lambrines', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );

		  DB::table('velementos_construccion')->insert(
            array('elemento' => '17', 'descripcion' => 'Pisos', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );

		  DB::table('velementos_construccion')->insert(
            array('elemento' => '18', 'descripcion' => 'Vidrios', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );

		  DB::table('velementos_construccion')->insert(
            array('elemento' => '19', 'descripcion' => 'Pintura', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );

		  DB::table('velementos_construccion')->insert(
            array('elemento' => '20', 'descripcion' => 'Impermeabilizantes', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );
	}

}