<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class UpdateTipoactividadesTramites3Table extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('tipoactividades_tramites', function(Blueprint $table)
		{
            //Agregamos columna que vamos a ocupar para saber de donde vamos a sacar los datos de las formas de las actividades
            $table->string('getter')->nullable();
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
            $table->dropColumn('getter');
		});
	}

}
