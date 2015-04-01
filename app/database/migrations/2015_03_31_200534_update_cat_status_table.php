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
			// Se elimina el campo y se agrega como incremental
            if (Schema::hasColumn('cat_status', 'id_status'))
            {
            	 DB::statement('ALTER TABLE cat_status DROP COLUMN id_status CASCADE');
            	 $table->increments('id');
            }
		});
			// Se renombra el id por id_status
            DB::statement('ALTER TABLE cat_status RENAME COLUMN id TO id_status');
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
			
		});
	}

}
