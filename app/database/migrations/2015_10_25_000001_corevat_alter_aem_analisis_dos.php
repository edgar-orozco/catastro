<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CorevatAlterAemAnalisisDos extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::connection('corevat')->getPdo()->exec("ALTER TABLE aem_analisis ALTER COLUMN factor_conservacion TYPE NUMERIC(10,4);");
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		DB::connection('corevat')->getPdo()->exec("ALTER TABLE aem_analisis ALTER COLUMN factor_conservacion TYPE NUMERIC(10,2);");
	}

}
