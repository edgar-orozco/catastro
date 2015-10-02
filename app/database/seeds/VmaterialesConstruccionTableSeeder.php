<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class VmaterialesConstruccionTableSeeder extends Seeder {

	public function run()
	{
		DB::table('vmateriales_construccion')->delete();
		DB::getPdo()->exec("ALTER SEQUENCE vmateriales_construccion_id_seq RESTART;");
		DB::statement("COPY vmateriales_construccion FROM '" . base_path() . "/sources/materiales_construccion.csv'");
		
		DB::getPdo()->exec("ALTER SEQUENCE vmateriales_construccion_id_seq START WITH 1;");
		DB::getPdo()->exec("ALTER SEQUENCE vmateriales_construccion_id_seq RESTART WITH 320;");
	}

}