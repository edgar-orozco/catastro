<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateImageneslevantamientoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('imageneslevantamiento', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('entidad',2);
			$table->string('municipio',3);	
			$table->string('clave_catas');	
			$table->integer('gid_predio');	
			$table->integer('id_tipoimagen');
			$table->string('nombre_archivo',150);
			$table->timestamps();
			$table->foreign('gid_predio')->references('gid')->on('predios')->onUpdate('cascade')->onDelete('cascade');
			$table->foreign('id_tipoimagen')->references('id_tipoimagen')->on('tipoimagenes')->onUpdate('cascade')->onDelete('cascade');
		});

		

			 // Se renombra el id por id_tl
                DB::statement('ALTER TABLE imageneslevantamiento  RENAME COLUMN id TO id_il');
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('imageneslevantamiento');
	}

}
