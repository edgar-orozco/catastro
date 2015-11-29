<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class UpdateTiposPropietarios extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('tipos_propietarios', function(Blueprint $table)
		{
			//Se agrega la columna descripcion
			$table->text('descripcion');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('tipos_propietarios', function(Blueprint $table)
		{
			//Se agrega la columna descripcion
			 $table->dropColumn('descripcion');
		});
	}

}
