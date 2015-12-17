<?php

use Faker\Factory as Faker;

class TiposPisosConstruccionSeeder extends Seeder {

    public function run()
  {

     $catalogo = [
            'CM' => 'Cemento',
            'MS' => 'Mosaico',
            'MR' => 'Mármol',
        ];

    foreach($catalogo as $a => $b)
    {
        mTiposPisos::create(['descripcion' => $b, 'clave' => $a]);
    }
  }
}