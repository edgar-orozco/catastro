<?php

use Faker\Factory as Faker;

class TiposUsosConstruccionSeeder extends Seeder {

    public function run()
  {

     $catalogo = [
            'CH'=>'Habitacional',
            'IN'=>'Industrial',
            'CM'=>'Comercial',
            'M'=>'Mixto',
            'GO'=>'Ofic. Serv. Gob. Fral. Mpal.',
        ];
    foreach($catalogo as $a => $b)
    {
        mTiposUsosConstruccion::create(['descripcion' => $b, 'clave' => $a]);
    }
  }
}