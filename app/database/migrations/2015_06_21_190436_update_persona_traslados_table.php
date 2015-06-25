<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdatePersonaTrasladosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// Se agrega el campo vigente a la tabla users
        DB::statement('ALTER table traslados DROP COLUMN vendedor_tipo');
        DB::statement('ALTER table traslados DROP COLUMN comprador_tipo');
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}
