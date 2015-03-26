<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTiposestadosconservacionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tiposestadosconservacion', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('descripcion',50);	
			$table->timestamps();
		});
			// Se renombra el id por id_tec
                DB::statement('ALTER TABLE tiposestadosconservacion RENAME COLUMN id TO id_tec');
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tiposestadosconservacion');
	}

}
