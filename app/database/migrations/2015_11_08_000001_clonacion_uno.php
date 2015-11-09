<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class ClonacionUno extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
	//Se modifican las columnas de la tabla
		
		DB::connection('corevat')->getPdo()->exec("ALTER TABLE ai_acabados DROP CONSTRAINT ai_acabados_idavaluoinmueble_foreign;");
		DB::connection('corevat')->getPdo()->exec("ALTER TABLE ai_acabados ADD FOREIGN KEY (idavaluoinmueble) REFERENCES avaluo_inmueble(idavaluoinmueble) ON UPDATE CASCADE ON DELETE CASCADE;");
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
			
		//DB::connection('corevat')->getPdo()->exec("ALTER TABLE avaluos ALTER COLUMN estatus drop default;");
	}

}
