<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateIntentosTable extends Migration {

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
			$table->integer('tipotramite_id')->nullable();
			$table->integer('usuario_id');
			$table->foreign('usuario_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
			$table->foreign('tipotramite_id')->references('id')->on('tipotramites')->onUpdate('cascade')->onDelete('cascade');
			$table->timestamps();
		});

		Schema::create('requisito_intento', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('requisito_id');
			$table->integer('intento_id');
			$table->foreign('requisito_id')->references('id')->on('requisitos')->onUpdate('cascade')->onDelete('cascade');
			$table->foreign('intento_id')->references('id')->on('intentos')->onUpdate('cascade')->onDelete('cascade');
		});

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('requisito_intento');
		Schema::drop('intentos');
	}

}
