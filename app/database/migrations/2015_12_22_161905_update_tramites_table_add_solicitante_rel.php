<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTramitesTableAddSolicitanteRel extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('tramites', function(Blueprint $table) {
			//DB::exec("ALTER TABLE tramites DROP CONSTRAINT tramites_solicitante_id_foreign");
			if($table->dropForeign('tramites_solicitante_id_foreign')){
				$table->foreign('solicitante_id')->references('id')->on('solicitante');
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
		Schema::table('tramites', function(Blueprint $table) {
			if($table->dropForeign('tramites_solicitante_id_foreign')) {
				$table->foreign('solicitante_id')
						->references('id_p')
						->on('personas');
			}
		});
	}

}
