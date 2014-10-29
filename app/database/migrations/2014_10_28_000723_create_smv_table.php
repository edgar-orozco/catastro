<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmvTable extends Migration {

	/**
	 * Creacíon de la tabla del salario mínimo vigente, contemplando estado, zona y monto diario.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('smv', function(Blueprint $table)
		{
			$table->increments('id');

            //Año de vigencia
            $table->integer('anio');
            //Clave de la entidad federativa
            $table->string('entidad');
            //ID del municipio
            $table->integer('municipio');
            //Area de aplicación
            $table->integer('area');
            //Monto del salario minimo vigente
            $table->decimal('monto',8,2);

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
		Schema::drop('smv');
	}

}
