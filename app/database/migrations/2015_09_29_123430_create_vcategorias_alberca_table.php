<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVcategoriasAlbercaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//Se crea el catálogo de categorias de albercas para valores
		Schema::create('vcategorias_alberca', function(Blueprint $table)
		{

		$table->increments('id');

		$table->string('categoria',1)->unique();

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
		//Se elimina el catálogo de categorias de albercas para valores
		Schema::drop('vcategorias_albercas');
	}

}
