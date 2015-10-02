<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFtiposEstatusPredioTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//Se crea el catálogo de tipos estatus predio
		Schema::create('ftipos_estatus_predio', function(Blueprint $table)
		{

		$table->increments('id');

		$table->string('cve_estatus_predio',1)->unique();

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
		//Se elimina el catalogo de tipos estatus predio
		Schema::drop('ftipos_estatus_predio');
	}

}
