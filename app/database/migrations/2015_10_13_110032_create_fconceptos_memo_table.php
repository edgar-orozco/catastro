<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFconceptosMemoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fconceptos_memo', function(Blueprint $table)
		{

			$table->increments('id');

 			$table->text('desc_concepto_memo');

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
		//Se elimina la tabla fconceptos_memo
		Schema::drop('fconceptos_memo');
	}

}
