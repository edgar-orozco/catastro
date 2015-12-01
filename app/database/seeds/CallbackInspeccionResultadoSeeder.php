<?php


// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class CallbackInspeccionResultadoSeeder extends Seeder {

    public function run()
  {





      $id=13;
      $callback = TipoActividadTramite::find($id);
      $callback->callback = 'tramites/inspeccion/resultado/create';
      $callback->getter = 'tramites/inspeccion/resultado/show-grid';
      $callback->save();




  }


}
