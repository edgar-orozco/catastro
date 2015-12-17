<?php


// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class musoPredioSeeder extends Seeder {

    public function run()
  {

  	//mUsoPredio::truncate();

  	mUsoPredio::create(['descripcion'=>'Habitacional']);

  	mUsoPredio::create(['descripcion'=>'Industrial']);

  	mUsoPredio::create(['descripcion'=>'Agricola']);

  }


}