<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ActualizaRegistroEscrituras extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('registro_escrituras', function(Blueprint $table)
        {

							$table->integer('notario_antecedente_id')->nullable(); //integer FK a la tabla personas se toma de la tabla notarías
							$table->foreign('notario_antecedente_id')->references('id_p')->on('personas');
				});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}
