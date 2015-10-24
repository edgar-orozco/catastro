<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class UpdateCatFactoresUbicacionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//Se modifican las columnas de la tabla

		Schema::connection('corevat')->table('cat_factores_ubicacion', function(Blueprint $table) {
			$table->decimal('valor_minimo', 15, 2)->default(0.00);
			$table->decimal('valor_maximo', 15, 2)->default(0.00);
		});
		DB::connection('corevat')->getPdo()->exec("ALTER TABLE cat_factores_ubicacion ALTER COLUMN factor_ubicacion TYPE VARCHAR(80);");
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//Se eliminan las columnas
		DB::connection('corevat')->getPdo()->exec("ALTER TABLE cat_factores_ubicacion DROP COLUMN valor_minimo, DROP COLUMN valor_maximo;");
	}

}
