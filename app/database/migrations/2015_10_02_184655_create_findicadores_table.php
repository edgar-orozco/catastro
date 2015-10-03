<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFindicadoresTable extends Migration {

	
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//Se crea la tabla de indicadores
		Schema::create('findicadores', function(Blueprint $table)
		{

		$table->increments('id');

		$table->string('cuenta',11);

		$table->string('clave',26);

		$table->string('cve_indicador',1);

	    $table->timestamps();

	     $table->foreign('cuenta')->references('cuenta')->on('fiscal');

	     $table->foreign('clave')->references('clave')->on('fiscal');

	     $table->foreign('cve_indicador')->references('cve_indicador')->on('ftipos_indicadores');

		});		
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//Se elimina la tabla de indicadores

		Schema::drop('findicadores');
	}

}
