<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTipoimagenesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tipoimagenes', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('descripcion');	
			$table->timestamps();
		});
			// Se renombra el id por id_tipoimagen
                DB::statement('ALTER TABLE tipoimagenes  RENAME COLUMN id TO id_tipoimagen');
	
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tipoimagenes');
	}

}
