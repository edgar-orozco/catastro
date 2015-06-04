<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
			//Se agregan columnas nuevas
			$table->decimal('sup_terr_privativa', 10, 2)->default(0.0)->nullable();
			$table->decimal('sup_const_privativa', 10, 2)->default(0.0)->nullable();
			$table->decimal('sup_total_construccion', 10, 2)->default(0.0)->nullable();
			$table->decimal('sup_total_terreno', 10, 2)->default(0.0)->nullable();
			$table->integer('no_cond_magno')->default(0)->nullable();;
			$table->decimal('sup_cond_magno_terreno', 10, 2)->default(0.0)->nullable();
			$table->decimal('sup_cond_magno_construccion', 10, 2)->default(0.0)->nullable();
			$table->decimal('sup_comun_magno_terreno', 10, 2)->default(0.0)->nullable();
			$table->decimal('sup_comun_magno_construccion', 10, 2)->default(0.0)->nullable();

			//Se eliminan columnas
			  $table->dropColumn('sup_comun');
			  $table->dropColumn('sup_comun_magno');
			  $table->dropColumn('indiviso_magno');
			  $table->dropColumn('sup_total_comun');
			  $table->dropColumn('no_unidades');
			  $table->dropColumn('sup_privativa');

						
			  // Se cambia el tipo de dato de la columna indiviso
            if (Schema::hasColumn('condominios', 'indiviso'))
            {
            	 DB::statement('ALTER TABLE condominios ALTER COLUMN indiviso type numeric(10,2) ');            	 
            }

		});
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
			//Se eliminan columnas creadas

			$table->dropColumn('sup_terr_privativa');
			$table->dropColumn('sup_const_privativa');
			$table->dropColumn('sup_total_construccion');
			$table->dropColumn('sup_total_terreno');
			$table->dropColumn('no_cond_magno');
			$table->dropColumn('sup_cond_magno_terreno');
			$table->dropColumn('sup_cond_magno_construccion');
			$table->dropColumn('sup_comun_magno_terreno');
			$table->dropColumn('sup_comun_magno_construccion');

			//Se agregan columnas eliminadas
			$table->decimal('sup_comun', 10, 2);
			$table->decimal('sup_comun_magno', 10, 2);
			$table->decimal('indiviso_magno', 10, 2);
			$table->decimal('sup_total_comun', 10, 2);
			$table->integer('no_unidades');
			$table->decimal('sup_privativa', 10, 2);

		});
	}

}