<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCorevatEmpresasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::connection('corevat')->create('empresas', function(Blueprint $table) {
			$table->increments('idemp');
			$table->string('rs', 150)->default('');
			$table->string('ncomer', 100)->default('');
			$table->string('df', 120)->default('');
			$table->string('rfc', 20)->default('');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		DB::connection('corevat')->getPdo()->exec("DROP TABLE IF EXISTS empresas CASCADE;");
	}

}
