<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTramitesAddPadreId extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::table('tramites', function(Blueprint $table)
        {
            //ID del departamento donde se encuentra el trámite
            $table->integer('padre_id')->nullable();
            $table->foreign('padre_id')->references('id')->on('tramites');
        });

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::table('tramites', function(Blueprint $table)
        {
            $table->dropColumn('padre_id');
        });
	}

}
