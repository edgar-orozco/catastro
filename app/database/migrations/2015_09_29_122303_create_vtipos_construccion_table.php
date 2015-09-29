<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVtiposConstruccionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
	
		//Tabla par Catálogo de tipos de construcción para los valores
		Schema::create('vtipos_construccion', function(Blueprint $table)
		{

		$table->increments('id');

		$table->string('tipo_construccion', 2)->unique();
		
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
		//Se elimina la tabla del catálogo de tipos de construccion para valores

		Schema::drop('vtipos_construccion');
	}

}
