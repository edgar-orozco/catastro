<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateValoresAlbercasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//Se crea el catalogo de valores de albercas
		Schema::create('valores_albercas', function(Blueprint $table)
		{
		
	
		$table->string('municipio',3);

		$table->string('categoria',1);

		$table->decimal('factor1',10,2);

		$table->decimal('factor2',10,2);

		$table->decimal('factor3',10,2);	
	    			
	    $table->timestamps();

		$table->foreign('categoria')->references('categoria')->on('vcategorias_alberca');


		});		


	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//Se eimina el catalogo de valores de albercas

		Schema::drop('valores_albercas');
	}

}
