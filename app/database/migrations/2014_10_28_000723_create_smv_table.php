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
            $table->integer('anio');
            $table->string('entidad');
            $table->integer('zona');
            $table->numeric('monto',8,2);
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
