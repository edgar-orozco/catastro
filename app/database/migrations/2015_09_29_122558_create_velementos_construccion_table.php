<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVelementosConstruccionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//Se crea el catalogo de elementos de construccion para valores
			Schema::create('velementos_construccion', function(Blueprint $table)
		{

		$table->increments('id');

		$table->string('elemento', 2)->unique();
		
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
		//Se elimina el catàlogo de elementos de construccion para valores
		Schema::drop('velementos_construccion');
	}

}
