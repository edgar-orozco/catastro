<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdatePersonasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{

		// Se agrega la columna id_tipo
        DB::statement('ALTER table personas ADD COLUMN id_tipo integer');
                
		Schema::table('personas', function(Blueprint $table)
		{
			
			$table->foreign('id_tipo')->references('id_tipo')->on('tipopersonas')
                ->onUpdate('cascade')->onDelete('cascade');
		});		
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
           //Se elimina la columna id_tipo
           DB::statement('ALTER table personas DROP COLUMN id_tipo integer');
		
	}

}