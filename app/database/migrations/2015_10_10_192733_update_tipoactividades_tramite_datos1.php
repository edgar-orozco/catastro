<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class UpdateTipoactividadesTramiteDatos1 extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        //Se agregan datos que debieran ir en un seeder como parte del migrate para poder asegurar que los datos se van a insertar en todos los ambientes
        $actividad = [
            'nombre'=>'Solicitar asignación de cuenta',
            'orden' => 2,
            'presente' => 'Se solicita asignación de cuenta',
            'pasado' => 'Asignación de cuenta solicitada',
            'manual' => true,
            'estatus_id' => 2
        ];

        $a = new TipoActividadTramite($actividad);
        $a->save();
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        $a = TipoActividadTramite::where('nombre','Solicitar asignación de cuenta')->first();
        if($a){
            $a->delete();
        }
	}

}
