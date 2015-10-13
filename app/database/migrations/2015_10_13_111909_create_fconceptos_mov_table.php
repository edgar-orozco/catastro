<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFconceptosMovTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fconceptos_mov', function(Blueprint $table)
		{

			$table->increments('id');

 			$table->text('desc_concepto_mov');

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
		//Se elimina la tabla fconceptos_mov
		Schema::drop('fconceptos_mov');
	}

}
