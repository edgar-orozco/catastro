<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearInpc extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('inpc',function(Blueprint $table)
            {            
                $table->increments('id_inpc');
                $table->integer('anio');
                $table->float('inpc');
                $table->integer('usuario')->nullable();
                $table->date('f_modificacion')->nullable();
                $table->date('f_alta')->nullable();
                $table->string('nombre_mes');
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
