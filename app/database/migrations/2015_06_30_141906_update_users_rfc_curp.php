<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class UpdateUsersRfcCurp extends Migration {

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
            DB::statement('ALTER table users ADD COLUMN rfc VARCHAR(13) NULL DEFAULT NULL');
            DB::statement('ALTER table users ADD COLUMN curp VARCHAR(18) NULL DEFAULT NULL');
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
            DB::statement('ALTER table users DROP COLUMN rfc');
            DB::statement('ALTER table users DROP COLUMN curp');
        });
    }

}
