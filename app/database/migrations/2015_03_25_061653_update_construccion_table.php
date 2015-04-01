<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class UpdateConstruccionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if(Schema::hasTable('construccion'))

			{

				Schema::drop('construccion');
			}	
			
			{
				Schema::create('construcciones', function($table)
					{
						$table->integer('gid');
						$table->string('entidad',2);
						$table->string('municipio',3);	
						$table->string('clave_catas');	
						$table->integer('gid_predio');		
						$table->integer('nivel');			
						$table->float('sup_const');			
						$table->integer('edad_const');			
						$table->integer('id_tuc');			
						$table->integer('id_tcc');			
						$table->integer('id_ttc');			
						$table->integer('id_tec');			
						$table->integer('id_tmc');			
						$table->integer('id_tpic');			
						$table->integer('id_tpuc');			
						$table->integer('id_tvc');			
						$table->timestamps();  
						$table->foreign('id_tuc')->references('id_tuc')->on('tiposusosconstruccion')->onUpdate('cascade')->onDelete('cascade');
						$table->foreign('id_tec')->references('id_tec')->on('tiposestadosconservacion')->onUpdate('cascade')->onDelete('cascade');
						$table->foreign('id_tcc')->references('id_tcc')->on('tiposclasesconstruccion')->onUpdate('cascade')->onDelete('cascade');
						$table->foreign('id_ttc')->references('id_ttc')->on('tipostechosconstruccion')->onUpdate('cascade')->onDelete('cascade');
						$table->foreign('id_tmc')->references('id_tmc')->on('tiposmurosconstruccion')->onUpdate('cascade')->onDelete('cascade');
						$table->foreign('id_tpic')->references('id_tpic')->on('tipospisosconstruccion')->onUpdate('cascade')->onDelete('cascade');
						$table->foreign('id_tpuc')->references('id_tpuc')->on('tipospuertasconstruccion')->onUpdate('cascade')->onDelete('cascade');
						$table->foreign('id_tvc')->references('id_tvc')->on('tiposventanasconstruccion')->onUpdate('cascade')->onDelete('cascade');						                                                                                           
					});

					 // Se agrega el campo geom de tipo geometry
                	DB::statement('ALTER TABLE construcciones ADD COLUMN geom geometry(MultiPolygon,32615);');
                	DB::statement('CREATE INDEX construcciones_geom_gist ON construcciones USING gist (geom);');


			}
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('construcciones', function(Blueprint $table)
		{
			Schema::drop('construcciones');
		});
	}

}
