<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTomasaguaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tomasagua', function(Blueprint $table)
		{
			$table->increments('gid');
			$table->string('entidad',2);
			$table->string('municipio',3);	
			$table->string('clave_catas');	
			$table->integer('gid_predio');	
			$table->string('cuenta_agua');			
			$table->boolean('toma_instalada');
			$table->timestamps();
			$table->foreign('gid_predio')->references('gid')->on('predios')->onUpdate('cascade')->onDelete('cascade');
		});

			// Se agrega el campo geom de tipo geometry
            DB::statement('ALTER TABLE tomasagua ADD COLUMN geom geometry(Point,32615);');             
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tomasagua');
	}

}
