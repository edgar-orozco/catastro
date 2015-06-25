<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePercepcionServicio extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('percepcion_servicio', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('id_tramite');
			$table->integer('evaluacion_ventanilla');
			$table->integer('solucion_dudas');
			$table->integer('trato_personal');
			$table->integer('tramite_satisfactorio');
			$table->integer('conocimiento_requisitos');
			$table->integer('cumplimiento_requisitos');
			$table->string('sugerencias_quejas', 255);			
			$table->timestamps('created_at');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('percepcion_servicio');
	}

}
