<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class UpdateCondominiosTable3 extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('condominios', function(Blueprint $table)
		{	
			

			if (Schema::hasColumn('condominios','clave'))
			{
    			//Elimiar columna clave
    			$table->dropColumn('clave');
			}
			$table->string('clave_catas');
			$table->foreign('gid_predio')->references('gid')->on('predios')->onUpdate('cascade')->onDelete('cascade');
		});
			DB::statement('ALTER TABLE condominios ALTER COLUMN entidad TYPE varchar(2);');
			DB::statement('ALTER TABLE condominios ALTER COLUMN municipio TYPE varchar(3);');
			DB::statement('ALTER TABLE condominios ALTER COLUMN sup_privativa TYPE float;');
	}
	

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('condominios', function(Blueprint $table)
		{
			$table->renameColumn('clave_catas', 'clave');
		});
		DB::statement('ALTER TABLE condominios ALTER COLUMN sup_privativa TYPE real');
	}

}
