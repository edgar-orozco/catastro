<?php

use Faker\Factory as Faker;

class TiposVentanasConstruccionSeeder extends Seeder {

    public function run()
  {

     $catalogo = [
            'AL' => 'Aluminio',
            'HR' => 'Herrería',
            'MD' => 'Madera',
        ];

    foreach($catalogo as $a => $b)
    {
        mTiposVentanas::create(['descripcion' => $b, 'clave' => $a]);
    }
  }
}