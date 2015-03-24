<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGirosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('giros', function(Blueprint $table)
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
			$table->foreign('id_tipogiro')->references('id_tipogiro')->on('tipogiros')->onUpdate('cascade')->onDelete('cascade');
		});
		 // Se renombra el id por id_tipogiro
                DB::statement('ALTER TABLE giros  RENAME COLUMN id TO id_giro');
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('giros');
	}

}
