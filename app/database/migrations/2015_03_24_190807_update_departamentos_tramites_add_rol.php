<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateDepartamentosTramitesAddRol extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::table('departamentos_tramites', function(Blueprint $table)
        {
            //Rol que va a ejecutar la actividd
            $table->integer('role_id')->nullable();
            $table->foreign('role_id')->references('id')->on('roles');


        });

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::table('departamentos_tramites', function(Blueprint $table)
        {
            $table->dropColumn('role_id');
        });

    }

}
