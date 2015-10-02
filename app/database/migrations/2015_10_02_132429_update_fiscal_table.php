<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateFiscalTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('fiscal', function(Blueprint $table)
		{
			$table->string('cve_estatus_predio',1)->nullable();
			$table->decimal('valor_terreno',18,2)->nullable();
			$table->decimal('valor_construccion',18,2)->nullable();
			$table->date('fecha_revaluacion')->nullable();
			$table->string('cve_tipo_construccion',1)->nullable();
			$table->string('cve_edo_conservacion',1)->nullable();
			$table->decimal('valor_unitario_construccion',18,2)->nullable();
			$table->integer('niveles')->nullable();
			
			$table->unique('cuenta');
			$table->unique('clave');
			

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('fiscal', function(Blueprint $table)
		{
			$table->dropColumn('cve_estatus_predio');
			$table->dropColumn('valor_terreno');
			$table->dropColumn('valor_construccion');
			$table->dropColumn('fecha_revaluacion');
			$table->dropColumn('cve_tipo_construccion');
			$table->dropColumn('cve_edo_conservacion');
			$table->dropColumn('valor_unitario_construccion');
			$table->dropColumn('niveles');

		});
	}

}
