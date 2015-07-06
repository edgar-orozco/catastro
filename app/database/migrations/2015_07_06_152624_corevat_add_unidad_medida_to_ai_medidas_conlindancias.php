<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CorevatAddUnidadMedidaToAiMedidasConlindancias extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::connection('corevat')->table('ai_medidas_colindancias', function(Blueprint $table)
		{
			$table->string('unidad_medida')->nullable();			
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
