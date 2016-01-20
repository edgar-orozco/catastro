<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateFoliosCompradosNumAvaluo extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('folios_comprados', function(Blueprint $table)
		{
			//agregamos la columna num_avaluo
			$table->string('num_avaluo')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('folios_comprados', function(Blueprint $table)
		{
			//agregamos la columna num_avaluo
			$table->dropColumn('num_avaluo');
		});
	}

}
