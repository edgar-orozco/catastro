<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class UpdateTramites2Table extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('tramites', function(Blueprint $table)
		{
            $table->string('municipio',3)->default('008');
            $table->integer('anio')->default(2015);
            $table->foreign('municipio')->references('municipio')->on('municipios');
        });
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('tramites', function(Blueprint $table)
		{
            $table->dropColumn('municipio');
            $table->dropColumn('anio');
		});
	}

}
