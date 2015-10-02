<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVcategoriasConstruccionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//Se crea el catalogo de categorias para Valores
		Schema::create('vcategorias_construccion', function(Blueprint $table)
		{

		$table->increments('id');

		$table->string('categoria', 2)->unique();
		
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

		Schema::drop('vcategorias_construccion');
	}

}
