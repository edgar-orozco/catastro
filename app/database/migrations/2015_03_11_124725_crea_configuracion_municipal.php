<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreaConfiguracionMunicipal extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if(!Schema::hasTable('configuracion_municipal'))
			{
				Schema::create('configuracion_municipal', function($table)
					{
						$table->increments('id_configuracion');
						$table->integer('municipio')->nullable();
						$table->string('nombre', 250)->nullable();
						$table->string('cargo',250)->nullable();
						$table->integer('gastos_ejecucion_porcentaje')->nullable();
						$table->integer('descuento_multa')->nullable();
                                                $table->integer('descuento_gasto_ejecucion')->nullable();
                                                $table->integer('descuento_recargo')->nullable();
                                                $table->integer('descuento_actualizacion')->nullable();
                                                $table->string('file',250)->nullable();
                                                $table->DATE('f_alta')->nullable();
                                                
                                                
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
		Schema::drop('configuracion_municipal');
	}

}
