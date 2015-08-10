<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CorevatAlterTableAefTerrenos extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::connection('corevat')->table('aef_terrenos', function(Blueprint $table) {
			$table->integer('fk_frente')->default(0)->nullable();
			$table->integer('fk_forma')->default(0)->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::connection('corevat')->table('aef_terrenos', function(Blueprint $table) {
			$table->dropColumn('fk_frente');
			$table->dropColumn('fk_forma');
		});
	}

}
