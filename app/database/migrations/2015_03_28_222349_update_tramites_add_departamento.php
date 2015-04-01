<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTramitesAddDepartamento extends Migration {

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
            $table->integer('departamento_id')->nullable();
            $table->foreign('departamento_id')->references('id')->on('departamentos_tramites');
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
            $table->dropColumn('departamento_id');
        });

	}

}
