<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateValoresAlbercasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::table('valores_albercas', function(Blueprint $table)
        { 
               // Se eliminan los campos que ya no son requeridos
            if (Schema::hasColumn('valores_albercas', 'municipio'))
            {
            	 DB::statement('ALTER TABLE valores_albercas DROP COLUMN municipio');            	
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
