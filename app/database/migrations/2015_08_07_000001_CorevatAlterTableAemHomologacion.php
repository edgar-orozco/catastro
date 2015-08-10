<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CorevatAlterTableAemHomologacion extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::connection('corevat')->table('aem_homologacion', function(Blueprint $table) {
			$table->integer('fk_zona')->default(0)->nullable();
			$table->integer('fk_ubicacion')->default(0)->nullable();
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
		Schema::connection('corevat')->table('aem_homologacion', function(Blueprint $table) {
			$table->dropColumn('fk_zona');
			$table->dropColumn('fk_ubicacion');
			$table->dropColumn('fk_frente');
			$table->dropColumn('fk_forma');
		});
	}

}
