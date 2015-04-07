<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class UpdateConstruccionesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('construcciones', function(Blueprint $table)
		{
			   // Se elimina el campo y se agrega como serial
            if (Schema::hasColumn('construcciones', 'gid'))
            {
            	 DB::statement('ALTER TABLE construcciones DROP COLUMN gid');
            	 $table->increments('gid');
            }
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('construcciones', function(Blueprint $table)
		{
			
		});
	}

}
