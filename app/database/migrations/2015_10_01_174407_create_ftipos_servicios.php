<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFtiposServicios extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//Se crea el catálogo de tipos de servicios
		Schema::create('ftipos_servicios', function(Blueprint $table)
		{

		$table->increments('id');

		$table->string('cve_servicios',1)->unique();

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
		//Se elimina el catalogo de tipos servicios
		Schema::drop('ftipos_servicios');
	}

}
