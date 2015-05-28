<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTipopersonasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('tipopersonas', function(Blueprint $table)
		{
			$table->increments('id');
            //Nombre
            $table->string('nombre');
            $table->timestamps();
		});

		// Se renombra el id por id_tipo
                DB::statement('ALTER TABLE tipopersonas RENAME COLUMN id TO id_tipo');
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//Se elimina la tabla tipopersonas
		Schema::drop('tipopersonas');
	}

}
