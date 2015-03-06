<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ActualizaCatStatus extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		schema::table('cat_status', function(Blueprint $table)){
		 DB::statement('ALTER TABLE cat_status ALTER COLUMN "dias_vigencia" TYPE integer USING ("dias_vigencia"::integer)');
	}
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
