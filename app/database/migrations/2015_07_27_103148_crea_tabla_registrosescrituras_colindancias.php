<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreaTablaRegistrosescriturasColindancias extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('registro_colindancias', function($table) {
            $table->increments('id');
            $table->integer('registro_id');
            $table->string('orientacion');
            $table->string('superficie');
            $table->string('colindancia');


            $table->timestamps();

            $table->foreign('registro_id')->references('id')->on('registro_escrituras');



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
