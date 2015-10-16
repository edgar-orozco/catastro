<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCatAcabados extends Migration {

	/**
	 * Run the migrations.
	 * 
	 * @return void
	 */
	public function up() {
		Schema::connection('corevat')->create('cat_acabados', function(Blueprint $table) {
			$table->increments('id');
			$table->string('nombre', 200);
			$table->boolean('estatus')->default(true);
			$table->timestamp('created_at')->default('1970-01-01 00:00:00');
			$table->timestamp('updated_at')->default('1970-01-01 00:00:00');
		});
		
		DB::connection('corevat')->getPdo()->exec("INSERT INTO cat_acabados (nombre, estatus) VALUES ('Recámras', true);");
		DB::connection('corevat')->getPdo()->exec("INSERT INTO cat_acabados (nombre, estatus) VALUES ('Estancia comedor', true);");
		DB::connection('corevat')->getPdo()->exec("INSERT INTO cat_acabados (nombre, estatus) VALUES ('Baños', true);");
		DB::connection('corevat')->getPdo()->exec("INSERT INTO cat_acabados (nombre, estatus) VALUES ('Escaleras', true);");
		DB::connection('corevat')->getPdo()->exec("INSERT INTO cat_acabados (nombre, estatus) VALUES ('Cocina', true);");
		DB::connection('corevat')->getPdo()->exec("INSERT INTO cat_acabados (nombre, estatus) VALUES ('Patio de servicio', true);");
		DB::connection('corevat')->getPdo()->exec("INSERT INTO cat_acabados (nombre, estatus) VALUES ('Estacionamiento', true);");
		DB::connection('corevat')->getPdo()->exec("INSERT INTO cat_acabados (nombre, estatus) VALUES ('Fachada', true);");
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		DB::connection('corevat')->getPdo()->exec("DROP TABLE IF EXISTS cat_acabados CASCADE;");
	}

}
