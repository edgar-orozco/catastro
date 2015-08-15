<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CorevatAlterTableAefConstrucciones extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::connection('corevat')->table('aef_construcciones', function(Blueprint $table) {
			$table->integer('fk_conservacion')->default(0)->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::connection('corevat')->table('aef_construcciones', function(Blueprint $table) {
			$table->dropColumn('fk_conservacion');
		});
	}

}
