<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUsersVigente extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('users', function(Blueprint $table)
		{
			// Se agrega el campo vigente a la tabla users
            DB::statement('ALTER table users ADD COLUMN vigente boolean NOT NULL DEFAULT true');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('users', function(Blueprint $table)
		{
			// Se elimina el campo vigente
            DB::statement('ALTER table users DROP COLUMN vigente');
		});
	}

}
