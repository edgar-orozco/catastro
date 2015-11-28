<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class FtiposUsoSueloTableSeeder extends Seeder {

	public function run()
	{
		DB::table('ftipos_uso_suelo')->delete();

		DB::table('ftipos_uso_suelo')->insert(
            array('uso_suelo' => '0', 'descripcion' => 'SIN DEFINIR','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );

		DB::table('ftipos_uso_suelo')->insert(
            array('uso_suelo' => '1', 'descripcion' => 'COMERCIO','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );

		DB::table('ftipos_uso_suelo')->insert(
            array('uso_suelo' => '2', 'descripcion' => 'CASA HABITACION','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );

		DB::table('ftipos_uso_suelo')->insert(
            array('uso_suelo' => '3', 'descripcion' => 'GOBIERNO','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );

		DB::table('ftipos_uso_suelo')->insert(
            array('uso_suelo' => '4', 'descripcion' => 'SERVICIOS EDUCATIVOS (ESCUELAS)','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );

		DB::table('ftipos_uso_suelo')->insert(
            array('uso_suelo' => '5', 'descripcion' => 'SERVICIOS MEDICOS (HOSPITALES)','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );

		DB::table('ftipos_uso_suelo')->insert(
            array('uso_suelo' => '6', 'descripcion' => 'BANCOS','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );

		DB::table('ftipos_uso_suelo')->insert(
            array('uso_suelo' => '7', 'descripcion' => 'HOTELES','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );

		DB::table('ftipos_uso_suelo')->insert(
            array('uso_suelo' => '8', 'descripcion' => 'IGLESIAS','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );

		DB::table('ftipos_uso_suelo')->insert(
            array('uso_suelo' => '9', 'descripcion' => 'SIN CONSTRUCCION (BALDIOS)','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );

		DB::table('ftipos_uso_suelo')->insert(
            array('uso_suelo' => '10', 'descripcion' => 'RESTAURANTES','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );

		DB::table('ftipos_uso_suelo')->insert(
            array('uso_suelo' => '11', 'descripcion' => 'ESTACIONAMIENTO','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );

		DB::table('ftipos_uso_suelo')->insert(
            array('uso_suelo' => '12', 'descripcion' => 'CINES','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );

		DB::table('ftipos_uso_suelo')->insert(
            array('uso_suelo' => '13', 'descripcion' => 'CLUBES','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );

		DB::table('ftipos_uso_suelo')->insert(
            array('uso_suelo' => '14', 'descripcion' => '','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );

		DB::table('ftipos_uso_suelo')->insert(
            array('uso_suelo' => '15', 'descripcion' => 'AGROPECUARIO','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );

		DB::table('ftipos_uso_suelo')->insert(
            array('uso_suelo' => '16', 'descripcion' => 'DEPARTAMENTO EN CONDOMINIO','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );

		DB::table('ftipos_uso_suelo')->insert(
            array('uso_suelo' => '17', 'descripcion' => 'OFICINAS DE SERVICIOS PROFESIONALES','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );

		DB::table('ftipos_uso_suelo')->insert(
            array('uso_suelo' => '18', 'descripcion' => 'TALLERES INDUSTRIALES','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );

		DB::table('ftipos_uso_suelo')->insert(
            array('uso_suelo' => '19', 'descripcion' => 'OFICINAS','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );

		DB::table('ftipos_uso_suelo')->insert(
            array('uso_suelo' => '20', 'descripcion' => 'BODEGAS','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );

		DB::table('ftipos_uso_suelo')->insert(
            array('uso_suelo' => '21', 'descripcion' => 'SERVICIOS PUBLICOS','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );

		DB::table('ftipos_uso_suelo')->insert(
            array('uso_suelo' => '22', 'descripcion' => 'PANTEON','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );
	
		DB::table('ftipos_uso_suelo')->insert(
            array('uso_suelo' => '23', 'descripcion' => 'SERVICIOS CULTURALES','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );
	
		DB::table('ftipos_uso_suelo')->insert(
            array('uso_suelo' => '24', 'descripcion' => 'CENTRAL CAMIONERA','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );
	
		DB::table('ftipos_uso_suelo')->insert(
            array('uso_suelo' => '25', 'descripcion' => 'POTRERO','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );

		DB::table('ftipos_uso_suelo')->insert(
            array('uso_suelo' => '26', 'descripcion' => 'INFRAESTRUCTURA PEMEX','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );

		DB::table('ftipos_uso_suelo')->insert(
            array('uso_suelo' => '27', 'descripcion' => 'RASTRO','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );

		DB::table('ftipos_uso_suelo')->insert(
            array('uso_suelo' => '28', 'descripcion' => 'PLANTA DE TRATAMIENTO DE AGUAS RESIDUALES','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );

		DB::table('ftipos_uso_suelo')->insert(
            array('uso_suelo' => '29', 'descripcion' => 'INFRAESTRUCTURA (POZO DE AGUA)','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );

		DB::table('ftipos_uso_suelo')->insert(
            array('uso_suelo' => '30', 'descripcion' => 'RECREATIVO','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );

		DB::table('ftipos_uso_suelo')->insert(
            array('uso_suelo' => '31', 'descripcion' => 'AREA VERDE','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );

		DB::table('ftipos_uso_suelo')->insert(
            array('uso_suelo' => '32', 'descripcion' => 'AREA DE DONACION','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );

		DB::table('ftipos_uso_suelo')->insert(
            array('uso_suelo' => '33', 'descripcion' => 'SERVICIO MUNICIPAL','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );	

		DB::table('ftipos_uso_suelo')->insert(
            array('uso_suelo' => '34', 'descripcion' => 'SOLAR','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );

		DB::table('ftipos_uso_suelo')->insert(
            array('uso_suelo' => '35', 'descripcion' => 'BODEGA','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );

		DB::table('ftipos_uso_suelo')->insert(
            array('uso_suelo' => '36', 'descripcion' => 'USOS MULTIPLES','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );

		DB::table('ftipos_uso_suelo')->insert(
            array('uso_suelo' => '37', 'descripcion' => 'ZONA ARQUEOLOGICA','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );

		DB::table('ftipos_uso_suelo')->insert(
            array('uso_suelo' => '38', 'descripcion' => 'OBRA NEGRA','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );

		DB::table('ftipos_uso_suelo')->insert(
            array('uso_suelo' => '39', 'descripcion' => 'AREA DE TRANSFORMADORES','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );
		
		DB::table('ftipos_uso_suelo')->insert(
            array('uso_suelo' => '40', 'descripcion' => 'TERMINAL AUTOTRANSPORTE','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );
		
		DB::table('ftipos_uso_suelo')->insert(
            array('uso_suelo' => '41', 'descripcion' => 'CARCAMO DE BOMBEO','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );
	
		DB::table('ftipos_uso_suelo')->insert(
            array('uso_suelo' => '42', 'descripcion' => 'BASURERO','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );

	}

}