<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Mtiposventanassconstruccion extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('mtiposventanasconstruccion', function(Blueprint $table)
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
		Schema::drop('mtiposventanasconstruccion');
	}

}
