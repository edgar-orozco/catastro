<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEntrevistadosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('entrevistados', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('entidad',2);
			$table->string('municipio',3);	
			$table->string('clave_catas');	
			$table->integer('gid_predio');	
			$table->integer('id_p');	
			$table->timestamps();
			$table->foreign('gid_predio')->references('gid')->on('predios')->onUpdate('cascade')->onDelete('cascade');
			$table->foreign('id_p')->references('id_p')->on('personas')->onUpdate('cascade')->onDelete('cascade');
		});
	
     	 DB::statement('ALTER TABLE entrevistados  RENAME COLUMN id TO id_entrevistado');
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('entrevistados');
	}
}
