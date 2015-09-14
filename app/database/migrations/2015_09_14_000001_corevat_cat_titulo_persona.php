<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CorevatCatTituloPersona extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::connection('corevat')->create('cat_titulo_persona', function(Blueprint $table) {
			$table->increments('idtitulopersona');
			$table->string('titulo_persona', 100);
			$table->integer('status')->default(1);
			$table->nullableTimestamps();
		});

		DB::connection('corevat')->getPdo()->exec("INSERT INTO cat_titulo_persona (titulo_persona, created_at) VALUES ('SR.', now());");
		DB::connection('corevat')->getPdo()->exec("INSERT INTO cat_titulo_persona (titulo_persona, created_at) VALUES ('SRA.', now());");
		DB::connection('corevat')->getPdo()->exec("INSERT INTO cat_titulo_persona (titulo_persona, created_at) VALUES ('SRES.', now());");
		DB::connection('corevat')->getPdo()->exec("INSERT INTO cat_titulo_persona (titulo_persona, created_at) VALUES ('SRITA.', now());");
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		DB::connection('corevat')->getPdo()->exec("DROP TABLE IF EXISTS cat_titulo_persona CASCADE;");
	}

}
