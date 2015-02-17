<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearCatStatus extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if(!Schema::hasTable('cat_status'))
			{
				Schema::create('cat_status', function($table)
					{
						$table->increments('id_status');
						$table->string('cve_status', 2);
						$table->string('descrip', 120);
						$table->DATE('fecha_alta');
						$table->string('usuario_alta', 100);	
					});
			}
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('cat_status');
	}

}
