<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateServiciospredioTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('serviciospredio', function(Blueprint $table)
		{
			$table->increments('id_serviciopredio');
			$table->integer('gid_predio');
			$table->integer('id_tiposerviciopredio');
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
		Schema::drop('serviciospredio');
	}

}
