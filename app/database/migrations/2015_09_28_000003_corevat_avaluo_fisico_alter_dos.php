<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CorevatAvaluoFisicoAlterDos extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::connection('corevat')->table('avaluo_enfoque_fisico', function(Blueprint $table) {
			$table->string('justificacion_valor_aplicado', 500)->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		DB::connection('corevat')->getPdo()->exec("ALTER TABLE avaluo_enfoque_fisico DROP COLUMN justificacion_valor_aplicado;");
	}

}
