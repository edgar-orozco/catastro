<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class TruncateEjecucionFiscalTableSeeder extends Seeder {

	public function run()
	{
		DB::table('ejecucion_fiscal')->truncate();
	}

}