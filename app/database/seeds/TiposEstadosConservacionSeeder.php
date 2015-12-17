<?php

use Faker\Factory as Faker;

class TiposEstadosConservacionSeeder extends Seeder {

    public function run()
  {

     $catalogo = [
            'B'=>'Bueno',
            'R'=>'Regular',
            'M'=>'Malo',
        ];
    foreach($catalogo as $a => $b)
    {
        mTiposEstadosConservacion::create(['descripcion' => $b, 'clave' => $a]);
    }
  }
}