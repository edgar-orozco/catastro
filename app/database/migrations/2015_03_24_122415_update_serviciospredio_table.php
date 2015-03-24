<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class UpdateServiciospredioTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{

		if(Schema::hasTable('serviciospredio'))

			{

				Schema::drop('serviciospredio');
			}	

			{
				Schema::create('serviciospredio', function($table)
					{
						$table->increments('id');
						$table->string('entidad',2);
						$table->string('municipio',3);	
						$table->string('clave_catas');	
						$table->integer('gid_predio');	
						$table->integer('id_tiposervicio');			
						$table->timestamps();    
						$table->foreign('gid_predio')->references('gid')->on('predios')->onUpdate('cascade')->onDelete('cascade');
						$table->foreign('id_tiposervicio')->references('id_tiposervicio')->on('tiposervicios')->onUpdate('cascade')->onDelete('cascade');                                                                                         
					});
					 // Se renombra el id por id_serviciopredio
                	DB::statement('ALTER TABLE serviciospredio  RENAME COLUMN id TO id_serviciopredio');
			}
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('serviciospredio', function(Blueprint $table)
		{
			
			Schema::drop('serviciospredio');

		});
	}

}
