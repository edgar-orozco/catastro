<?php

use Faker\Factory as Faker;

class TiposInstalacionesEspecialesConstruccionSeeder extends Seeder {

    public function run()
  {

     $catalogo = [
            'E' => 'Elevador',
            'CC' => 'Circuito cerrado',
            'ECI' => 'Equipo contra incendios',
            'SH' => 'Sistema hidroneumático',
            'EE' => 'Escaleras electromecánicas',
            'O' => 'Otros',
        ];

    foreach($catalogo as $a => $b)
    {
        mTiposInstalacionesEspeciales::create(['descripcion' => $b, 'clave' => $a]);
    }
  }
}