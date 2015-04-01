<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class UpdateInpcTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('inpc', function(Blueprint $table)
		{
			   // Se elimina el campo y se agrega como incremental
            if (Schema::hasColumn('inpc', 'id_inpc'))
            {
            	 DB::statement('ALTER TABLE inpc DROP COLUMN id_inpc CASCADE');
            	 $table->increments('id');
            }
		});

			// Se renombra el id por id_inpc
            DB::statement('ALTER TABLE inpc RENAME COLUMN id TO id_inpc');
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('inpc', function(Blueprint $table)
		{
			
		});
	}

}
