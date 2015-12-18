<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateValuacionPredios extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('valuacion_predios', function(Blueprint $table)
		{
			//agrgamos las siguentes columnas
			$table->decimal('demerito_terreno',18,2)->nullable();
			$table->decimal('demerito_construccion',18,2)->nullable();
			$table->decimal('incremento_terreno',18,2)->nullable();
			$table->decimal('incremento_construccion',18,2)->nullable();
			$table->decimal('valor_ajustado_terreno',18,2)->nullable();
			$table->decimal('valor_ajustado_construccion',18,2)->nullable();
			$table->decimal('valor_catastral',18,2)->nullable();

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('valuacion_predios', function(Blueprint $table)
		{
			//Se agrega las siguentes columnas
			$table->dropColumn('demerito_terreno');
			$table->dropColumn('demerito_construccion');
			$table->dropColumn('incremento_terreno');
			$table->dropColumn('incremento_construccion');
			$table->dropColumn('valor_ajustado_terreno');
			$table->dropColumn('valor_ajustado_construccion');
			$table->dropColumn('valor_catastral');
		});
	}

}
