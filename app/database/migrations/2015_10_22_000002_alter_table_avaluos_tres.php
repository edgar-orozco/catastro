<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableAvaluosTres extends Migration {

	/**
	 * Run the migrations.
	 * 
	 * @return void
	 */
	public function up() {
		Schema::connection('corevat')->table('avaluos', function($table) {
			$table->boolean('estatus')->default('true');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::connection('corevat')->table('avaluos', function($table) {
			$table->dropColumn('estatus');
		});
	}

}
