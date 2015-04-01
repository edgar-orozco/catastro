<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTiposmurosconstruccionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tiposmurosconstruccion', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('descripcion',50);
			$table->timestamps();
		});
		// Se renombra el id por id_tmc
                DB::statement('ALTER TABLE tiposmurosconstruccion RENAME COLUMN id TO id_tmc');
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tiposmurosconstruccion');
	}

}
