<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CorevatAlterTableAvaluos2 extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {

		DB::connection('corevat')->getPdo()->exec("ALTER TABLE avaluos ADD COLUMN fk_titulo_solicitante INTEGER, ADD COLUMN fk_titulo_propietario INTEGER, ADD COLUMN fk_finalidad INTEGER;");

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		DB::connection('corevat')->getPdo()->exec("ALTER TABLE avaluos DROP COLUMN fk_titulo_solicitante, DROP COLUMN fk_titulo_propietario, DROP COLUMN fk_finalidad;");
	}

}
