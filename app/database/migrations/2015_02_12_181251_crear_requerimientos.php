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
			$table->INT4('id_ejecucion_fiscal');
			$table->VARCHAR('cve_status', 2);
			$table->DATE('f_requerimiento');
			$table->DATE('f_notificacion');
			$table->INT4('id_ejecutor');
			$table->VARCHAR('via_notificacion', 500);
			$table->VARCHAR('nombre_persona_notificada', 200);
			$table->VARCHAR('tipo_identificacion',200);
			$table->VARCHAR('clave_identificacion', 200);
			$table->VARCHAR('observaciones', 4000);
			$table->VARCHAR('usuario', 20);
			$table->DATE('f_alta');
			$table->DATE('f_modificacion');
		}
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
