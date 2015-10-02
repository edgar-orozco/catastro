<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFtiposConstruccionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//Se crea el catálogo de tipos construccion
		Schema::create('ftipos_construccion', function(Blueprint $table)
		{

		$table->increments('id');

		$table->string('cve_tipo_construccion',1)->unique();

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
		//Se elimina el catalogo de tipos construccion
		Schema::drop('ftipos_construccion');
	}

}
