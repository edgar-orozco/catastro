<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTramitesModifyFolio extends Migration {

	/**
	 * Se convierte el campo folio en entero, por error se generó como varchar
	 *
	 * @return void
	 */
	public function up()
	{
        if (Schema::hasTable('tramites')) {
            DB::statement('ALTER TABLE tramites ALTER folio TYPE integer USING folio::integer');
        }
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        if (Schema::hasTable('tramites')) {
            DB::statement('ALTER TABLE tramites ALTER folio TYPE VARCHAR');
        }
	}

}
