<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Mtiposmurosconstruccion extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('mtiposmurosconstruccion', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('descripcion');
			$table->string('clave');
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
		Schema::drop('mtiposmurosconstruccion');
	}

}
