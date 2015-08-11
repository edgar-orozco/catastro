<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CorevatAlterTableAemAnalisis extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::connection('corevat')->table('aem_analisis', function(Blueprint $table) {
			$table->integer('fk_zona')->default(0)->nullable();
			$table->integer('fk_ubicacion')->default(0)->nullable();
			$table->integer('fk_conservacion')->default(0)->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::connection('corevat')->table('aem_analisis', function(Blueprint $table) {
			$table->dropColumn('fk_zona');
			$table->dropColumn('fk_ubicacion');
			$table->dropColumn('fk_conservacion');
		});
	}

}
