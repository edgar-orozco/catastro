<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddIntentosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('intentos', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('clave')->nullable();
			$table->string('cuenta')->nullable();
			$table->boolean('noencontrado')->default(false);
			$table->integer('tipotramite_id');
			$table->integer('usuario_id');
			$table->foreign('users')->references('id')->onUpdate('cascade')->onDelete('cascade');
			$table->foreign('tipotramites')->references('id')->onUpdate('cascade')->onDelete('cascade');
			$table->timestamps();
		});

		Schema::create('requisito_intento', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('requisito_id');
		});

	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('intentos');
		Schema::drop('requisito_intento');
	}

}
