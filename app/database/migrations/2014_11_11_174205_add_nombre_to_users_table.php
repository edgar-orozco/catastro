<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddNombreToUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('users', function(Blueprint $table)
		{
			$table->string('nombre')->after('username');
			$table->string('apepat')->after('nombre');
			$table->string('apemat')->nullable()->after('apepat');
            $table->dropUnique('users_email_unique');
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
			$table->dropColumn('nombre');
			$table->dropColumn('apepat');
			$table->dropColumn('apemat');
            $table->unique('email','users_email_unique');
		});
	}

}
