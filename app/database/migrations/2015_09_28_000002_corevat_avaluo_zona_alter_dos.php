<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CorevatAvaluoZonaAlterDos extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::connection('corevat')->table('avaluo_zona', function(Blueprint $table) {
			$table->smallInteger('is_recoleccion_basura')->default(0);
			$table->smallInteger('is_vigilancia_privada')->default(0);
			$table->smallInteger('is_internet')->default(0);
			$table->string('calles_transversales', 500)->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		DB::connection('corevat')->getPdo()->exec("ALTER TABLE avaluo_zona DROP COLUMN is_recoleccion_basura, DROP COLUMN is_vigilancia_privada, DROP COLUMN is_internet, DROP COLUMN calles_transversales;");
	}

}
