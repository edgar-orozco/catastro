<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiciosPublicosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('servicios_publicos', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('manifestacion_predio_id')->unsigned();
			$table->foreign('manifestacion_predio_id')->references('id')->on('manifestaciones')->onDelete('cascade');
			$table->integer('tipo_servicio_id')->unsigned();
			$table->foreign('tipo_servicio_id')->references('id_tiposervicio')->on('tiposervicios')->onDelete('cascade');
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
		Schema::drop('servicios_publicos');
	}

}
