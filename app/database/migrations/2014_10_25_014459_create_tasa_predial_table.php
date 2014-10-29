<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasaPredialTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tasa_predial', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('anio');
            $table->integer('mes');
            $table->decimal('limite_inferior', 10, 2);
            $table->decimal('limite_superior', 10, 2);
            $table->decimal('cuota_fija', 10, 2);
            $table->decimal('pct_excedente', 6, 2);
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
		Schema::drop('tasa_predial');
	}

}
