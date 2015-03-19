<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEntidadesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if(!Schema::hasTable('entidades'))
			{
				Schema::create('entidades', function($table)
					{
						$table->integer('gid')->unique();
						$table->string('entidad',2)->unique();
						$table->string('nom_ent', 150);					
						                                                                                             
					});
					 // Se agrega el campo geom de tipo geometry
                	DB::statement('ALTER TABLE entidades ADD COLUMN geom geometry(MultiPolygon,32615);');
                	DB::statement('CREATE INDEX entidades_geom_gist ON entidades USING gist (geom);');
			}
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('entidades');
	}

}
