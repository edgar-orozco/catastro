<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CorevatAefConstruccionesValorNuevo extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
        if(Schema::connection('corevat')->hasTable('aef_construcciones')) {
            DB::connection('corevat')->statement('ALTER TABLE aef_construcciones ADD COLUMN valor_nuevo NUMERIC(10,2);');
            DB::connection('corevat')->statement('ALTER TABLE aef_construcciones ALTER COLUMN valor_nuevo SET DEFAULT 0.00;');
            DB::connection('corevat')->statement('UPDATE aef_construcciones SET valor_nuevo = vida_remanente;');
            DB::connection('corevat')->statement('ALTER TABLE aef_construcciones ALTER COLUMN valor_nuevo SET NOT NULL;');
            DB::connection('corevat')->statement('ALTER TABLE aef_construcciones DROP COLUMN vida_remanente;');
        }
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
	}

}
