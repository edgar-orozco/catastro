<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTramiteMemoCuentTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//Se crea el catálogo de tramites memos cuentas
		Schema::create('tramite_memo_cuenta', function(Blueprint $table)
		{

		$table->increments('id');

		$table->integer('tramite_id');

		$table->string('cuenta',11);

		$table->string('clave',26);

		$table->string('nummemo',13);
	    			
	    $table->timestamps();

	    $table->foreign('tramite_id')->references('id')->on('tramites');

	     $table->foreign('cuenta')->references('cuenta')->on('fiscal');

	     $table->foreign('clave')->references('clave')->on('fiscal');

	     $table->foreign('nummemo')->references('nummemo')->on('fmemos');

		});		
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//Se elimina la tabla de tramites memos cuentas

		Schema::drop('tramite_memo_cuenta');
	}

}
