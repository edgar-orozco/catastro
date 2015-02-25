<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateSchemaTableRequerimientos extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('requerimientos', function(Blueprint $table)
        { 
               // Se eliminan los campos que ya no son requeridos
            if (Schema::hasColumn('requerimientos', 'id_requerimiento'))
            {
            	 DB::statement('ALTER TABLE requerimientos DROP COLUMN id_requerimiento');
            	 DB::statement('ALTER TABLE requerimientos ADD COLUMN id_requerimiento SERIAL');
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