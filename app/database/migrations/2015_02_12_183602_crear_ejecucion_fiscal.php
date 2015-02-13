<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearEjecucionFiscal extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ejecucion_fiscal', function ($table) 
		{
			$table->increments('id_ejecucion_fiscal');
			$table->varchar('clave',50);
			$table->varchar('cve_status', 2)
			$table->date('f_inicio_ejecucion'); 
			$table->date('f_cancelacion');
			$table->varchar('motivo_cancelacion', 200);
			$table->int4('id_ejecutor_cancela');
			$table->varchar('usuario', 20);
			$table->date('f_alta');
			$table->date('f_modificacion') ;
			$table->timestamps();
		}
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ejecucion_fiscal');
	}

}
