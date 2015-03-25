<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class UpdateCondominiosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('condominios', function(Blueprint $table)
		{
			if (Schema::hasColumn('condominios', 'id_propietarios'))
			{
    			//Se elimina la columna clave
    			$table->dropColumn('id_propietarios');
			}

			$table->integer('gid_predio');	
			$table->float('sup_privativa');
		});

			DB::statement('ALTER TABLE condominios ALTER COLUMN sup_comun TYPE float');
			DB::statement('ALTER TABLE condominios ALTER COLUMN indiviso TYPE float');
			DB::statement('ALTER TABLE condominios ALTER COLUMN sup_comun_magno TYPE float');
			DB::statement('ALTER TABLE condominios ALTER COLUMN indiviso_magno TYPE float');
			DB::statement('ALTER TABLE condominios ALTER COLUMN sup_total_comun TYPE float');
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

			if (Schema::hasColumn('condominios', 'id_propietarios'))
			{
    			//Se agrega la columna clave
    			$table->integer('id_propietarios');
			}

			//Se eliminan las columnas
			$table->dropColumn('gid_predio');	
			$table->dropColumn('sup_privativa');
			$table->foreign('gid_predio')->references('gid')->on('predios')->onUpdate('cascade')->onDelete('cascade');
			
			DB::statement('ALTER TABLE condominios ALTER COLUMN sup_comun TYPE numeric');
			DB::statement('ALTER TABLE condominios ALTER COLUMN indiviso TYPE numeric');
			DB::statement('ALTER TABLE condominios ALTER COLUMN sup_comun_magno TYPE numeric');
			DB::statement('ALTER TABLE condominios ALTER COLUMN indiviso_magno TYPE numeric');
			DB::statement('ALTER TABLE condominios ALTER COLUMN sup_total_comun TYPE numeric');
			
		});
	}

}
