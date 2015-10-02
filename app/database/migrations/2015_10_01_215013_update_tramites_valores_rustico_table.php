<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class UpdateTramitesValoresRusticoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('tramites_valores', function(Blueprint $table)
		{
			//Agregamos los campos para predios rústicos

            //Porcentaje de demérito
            $table->decimal('dem_pct_rustico')->nullable();
            //Identificar del catálogo de incrementos por acceso a vias de comunicacion
            $table->integer('inc_vias_rustico')->nullable();
            //Incremento por la cercanía a la cabecera municipal
            $table->integer('inc_dist_cabmun')->nullable();
            //Incremento por la cercanía a centros de población
            $table->integer('inc_dist_cenpob')->nullable();

		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('tramites_valores', function(Blueprint $table)
		{
			$table->dropColumn(['dem_pct_rustico','inc_vias_rustico', 'inc_dist_cabmun', 'inc_dist_cenpob']);
		});
	}

}
