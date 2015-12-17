<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MtiposConstruccion extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('mtipos_construccion', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('descripcion');
			$table->string('cve_tipo_construccion');
			$table->string('grupo_tipoconstruccion');
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
		Schema::drop('mtipos_construccion');
	}

}
