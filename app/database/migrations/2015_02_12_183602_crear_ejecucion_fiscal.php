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
		if(!Schema::hasTable('ejecucion_fiscal'))
		{
			Schema::create('ejecucion_fiscal', function ($table) 
			{
				$table->increments('id_ejecucion_fiscal');
				$table->string('clave',50);
				$table->string('cve_status', 2);
				$table->date('f_inicio_ejecucion'); 
				$table->date('f_cancelacion');
				$table->string('motivo_cancelacion', 200);
				$table->integer('id_ejecutor_cancela');
				$table->string('usuario', 20);
				$table->date('f_alta');
				$table->date('f_modificacion') ;
				$table->timestamps();
			});
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
