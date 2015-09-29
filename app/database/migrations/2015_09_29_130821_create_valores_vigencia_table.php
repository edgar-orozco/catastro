<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateValoresVigenciaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//Se crea el catálogo de vigencia de valores
		Schema::create('valores_vigencia', function(Blueprint $table)
		{

		$table->increments('id');
	
		$table->integer('anio_ini');

		$table->integer('anio_fin');

		$table->decimal('porcentaje_cobro',3,2);
	    			
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
		//Se eliminia el catalogo de vigencia de valores
		Schema::drop('valores_vigencia');
	}

}
