<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class ConstruccionesTableSeeder extends Seeder {

	public function run()
	{
		DB::statement("COPY construcciones FROM '/var/www/html/sources/construcciones.csv' delimiter '|'");
		DB::statement("ALTER SEQUENCE construcciones_gid_seq RESTART WITH 892");
		
	}

}