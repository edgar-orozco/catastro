<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrasladosColindanciasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('traslados_colindancias', function($table) {
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
