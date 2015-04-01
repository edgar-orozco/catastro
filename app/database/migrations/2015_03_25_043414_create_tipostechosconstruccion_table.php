<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTipostechosconstruccionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tipostechosconstruccion', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('descripcion',50);
			$table->timestamps();
		});

		// Se renombra el id por id_ttc
                DB::statement('ALTER TABLE tipostechosconstruccion RENAME COLUMN id TO id_ttc');
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tipostechosconstruccion');
	}

}
