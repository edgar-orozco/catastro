<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class UpdatePrediosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('predios', function(Blueprint $table)
		{
			$table->foreign('municipio')->references('municipio')->on('municipios')->onUpdate('cascade')->onDelete('cascade');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('predios', function(Blueprint $table)
		{
			$table->dropForeign('municipio_foreign');
		});
	}

}
