<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFmovimientosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fmovimientos', function(Blueprint $table)
		{

			$table->increments('id');
			$table->string('nummemo',13);
			$table->string('cuenta',11);
			$table->string('clave',26);
 			$table->text('observaciones_mov')->nullable();
 			$table->integer('fconcepto_mov_id')->nullable();
 			$table->timestamps();

 			$table->foreign('nummemo')->references('nummemo')->on('fmemos');
 			$table->foreign('fconcepto_mov_id')->references('id')->on('fconceptos_mov');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//Se elimina la tabla fmovimientos
		Schema::drop('fmovimientos');
	}

}
