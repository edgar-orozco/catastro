<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVmaterialesConstruccionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//Se crea el catálogo de materiales de construccion para valores
		Schema::create('vmateriales_construccion', function(Blueprint $table)
		{

		$table->increments('id');
	
		$table->string('categoria', 2);

		$table->string('elemento', 2);
	    			
	    $table->timestamps();

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
		//Se elimina el catálogo de materiales de cpnstruccion para valores
		Schema::drop('vmateriales_construccion');
	}

}
