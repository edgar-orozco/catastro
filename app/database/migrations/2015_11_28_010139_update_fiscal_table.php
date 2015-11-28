<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class UpdateFiscalTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('fiscal', function(Blueprint $table)
		{
			
			if (Schema::hasColumn('fiscal', 'cve_tipo_construccion'))
				{
    					//Se elimina la columna cve_tipo_construccion
					   DB::statement('ALTER TABLE fiscal DROP COLUMN cve_tipo_construccion CASCADE');							   
				}
			if (Schema::hasColumn('fiscal', 'cve_edo_conservacion'))
				{
    					//Se elimina la columna cve_edo_conservacion
					   DB::statement('ALTER TABLE fiscal DROP COLUMN cve_edo_conservacion  CASCADE');							   
				}	

				//Se agregan la columnas como integer
				$table->integer('cve_tipo_construccion')->nullable();
				$table->integer('cve_edo_conservacion')->nullable();
				$table->integer('cve_clase_construccion')->nullable();
				$table->nullableTimestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('fiscal', function(Blueprint $table)
		{
			$table->dropColumn('cve_tipo_construccion');	
			$table->dropColumn('cve_edo_conservacion');		
			$table->string('cve_tipo_construccion',1)->nullable();
			$table->string('cve_edo_conservacion',1)->nullable();
		});
	}

}
