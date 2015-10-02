<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateVmaterialesConstruccionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('vmateriales_construccion', function(Blueprint $table)

		 { 
               // Se agrega el campo descripcion
            
            	 DB::statement('ALTER TABLE vmateriales_construccion ADD COLUMN descripcion text'); 
           
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
