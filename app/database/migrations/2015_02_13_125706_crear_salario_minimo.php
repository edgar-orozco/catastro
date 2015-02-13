<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearSalarioMinimo extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
            Schema::create('salario_minimo',function(Blueprint $table)
            {
              $table->increments('id_salario_minimo');   
              $table->string('zona');
              $table->integer('anio');
              $table->float('salario_minimo');
              $table->date('fecha_inicio_periodo');
              $table->date('fehca_termino_periodo');
              $table->integer('usuario_actualiza');
              $table->date('f_alta');
              $table->date('fecha_actualiza');
              $table->timestamps();
            });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('salario_minimo');
	}

}
