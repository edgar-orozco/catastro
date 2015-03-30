<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class UpdateTipoActividadesTramitesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('tipoactividades_tramites', function(Blueprint $table)
		{
			$table->string('presente')->nullable();
			$table->string('pasado')->nullable();
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
			$table->dropColumn('presente');
			$table->dropColumn('pasado');
		});
	}

}
