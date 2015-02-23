<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateMunicipiosAddUnique extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//Se agrega unique a la tabla de municipios para poder tomarla como llave foranea de otras tablas
        Schema::table('municipios', function($table)
        {
            $table->unique('municipio');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::table('municipios', function($table)
        {
            $table->dropUnique('municipio');
        });

	}

}
