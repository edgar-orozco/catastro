<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class UpdateActividadesTramites2Table extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('actividades_tramites', function(Blueprint $table)
		{
			//Se agrega campo para comentarios:
            //https://www.pivotaltracker.com/story/show/104241292
            //Solicitado por personal de municipio a Antonio Barragán

            $table->text('comentarios')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('actividades_tramites', function(Blueprint $table)
		{
    		$table->dropColumn('comentarios');
		});
	}

}
