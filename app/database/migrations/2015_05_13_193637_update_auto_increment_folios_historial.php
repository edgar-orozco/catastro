<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateAutoIncrementFoliosHistorial extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('folios_historial', function(Blueprint $table)
		{
			   // Se elimina el campo y se agrega como serial
            if (Schema::hasColumn('folios_historial', 'id'))
            {
            	 DB::statement('ALTER TABLE folios_historial DROP COLUMN id');
            	 $table->increments('id');
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
		//
	}

}
