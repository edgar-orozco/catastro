<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFmemosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//Se crea la tabla de generacion de memos
		Schema::create('fmemos', function(Blueprint $table)
		{

		$table->increments('id');

		$table->string('nummemo',13)->unique();

		$table->date('fecha_memo');
	    			
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
		//Se elimina la tabla de memos

		Schema::drop('fmemos');
	}

}
