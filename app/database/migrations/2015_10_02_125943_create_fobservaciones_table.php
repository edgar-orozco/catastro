<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFobservacionesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//Se crea la tabla de observaciones
		Schema::create('fobservaciones', function(Blueprint $table)
		{

		$table->increments('id');

		$table->string('nummemo',13);

		$table->text('observaciones');

		$table->string('tipo_observacion',2);

	    $table->timestamps();

	    $table->foreign('nummemo')->references('nummemo')->on('fmemos');
	    $table->foreign('tipo_observacion')->references('tipo_observacion')->on('ftipos_observaciones');

		});		
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//Se elimina la tabla de observaciones

		Schema::drop('fobservaciones');
	}

}
