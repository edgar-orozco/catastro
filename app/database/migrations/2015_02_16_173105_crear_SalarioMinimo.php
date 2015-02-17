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
           
            if(!Schema::hasTable('salario_minimo'))
            {
            Schema::create('salario_minimo',function(Blueprint $table)
            {
              $table->increments('id_salario_minimo');   
              $table->string('zona',2);
              $table->integer('anio');
              $table->float('salario_minimo');
              $table->date('fecha_inicio_periodo');
              $table->date('fecha_termino_periodo');
              $table->integer('usuario_actualiza')->nullable();
              $table->date('f_alta')->nullable();
              $table->date('fecha_actualiza')->nullable();

            });
        }}

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
