<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVdemeritosAntiguedadTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//Se crea el catalogo de demeritos por antiguedad
		Schema::create('vdemeritos_antiguedad', function(Blueprint $table)
		{

		$table->increments('id');
	
		$table->integer('anio_min');

		$table->integer('anio_max');

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
		//Se elimina el catalogo de demeritos por antiguedad

		Schema::drop('vdemeritos_antiguedad');

	}

}
