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
			
			DB::query('ALTER TABLE cat_status MODIFY COLUMN cve_status VARCHAR(4)');
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
			 DB::query('ALTER TABLE cat_status MODIFY COLUMN cve_status VARCHAR(2)');			
			 $table->dropColumn('dias_vigencia');
		});
	}

}
