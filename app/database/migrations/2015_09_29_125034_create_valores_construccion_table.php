<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateValoresConstruccionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//Se crea el catalogo de valores de construccion 

		Schema::create('valores_construccion', function(Blueprint $table)
		{

		$table->string('municipio', 3);

		$table->string('tipo_construccion', 2);
		
		$table->string('categoria', 2);

		$table->string('elemento', 2);

		$table->decimal('factor1', 10,2);
		
		$table->decimal('factor2', 10,2);
	
		$table->decimal('factor3', 10,2);
	    			
	    $table->timestamps();

		$table->foreign('tipo_construccion')->references('tipo_construccion')->on('vtipos_construccion');
		$table->foreign('categoria')->references('categoria')->on('vcategorias_construccion');
		$table->foreign('elemento')->references('elemento')->on('velementos_construccion');

		});	
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//Se elimina el catalogo de valores de construccion
		Schema::drop('valores_construccion');
	}

}
