<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTrasladosColindancias extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
        //Cambia de nombre
        Schema::dropIfExists('traslado_colindancias');

        Schema::create('traslado_colindancias', function($table) {
            $table->increments('id');
            $table->integer('traslado_id');
            $table->string('orientacion');
            $table->string('superficie');
            $table->string('colindancia');


            $table->timestamps();

            $table->foreign('traslado_id')->references('id')->on('traslados');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}
