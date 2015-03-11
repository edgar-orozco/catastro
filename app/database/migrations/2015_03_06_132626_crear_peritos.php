<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearPeritos extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if(!Schema::hasTable('peritos'))
		{
			Schema::create('peritos', function(Blueprint $table)
				{
					$table->increments('id');
					$table->string('nombre');
					$table->string('corevat');
					$table->string('direccion');
					$table->string('telefono');
					$table->string('correo');
					$table->integer('Estado')->nullable();
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
		Schema::drop('folios_comprados');
	}

}
