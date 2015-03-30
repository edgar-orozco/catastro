<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEstatusTramitesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('estatus_tramites', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('nombre');
            $table->text('descripcion');
			$table->string('presente');
			$table->string('pasado');
			$table->integer('orden');
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('estatus_tramites');
	}

}
