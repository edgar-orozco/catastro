<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CorevatAlterTableAefTerrenosDos extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::connection('corevat')->table('aef_terrenos', function(Blueprint $table) {
			$table->integer('fk_top')->default(0)->nullable();
			$table->integer('fk_otros')->default(0)->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::connection('corevat')->table('aef_terrenos', function(Blueprint $table) {
			$table->dropColumn('fk_top');
			$table->dropColumn('fk_otros');
		});
	}

}

