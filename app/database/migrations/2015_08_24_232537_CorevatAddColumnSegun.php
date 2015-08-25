<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CorevatAddColumnSegun extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::connection('corevat')->table('avaluo_inmueble', function(Blueprint $table) {
			$table->string('segun', 150)->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::connection('corevat')->table('avaluo_inmueble', function(Blueprint $table) {
			$table->dropColumn('segun');
		});
	}

}
