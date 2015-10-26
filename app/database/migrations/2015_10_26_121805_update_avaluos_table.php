<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class UpdateAvaluosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
	//Se modifican las columnas de la tabla
		
		DB::connection('corevat')->getPdo()->exec("ALTER TABLE avaluos ALTER COLUMN estatus set default false;");
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
			
		DB::connection('corevat')->getPdo()->exec("ALTER TABLE avaluos ALTER COLUMN estatus drop default;");
	}

}
