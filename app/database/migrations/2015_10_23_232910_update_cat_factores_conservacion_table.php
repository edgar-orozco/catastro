<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class UpdateCatFactoresConservacionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		
		//Se modifican las columnas de la tabla
		
		DB::connection('corevat')->getPdo()->exec("ALTER TABLE cat_factores_conservacion ALTER COLUMN factor_conservacion TYPE VARCHAR(50);");
    	DB::connection('corevat')->getPdo()->exec("ALTER TABLE cat_factores_conservacion ALTER COLUMN valor_factor_conservacion TYPE numeric(10,4);");	
    		
		
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		DB::connection('corevat')->getPdo()->exec("ALTER TABLE cat_factores_conservacion ALTER COLUMN factor_conservacion TYPE VARCHAR(20);");
    	DB::connection('corevat')->getPdo()->exec("ALTER TABLE cat_factores_conservacion ALTER COLUMN valor_factor_conservacion TYPE numeric(10,2);");	
	}

}
