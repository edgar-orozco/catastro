<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class ValoresConstruccionTableSeeder extends Seeder {

	public function run()
	{
		DB::table('valores_construccion')->delete();
		
		DB::statement("COPY valores_construccion FROM '" . base_path() . "/sources/valores_construccion.csv'");
		
	}

}