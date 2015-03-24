<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class UpdateInstalacionesespecialesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if(Schema::hasTable('instalaciones_especiales'))

			{
				Schema::drop('instalaciones_especiales');
			}	
		  	
			Schema::create('instalacionesespeciales', function($table)
				{
					$table->increments('id');
					$table->string('entidad',2);
					$table->string('municipio',3);	
					$table->string('clave_catas');	
					$table->integer('gid_predio');	
					$table->integer('id_tipogiro');		
					$table->float('superficie_terreno');	
					$table->float('superficie_construccion');	
					$table->timestamps();    
					$table->foreign('gid_predio')->references('gid')->on('predios')->onUpdate('cascade')->onDelete('cascade');
					$table->foreign('id_tipogiro')->references('id_tipogiro')->on('tipoinstalacionesespeciales')->onUpdate('cascade')->onDelete('cascade');                                           
				});
				
				 // Se renombra el id por id_tipoie
                DB::statement('ALTER TABLE instalacionesespeciales  RENAME COLUMN id TO id_ie');
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('instalacionesespeciales', function(Blueprint $table)
		{
			Schema::drop('instalacionesespeciales');
		});
	}

}
