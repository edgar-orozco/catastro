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
			//Se integran las siguientes dos columnas
			$table->integer('puerta_id')->nullable();
			$table->integer('numero_niveles')->nullable();
		});
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
			//Se integran las siguentes dos columnas
			$table->dropColumn('puerta_id');
			$table->dropColumn('numero_niveles');
		});
	}

}
