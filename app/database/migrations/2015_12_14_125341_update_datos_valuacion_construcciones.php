<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateDatosValuacionConstrucciones extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('datos_valuacion_construcciones', function(Blueprint $table)
		{
			
			// Se renombra el tramite_id por valuacion_id
            DB::statement('ALTER TABLE datos_valuacion_construcciones RENAME COLUMN tramite_id TO valuacion_id');

		});

		$sqls[]="ALTER TABLE datos_valuacion_construcciones DROP CONSTRAINT fk_datos_valuacion_construcciones_valuacion_tramite_id";

		$sqls[]="ALTER TABLE datos_valuacion_construcciones ADD CONSTRAINT fk_datos_valuacion_construcciones_valuacion_predios_id
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
		Schema::table('datos_valuacion_construcciones', function(Blueprint $table)
		{
			//
		});
	}

}
