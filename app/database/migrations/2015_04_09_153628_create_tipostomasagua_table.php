<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTipostomasaguaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tipostomasagua', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('descripcion',50);
			$table->timestamps();
		});
		// Se renombra el id por id_tipotoma
                DB::statement('ALTER TABLE tipostomasagua RENAME COLUMN id TO id_tipotoma');
	}
	
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tipostomasagua');
	}

}
