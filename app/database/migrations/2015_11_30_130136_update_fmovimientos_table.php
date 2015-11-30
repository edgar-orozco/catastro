<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class UpdateFmovimientosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('fmovimientos', function(Blueprint $table)
		{
			//Se agrega el campo fecha_memo
			$table->date('fecha_memo');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('fmovimientos', function(Blueprint $table)
		{
			///Se elimina el campo 
			$table->dropColumn('fecha_memo');
		});
	}

}
