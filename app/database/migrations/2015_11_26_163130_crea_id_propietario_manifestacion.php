<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreaIdPropietarioManifestacion extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
			Schema::table('manifestaciones', function(Blueprint $table)
		{
			$table->integer('propietario_id')->nullable();
			$table->foreign('propietario_id')->references('id_propietarios')->on('propietarios');

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}
