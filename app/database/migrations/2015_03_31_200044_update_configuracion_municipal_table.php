<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class UpdateConfiguracionMunicipalTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('configuracion_municipal', function(Blueprint $table)
		{
			// Se elimina el campo y se agrega como incremental
            if (Schema::hasColumn('configuracion_municipal', 'id_configuracion'))
            {
            	 DB::statement('ALTER TABLE configuracion_municipal DROP COLUMN id_configuracion CASCADE');
            	 $table->increments('id');
            }
		});

			// Se renombra el id por id_configuracion
            DB::statement('ALTER TABLE configuracion_municipal RENAME COLUMN id TO id_configuracion');
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('configuracion_municipal', function(Blueprint $table)
		{
			
		});
	}

}
