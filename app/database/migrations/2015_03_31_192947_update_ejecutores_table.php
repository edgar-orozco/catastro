<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class UpdateEjecutoresTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('ejecutores', function(Blueprint $table)
		{
			   // Se elimina el campo y se agrega como serial
            if (Schema::hasColumn('ejecutores', 'id_ejecutor'))
            {
            	 DB::statement('ALTER TABLE ejecutores DROP COLUMN id_ejecutor CASCADE');
            	 $table->increments('id');
            }
           
		});	

			// Se renombra el id por id_ejecutor
            DB::statement('ALTER TABLE ejecutores RENAME COLUMN id TO id_ejecutor');

           //Se restablecen las llaves foraneas
           Schema::table('requerimientos', function(Blueprint $table)
				{
           			 $table->foreign('id_ejecutor')->references('id_ejecutor')->on('ejecutores')->onUpdate('cascade')->onDelete('cascade');     
        		});	

        	Schema::table('ejecucion_fiscal', function(Blueprint $table)
				{
           			 $table->foreign('id_ejecutor_cancelacion')->references('id_ejecutor')->on('ejecutores')->onUpdate('cascade')->onDelete('cascade');     
        		});	

	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('ejecutores', function(Blueprint $table)
		{
			
		});
	}

}
