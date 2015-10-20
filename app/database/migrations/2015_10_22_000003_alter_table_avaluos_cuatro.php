<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableAvaluosCuatro extends Migration {

	/**
	 * Run the migrations.
	 * 
	 * @return void
	 */
	public function up() {
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluos SET estatus = false;");
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
	}

}
