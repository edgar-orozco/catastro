<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateConstruccionesTableUpdate extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// Se elimina el not null de la columna sup_const
                DB::statement('ALTER table construcciones ALTER COLUMN sup_const drop not null');
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//Se agrega el not null de la columna sup_const
                DB::statement('ALTER table construcciones ALTER COLUMN sup_const set not null');

	}

}
