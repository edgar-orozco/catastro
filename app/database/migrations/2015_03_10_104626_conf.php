<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Conf extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('conf', function(Blueprint $table)
		{
			$table->increments('id');
            $table->float('salario_minimo');
            $table->string('director_general');
            $table->string('director_catastro');
            $table->float('salario_folio_urbano');
            $table->float('salario_folio_rustico');
            $table->string('ano_folio');
            $table->string('frase_anual');
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
		Schema::drop('conf');
	}

}
