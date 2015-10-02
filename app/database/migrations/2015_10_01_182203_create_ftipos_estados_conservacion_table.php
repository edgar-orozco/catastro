<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFtiposEstadosConservacionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//Se crea el catálogo de tipos estados conservacion
		Schema::create('ftipos_estados_conservacion', function(Blueprint $table)
		{

		$table->increments('id');

		$table->string('cve_edo_conservacion',1)->unique();

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
		//Se elimina el catalogo de tipos estados conservacion
		Schema::drop('ftipos_estados_conservacion');
	}

}
