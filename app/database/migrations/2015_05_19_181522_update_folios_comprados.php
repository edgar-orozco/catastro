<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateFoliosComprados extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('folios_comprados', function(Blueprint $table)
		{
			$table->date('fecha_autorizacion')->nullable();
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
			$table->dropColumn('fecha_autorizacion');
		});
	}

}
