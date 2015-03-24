<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class UpdateTipoinstalacionesespecialesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{

		if(Schema::hasTable('tiposiespeciales'))

			{
				Schema::drop('tiposiespeciales');
			}	
		  	
			Schema::create('tipoinstalacionesespeciales', function($table)
				{
					$table->increments('id');
					$table->string('descripcion');				
					$table->timestamps();    
					
				});
				
				 // Se renombra el id por id_tipoie
                DB::statement('ALTER TABLE tipoinstalacionesespeciales  RENAME COLUMN id TO id_tipoie');			
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('tipoinstalacionesespeciales', function(Blueprint $table)
		{
			Schema::drop('tipoinstalacionesespeciales');
		});
	}

}
