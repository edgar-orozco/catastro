<?php

use Faker\Factory as Faker;

class TiposTechosConstruccionSeeder extends Seeder {

    public function run()
  {

     $techos = [
            'CC'=>'Concreto',
            'TB'=>'Teja de barro',
            'LZ'=>'Lámina de zinc',
            'LA'=>'Lámina de asbesto',
            'OT'=>'Otros',
        ];

    foreach($techos as $a => $b)
    {
        mTiposTechos::create(['descripcion' => $b, 'clave' => $a]);
    }
  }
}