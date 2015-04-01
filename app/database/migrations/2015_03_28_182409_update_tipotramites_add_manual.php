<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTipotramitesAddManual extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::table('tipoactividades_tramites', function(Blueprint $table)
        {
            //Clase de actividad que se ejecuta: (manual, automático, etc)
            $table->boolean('manual')->nullable();
            $table->integer('estatus_id')->nullable();
            $table->foreign('estatus_id')->references('id')->on('estatus_tramites');
        });

    }

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::table('tipoactividades_tramites', function(Blueprint $table)
        {
            $table->dropColumn('manual');
            //$table->dropColumn('estatus_id');
        });

	}

}
