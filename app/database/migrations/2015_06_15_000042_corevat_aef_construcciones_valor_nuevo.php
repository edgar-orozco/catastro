<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CorevatAefConstrucciones_valor_nuevo extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		DB::statement('ALTER TABLE aef_construcciones ADD COLUMN valor_nuevo NUMERIC(10,2);');
		DB::statement('ALTER TABLE aef_construcciones ALTER COLUMN valor_nuevo SET DEFAULT 0.00;');
		DB::statement('UPDATE aef_construcciones SET valor_nuevo = vida_remanente;');
		DB::statement('ALTER TABLE aef_construcciones ALTER COLUMN valor_nuevo SET NOT NULL;');
		DB::statement('ALTER TABLE aef_construcciones DROP COLUMN vida_remanente;');
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
	}

}
