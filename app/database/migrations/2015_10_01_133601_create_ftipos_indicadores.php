<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFtiposIndicadores extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//Se crea el catálogo de indicadores
		Schema::create('ftipos_indicadores', function(Blueprint $table)
		{

		$table->increments('id');

		$table->string('cve_indicador',1)->unique();

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
		//Se elimina el catalogo de tipos indicadores
		Schema::drop('ftipos_indicadores');
	}

}
