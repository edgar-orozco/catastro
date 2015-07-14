<?php

/**
 * Class AsentamientosDesarrolloTableSeeder
 *
 * Este seeder carga la tabla de asentamientos
 */

use Faker\Factory as Faker;

class AsentamientosDesarrolloTableSeeder extends Seeder {

 
	public function run()
	{
		
		DB::statement("COPY asentamientos FROM '/var/www/html/sources/asentamientos_desarrollo.csv' delimiter '|'");
		DB::statement("ALTER SEQUENCE id_asentamiento_seq RESTART WITH 2881");
 
	}
}