<?php

use Faker\Factory as Faker;

class TiposMurosConstruccionSeeder extends Seeder {

    public function run()
  {

        $catalogo = [
            'BT' => 'Block tabique',
            'AM' => 'Adobe madera',
        ];

    foreach($catalogo as $a => $b)
    {
        mTiposMuros::create(['descripcion' => $b, 'clave' => $a]);
    }
  }
}