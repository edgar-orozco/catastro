<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CorevatAemCompTerrenos extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::connection('corevat')->getPdo()->exec("ALTER SEQUENCE aem_comp_terrenos_idaemcompterreno_seq RESTART WITH 1001;");
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
	}

}
