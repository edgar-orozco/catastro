<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTiposventanasconstruccion extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tiposventanasconstruccion', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('descripcion',50);
			$table->timestamps();
		});
		// Se renombra el id por id_tvc
                DB::statement('ALTER TABLE tiposventanasconstruccion RENAME COLUMN id TO id_tvc');
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tiposventanasconstruccion');
	}

}
