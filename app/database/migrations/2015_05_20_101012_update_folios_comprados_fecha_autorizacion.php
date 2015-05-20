<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateFoliosCompradosFechaAutorizacion extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('folios_comprados', function(Blueprint $table)
		{
			if (Schema::hasColumn('folios_comprados','fecha_autorizacion'))
            {
            	 DB::statement('ALTER TABLE folios_comprados DROP COLUMN fecha_autorizacion');
            }
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
