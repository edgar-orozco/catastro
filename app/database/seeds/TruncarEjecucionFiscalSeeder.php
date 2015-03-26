<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class TruncarEjecucionFiscalSeeder extends Seeder {

  public function run()
  {
    DB::statement("TRUNCATE TABLE ejecucion_fiscal CASCADE");
  }

}