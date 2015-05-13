<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CorevatAiMedidasColindancias extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::connection('corevat')->create('ai_medidas_colindancias', function(Blueprint $table) {
			$table->increments('idaimedidacolindancia');
			$table->integer('idavaluoinmueble');
			$table->integer('idorientacion');
			$table->string('medida', 50)->default('');
			$table->string('colindancia', 100)->default('');

			$table->integer('idemp');
			$table->string('ip', 50)->default('');
			$table->string('host', 100)->default('');
			$table->integer('creado_por')->default(0);
			$table->timestamp('creado_el')->default('1970-01-01 00:00:00');
			$table->integer('modi_por')->default(0);
			$table->timestamp('modi_el')->default('1970-01-01 00:00:00');
			
			$table->foreign('idemp')->references('idemp')->on('empresas')->onUpdate('cascade');
			$table->foreign('idavaluoinmueble')->references('idavaluoinmueble')->on('avaluo_inmueble')->onUpdate('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		DB::connection('corevat')->getPdo()->exec("DROP TABLE IF EXISTS ai_medidas_colindancias CASCADE;");
	}

}
