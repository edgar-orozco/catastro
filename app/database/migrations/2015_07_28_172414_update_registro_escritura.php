<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateRegistroEscritura extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('registro_escrituras', function(Blueprint $table)
        {

						if(schema::hasColumn('registro_escrituras', 'seguimiento'))
							{
								DB::statement('ALTER TABLE registro_escrituras DROP COLUMN seguimiento');
								$table->string('seguimiento',6)->nullable();

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
