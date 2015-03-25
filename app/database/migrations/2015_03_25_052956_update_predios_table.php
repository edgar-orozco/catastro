<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class UpdatePrediosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('predios', function(Blueprint $table)
		{
			
			if (Schema::hasColumn('predios', 'clave'))
			{
    			//Se elimina la columna clave
    			$table->dropColumn('clave');
			}

			
			 $table->string('clave_inegi')->nullable();
			 $table->integer('niveles')->nullable();
			 $table->string('folio')->nullable();

		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('predios', function(Blueprint $table)
		{
		
    			//Se agrega la columna clave
    			$table->string('clave');

		

			 $table->dropColumn('clave_inegi');
			 $table->dropColumn('niveles');
			 $table->dropColumn('folio');
		});
	}

}
