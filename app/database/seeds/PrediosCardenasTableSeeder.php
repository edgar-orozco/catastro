<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class PrediosCardenasTableSeeder extends Seeder {

	public function run()
	{
		
		DB::statement("COPY predios FROM '/var/www/html/sources/predioscardenas.csv' delimiter '|'");
		DB::statement("ALTER SEQUENCE predios_gid_seq RESTART WITH 37066");
	}

}