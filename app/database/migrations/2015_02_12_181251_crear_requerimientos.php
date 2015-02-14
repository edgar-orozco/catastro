<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearRequerimientos extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('requerimientos', function ($table) 
		{
			$table->increments('id_requerimiento');
			$table->integer('id_ejecucion_fiscal');
			$table->string('cve_status', 2);
			$table->DATE('f_requerimiento');
			$table->DATE('f_notificacion');
			$table->integer('id_ejecutor');
			$table->string('via_notificacion', 500);
			$table->string('nombre_persona_notificada', 200);
			$table->string('tipo_identificacion',200);
			$table->string('clave_identificacion', 200);
			$table->string('observaciones', 4000);
			$table->string('usuario', 20);
			$table->DATE('f_alta');
			$table->DATE('f_modificacion');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
	  	Schema::drop('requerimientos');
	}

}
