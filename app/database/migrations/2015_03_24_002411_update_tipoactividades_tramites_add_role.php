<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTipoactividadesTramitesAddRole extends Migration {

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
            $table->string('clase')->nullable();

            //Callback, método o función que se debe ejecutar en esta actividad.
            $table->string('callback')->nullable();

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
            $table->dropColumn('clase');
            $table->dropColumn('callback');

        });
	}

}
