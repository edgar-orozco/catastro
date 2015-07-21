<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CorevatAlterSeqAiMedidasColindancias extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if(Schema::connection('corevat')->hasTable('ai_medidas_colindancias_idaimedidacolindancia_seq')) {
			DB::statement('alter sequence ai_medidas_colindancias_idaimedidacolindancia_seq restart 1501;');
		}
		
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}
