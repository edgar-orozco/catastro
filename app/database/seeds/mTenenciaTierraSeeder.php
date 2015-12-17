<?php


// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class mTenenciaTierraSeeder extends Seeder {

    public function run()
  {

  	mTenenciaTierra::create(['descripcion'=>'Propiedad']);

  	mTenenciaTierra::create(['descripcion'=>'Ejidal']);

  	mTenenciaTierra::create(['descripcion'=>'Común']);

  	mTenenciaTierra::create(['descripcion'=>'Posesión']);
  }


}