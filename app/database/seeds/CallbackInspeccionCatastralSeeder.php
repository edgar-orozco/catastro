<?php


// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class CallbackInspeccionCatastralSeeder extends Seeder {

    public function run()
  {





      //Actualizacion de municipios en  folios comprados
    $id=3;
      $callback = TipoActividadTramite::find($id);
      $callback->callback = 'tramite/inspeccion/create';
      $callback->save();




  }


}