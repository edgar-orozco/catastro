<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateDatosValuacionTerrenos extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('datos_valuacion_terrenos', function(Blueprint $table)
		{
			
			// Se  renombra el tramite_id por valucion_id
			DB::statement('ALTER TABLE datos_valuacion_terrenos RENAME COLUMN tramite_id TO valuacion_id');

		});

		$sqls[]="ALTER TABLE datos_valuacion_terrenos DROP CONSTRAINT fk_datos_valuacion_terrenos_tramite_id";


		$sqls[]="ALTER TABLE datos_valuacion_terrenos ADD CONSTRAINT fk_datos_valuacion_terrenos_valuacion_predios_id
                FOREIGN KEY (valuacion_id ) REFERENCES valuacion_predios(id) DEFERRABLE";

        //Ejecutamos todas las llaves foraneas diferidas
        foreach($sqls as $sql) {
            DB::connection()->getPdo()->exec($sql);
        }

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('datos_valuacion_terrenos', function(Blueprint $table)
		{
			//
		});
	}

}
