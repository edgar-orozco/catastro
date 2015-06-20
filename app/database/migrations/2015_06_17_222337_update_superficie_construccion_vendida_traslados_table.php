<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateSuperficieConstruccionVendidaTrasladosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::table('traslados', function(Blueprint $table)
        {
            // Se agrega el campo vigente a la tabla users
            DB::statement('ALTER table traslados ALTER COLUMN superficie_construccion_vendida SET DEFAULT 0');
        });

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
