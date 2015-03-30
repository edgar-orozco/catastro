<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class UpdateAddTramitesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('tramites', function(Blueprint $table)
		{
			$table->integer('estatus_id')->nullable();
            $table->foreign('estatus_id')->references('id')->on('estatus_tramites');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('tramites', function(Blueprint $table)
		{
			$table->dropColumn('estatus_id');
		});
	}

}
