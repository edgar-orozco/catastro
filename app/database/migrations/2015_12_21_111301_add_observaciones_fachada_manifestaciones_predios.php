<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddObservacionesFachadaManifestacionesPredios extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('manifestaciones', function(Blueprint $table)
		{
			$table->string('observacion')->nullable();
			$table->string('fachada')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('manifestaciones_predios', function(Blueprint $table)
		{
			$table->dropColumn('observacion');
			$table->dropColumn('fachada');
		});
	}

}
