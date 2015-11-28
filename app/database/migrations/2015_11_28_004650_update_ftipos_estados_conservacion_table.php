<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class UpdateFtiposEstadosConservacionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('ftipos_estados_conservacion', function(Blueprint $table)
		{
			if (Schema::hasColumn('ftipos_estados_conservacion', 'cve_edo_conservacion'))
				{
    					//Se elimina la columna cve_edo_conservacion
					   DB::statement('ALTER TABLE ftipos_estados_conservacion DROP COLUMN cve_edo_conservacion CASCADE');		

					   
				}		
				//Se agrega la columna cve_edo_conservacion tipo integer
				$table->integer('cve_edo_conservacion');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('ftipos_estados_conservacion', function(Blueprint $table)
		{
			$table->dropColumn('cve_edo_conservacion');			
			$table->string('cve_edo_conservacion',1)->nullable();
		});
	}

}
