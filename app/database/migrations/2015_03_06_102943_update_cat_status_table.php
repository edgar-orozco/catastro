<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class UpdateCatStatusTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('cat_status', function(Blueprint $table)
		{
			 DB::statement('alter table cat_status alter column cve_status type varchar(4)');			
			 $table->integer('dias_vigencia');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('cat_status', function(Blueprint $table)
		{
			 DB::statement('alter table cat_status alter column cve_status type varchar(4)');				
			 $table->dropColumn('dias_vigencia');
		});
	}

}
