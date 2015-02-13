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
		chema::create('cat_status', function($table)
		{
		$table->increments('id_status');
		$table->VARCHAR('cve_status', 2);
		$table->VARCHAR('descrip', 120);
		$table->DATE('fecha_alta');
		$table->VARCHAR('usuario_alta', 100);	
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
