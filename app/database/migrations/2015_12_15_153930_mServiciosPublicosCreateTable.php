<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MServiciosPublicosCreateTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('mserviciospublicos', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('manifestacion_predio_id')->unsigned();
			$table->foreign('manifestacion_predio_id')->references('id')->on('manifestaciones')->onDelete('cascade');
			$table->integer('mtipo_servicio_id')->unsigned();
			$table->foreign('mtipo_servicio_id')->references('id')->on('mtipos_serviciospublicos')->onDelete('cascade');
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
		Schema::drop('mserviciospublicos');
	}

}
