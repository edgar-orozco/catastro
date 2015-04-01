<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class UpdateSalarioMinimoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('salario_minimo', function(Blueprint $table)
		{
			// Se elimina el campo y se agrega como incremental
            if (Schema::hasColumn('salario_minimo', 'id_salario_minimo'))
            {
            	 DB::statement('ALTER TABLE salario_minimo DROP COLUMN id_salario_minimo CASCADE');
            	 $table->increments('id');
            }
		});
			// Se renombra el id por id_salario_minimo
            DB::statement('ALTER TABLE salario_minimo RENAME COLUMN id TO id_salario_minimo');
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('salario_minimo', function(Blueprint $table)
		{
			
		});
	}

}
