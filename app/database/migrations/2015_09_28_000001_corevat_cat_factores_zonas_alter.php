<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CorevatCatFactoresZonasAlter extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::connection('corevat')->table('cat_factores_zonas', function(Blueprint $table) {
			$table->decimal('valor_minimo', 15, 2)->default(0.00);
			$table->decimal('valor_maximo', 15, 2)->default(0.00);
		});
		DB::connection('corevat')->getPdo()->exec("ALTER TABLE cat_factores_zonas ALTER COLUMN factor_zona TYPE VARCHAR(100);");
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		DB::connection('corevat')->getPdo()->exec("ALTER TABLE cat_factores_zonas DROP COLUMN valor_minimo, DROP COLUMN valor_maximo;");
	}

}
