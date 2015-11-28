<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class UpdateFtiposConstruccion extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('ftipos_construccion', function(Blueprint $table)
		{
			if (Schema::hasColumn('ftipos_construccion', 'cve_tipo_construccion'))
				{
    					//Se elimina la columna cve_tipo_construccion
					   DB::statement('ALTER TABLE ftipos_construccion DROP COLUMN cve_tipo_construccion CASCADE');		

					   
				}		
				//Se agrega la columna cve_tipo_construccion tipo integer
				$table->integer('cve_tipo_construccion');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('ftipos_construccion', function(Blueprint $table)
		{
			$table->dropColumn('cve_tipo_construccion');			
			$table->string('cve_tipo_construccion',1)->nullable();
		});
	}

}
