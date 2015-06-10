<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class DropOrganizacionesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::dropIfExists('organizaciones');
		
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::create('organizaciones', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('nombre');
			$table->integer('tipo_org');
			$table->string('rfc');
			$table->timestamp('fecha_ingr');
		});

		// Se renombra el id por id_org
            DB::statement('ALTER TABLE organizaciones RENAME COLUMN id TO id_org');
	}

}
