<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class FtiposServiciosTableSeeder extends Seeder {

	public function run()
	{
		 DB::table('ftipos_servicios')->delete();

		DB::table('ftipos_servicios')->insert(
            array('cve_servicios' => 'A', 'descripcion' => 'AGUA POTABLE','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );

		DB::table('ftipos_servicios')->insert(
            array('cve_servicios' => 'B', 'descripcion' => 'BANQUETAS','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );
	
		DB::table('ftipos_servicios')->insert(
            array('cve_servicios' => 'C', 'descripcion' => 'CABLEVISION','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );
	
		DB::table('ftipos_servicios')->insert(
            array('cve_servicios' => 'D', 'descripcion' => 'DRENAJE','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );
	
		DB::table('ftipos_servicios')->insert(
            array('cve_servicios' => 'E', 'descripcion' => 'ALUMBRADO PUBLICO','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );
	
		DB::table('ftipos_servicios')->insert(
            array('cve_servicios' => 'F', 'descripcion' => 'CORREO','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );
	
		DB::table('ftipos_servicios')->insert(
            array('cve_servicios' => 'G', 'descripcion' => 'GAS DOMICILIARIO','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );
	
		DB::table('ftipos_servicios')->insert(
            array('cve_servicios' => 'H', 'descripcion' => 'SIN DEFINIR','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );
	
		DB::table('ftipos_servicios')->insert(
            array('cve_servicios' => 'I', 'descripcion' => 'SIN DEFINIR','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );
	
		DB::table('ftipos_servicios')->insert(
            array('cve_servicios' => 'J', 'descripcion' => 'SIN DEFINIR','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );
	
		DB::table('ftipos_servicios')->insert(
            array('cve_servicios' => 'K', 'descripcion' => 'SIN DEFINIR','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );	
	
		DB::table('ftipos_servicios')->insert(
            array('cve_servicios' => 'L', 'descripcion' => 'ELECTRIFICACION','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );
	
		DB::table('ftipos_servicios')->insert(
            array('cve_servicios' => 'M', 'descripcion' => 'MERCADO','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );
	
		DB::table('ftipos_servicios')->insert(
            array('cve_servicios' => 'N', 'descripcion' => 'SIN DEFINIR','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );
	
		DB::table('ftipos_servicios')->insert(
            array('cve_servicios' => 'O', 'descripcion' => 'SIN DEFINIR','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );
	
		DB::table('ftipos_servicios')->insert(
            array('cve_servicios' => 'P', 'descripcion' => 'PAVIMENTACION','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );
		
		DB::table('ftipos_servicios')->insert(
            array('cve_servicios' => 'Q', 'descripcion' => 'DEMASIA','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );
	
		DB::table('ftipos_servicios')->insert(
            array('cve_servicios' => 'R', 'descripcion' => 'RECOLECCION DE BASURA','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );

		DB::table('ftipos_servicios')->insert(
            array('cve_servicios' => 'S', 'descripcion' => 'SKY','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        ); 

		DB::table('ftipos_servicios')->insert(
            array('cve_servicios' => 'T', 'descripcion' => 'TELEFONIA','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );
	
		DB::table('ftipos_servicios')->insert(
            array('cve_servicios' => 'U', 'descripcion' => 'TRANSPORTE PUBLICO','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );

		DB::table('ftipos_servicios')->insert(
            array('cve_servicios' => 'V', 'descripcion' => 'SIN DEFINIR','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );
	
		DB::table('ftipos_servicios')->insert(
            array('cve_servicios' => 'W', 'descripcion' => 'SIN DEFINIR','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );
	
		DB::table('ftipos_servicios')->insert(
            array('cve_servicios' => 'X', 'descripcion' => 'SIN DEFINIR','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );
	
		DB::table('ftipos_servicios')->insert(
            array('cve_servicios' => 'Y', 'descripcion' => 'SIN DEFINIR','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );

		DB::table('ftipos_servicios')->insert(
            array('cve_servicios' => 'Z', 'descripcion' => 'SIN DEFINIR','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );
	}

}