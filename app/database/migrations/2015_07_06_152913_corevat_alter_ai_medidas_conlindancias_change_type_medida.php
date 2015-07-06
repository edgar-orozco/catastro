<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CorevatAlterAiMedidasConlindanciasChangeTypeMedida extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::connection('corevat')->table('ai_medidas_colindancias', function(Blueprint $table)
		{
			/*
			DB::connection('corevat')->getPdo()->exec('update ai_medidas_colindancias set medida=cast(medida  as numeric) ');
			DB::connection('corevat')->getPdo()->exec('ALTER TABLE ai_medidas_colindancias ALTER COLUMN medida TYPE numeric USING CAST(medida AS numeric) ');
			DB::connection('corevat')->getPdo()->exec('UPDATE ai_medidas_colindancias SET medida=medida::numeric');
			DB::connection('corevat')->getPdo()->exec('ALTER TABLE ai_medidas_colindancias ALTER COLUMN medida type numeric using medida::numeric');
			*/
			// Agregamos el Campo MEDIDAS para preservar los datos del campo 'medida'
			$table->decimal('medidas', 14, 4)->default(0.0)->nullable();

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('ai_medidas_colindancias', function(Blueprint $table)
		{
			//
		});
	}

}
