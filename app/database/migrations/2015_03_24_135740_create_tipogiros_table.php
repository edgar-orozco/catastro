<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTipogirosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tipogiros', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('descripcion');	
			$table->timestamps();
		});
		 // Se renombra el id por id_tipogiro
                DB::statement('ALTER TABLE tipogiros  RENAME COLUMN id TO id_tipogiro');
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tipogiros');
	}

}
