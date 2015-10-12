<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableAvaluoInmuebleDos extends Migration {

	/**
	 * Run the migrations.
	 * 
	 * @return void
	 */
	public function up() {
		DB::connection('corevat')->getPdo()->exec("ALTER TABLE avaluo_inmueble ADD COLUMN herreria_ventana VARCHAR(250);");
		DB::connection('corevat')->getPdo()->exec("ALTER TABLE avaluo_inmueble ADD COLUMN aluminio_ventana VARCHAR(250);");
		DB::connection('corevat')->getPdo()->exec("ALTER TABLE avaluo_inmueble ADD COLUMN herreria_puerta  VARCHAR(250);");
		DB::connection('corevat')->getPdo()->exec("ALTER TABLE avaluo_inmueble ADD COLUMN aluminio_puerta  VARCHAR(250);");
		
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		DB::connection('corevat')->getPdo()->exec("ALTER TABLE avaluo_inmueble DROP COLUMN herreria_ventana;");
		DB::connection('corevat')->getPdo()->exec("ALTER TABLE avaluo_inmueble DROP COLUMN aluminio_ventana;");
		DB::connection('corevat')->getPdo()->exec("ALTER TABLE avaluo_inmueble DROP COLUMN herreria_puerta;");
		DB::connection('corevat')->getPdo()->exec("ALTER TABLE avaluo_inmueble DROP COLUMN aluminio_puerta;");
	}

}
