<?php

use Faker\Factory as Faker;

class TiposPuertasConstruccionSeeder extends Seeder {

    public function run()
  {

     $catalogo = [
            'AL' => 'Aluminio',
            'HR' => 'Herrería',
            'MD' => 'Madera',
        ];

    foreach($catalogo as $a => $b)
    {
        mTiposPuertas::create(['descripcion' => $b, 'clave' => $a]);
    }
  }
}