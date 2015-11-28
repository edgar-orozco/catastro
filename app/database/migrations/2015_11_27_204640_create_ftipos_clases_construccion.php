<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFtiposClasesConstruccion extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//Se crea el catálogo de tipos clses construccion
		Schema::create('ftipos_clases_construccion', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('cve_clase_construccion');
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
		//Se elimina el catálogo de tipos clses construccion
		Schema::drop('ftipos_clases_construccion');
	}

}
