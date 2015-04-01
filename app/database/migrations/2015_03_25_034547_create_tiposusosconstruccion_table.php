<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTiposusosconstruccionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if(Schema::hasTable('tiposusosconstruccion'))

		{

				Schema::drop('tiposusosconstruccion');
		}	

		Schema::create('tiposusosconstruccion', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('descripcion',50);	
			$table->timestamps();
		});
			// Se renombra el id por id_tuc
                DB::statement('ALTER TABLE tiposusosconstruccion RENAME COLUMN id TO id_tuc');
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tiposusosconstruccion');
	}

}
