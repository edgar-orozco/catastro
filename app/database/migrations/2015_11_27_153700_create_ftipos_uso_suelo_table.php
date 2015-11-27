<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFtiposUsoSueloTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//Se crea el catálogo de tipos uso de suelo
		Schema::create('ftipos_uso_suelo', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('uso_suelo');
		 	$table->text('descripcion');
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
		//Se elimina el catálogo de tipos uso de suelo
		Schema::drop('ftipos_uso_suelo');
	}

}
