<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFserviciosPredioTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//Se crea la tabla de servicios predio
		Schema::create('fservicios_predio', function(Blueprint $table)
		{

		$table->increments('id');

		$table->string('cuenta',11);

		$table->string('clave',26);

		$table->string('cve_servicios',1);

	    $table->timestamps();

	     $table->foreign('cuenta')->references('cuenta')->on('fiscal');

	     $table->foreign('clave')->references('clave')->on('fiscal');

	     $table->foreign('cve_servicios')->references('cve_servicios')->on('ftipos_servicios');

		});		
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//Se elimina la tabla de servicios predio

		Schema::drop('fservicios_predio');
	}
}
