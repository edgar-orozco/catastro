<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTiposclasesconstruccionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tiposclasesconstruccion', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('descripcion',50);
			$table->timestamps();
		});
		// Se renombra el id por id_tcc
                DB::statement('ALTER TABLE tiposclasesconstruccion RENAME COLUMN id TO id_tcc');
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tiposclasesconstruccion');
	}

}
