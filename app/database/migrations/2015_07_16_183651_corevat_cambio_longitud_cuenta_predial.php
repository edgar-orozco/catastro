<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CorevatCambioLongitudCuentaPredial extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::connection('corevat')->getPdo()->exec('ALTER TABLE avaluos ALTER COLUMN cuenta_predial TYPE VARCHAR(15)');
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		DB::connection('corevat')->getPdo()->exec('ALTER TABLE avaluos ALTER COLUMN cuenta_predial TYPE VARCHAR(10)');
	}

}
