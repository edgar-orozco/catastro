<?php

use Faker\Factory as Faker;

class TiposServiciosPublicosSeeder extends Seeder {

    public function run()
  {

     $serviciosPublicos = [
            '1'=>'Agua',
            '2'=>'Luz',
            '3'=>'Teléfono',
            '4'=>'Banqueta',
            '5'=>'Alumbrado',
            '6'=>'Pavimento',
            '7'=>'Drenaje',
            '8'=>'Transporte',
        ];

    foreach($serviciosPublicos as $a => $b)
    {
        mTiposServicios::create(['descripcion' => $b]);
    }
  }
}