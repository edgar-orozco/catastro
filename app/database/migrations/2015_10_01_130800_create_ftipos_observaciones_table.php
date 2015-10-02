<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFtiposObservacionesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//Se crea el catálogo de tipos observaciones para fiscal
		Schema::create('ftipos_observaciones', function(Blueprint $table)
		{

		$table->increments('id');

		$table->string('tipo_observacion',2)->unique();

		$table->text('descripcion');
	    			
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
		//Se elimina el catalogo de tipos observaciones
		Schema::drop('ftipos_observaciones');
	}

}
