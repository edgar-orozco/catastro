<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVdemeritosTerminacionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//Se crea el catalogo de demeritos por terminacion
		Schema::create('vdemeritos_terminacion', function(Blueprint $table)
		{

		$table->increments('id');
	
		$table->decimal('porc_min',3,2);

		$table->decimal('porc_max',3,2);

		$table->decimal('demerito',3,2);

		$table->integer('anio_vigencia');
	    			
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
		//Se elimina el catalogo de demeritos por terminacion
		Schema::drop('vdemeritos_terminacion');
	}

}
