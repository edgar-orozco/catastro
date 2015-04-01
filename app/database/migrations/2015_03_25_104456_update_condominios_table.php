<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class UpdateCondominiosTable4 extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('condominios', function(Blueprint $table)
		{
			$table->string('clave_INEGI_cond');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('condominios', function(Blueprint $table)
		{
			$table->dropColumn('clave_INEGI_cond');
		});
	}

}
