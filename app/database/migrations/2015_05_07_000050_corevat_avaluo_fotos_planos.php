<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CorevatAvaluoFotosPlanos extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::connection('corevat')->create('avaluo_fotos_planos', function(Blueprint $table) {
			$table->increments('idavaluofotosplano');
			$table->integer('idavaluo');
			$table->string('foto0', 150)->default('');
			$table->string('foto1', 100)->default('');
			$table->string('foto2', 100)->default('');
			$table->string('foto3', 100)->default('');
			$table->string('foto4', 100)->default('');
			$table->string('foto5', 100)->default('');
			$table->string('foto6', 100)->default('');
			$table->string('foto7', 100)->default('');
			$table->string('foto8', 100)->default('');
			$table->string('foto9', 100)->default('');
			
			$table->string('plano0', 100)->default('');
			$table->string('plano1', 100)->default('');
			$table->string('plano2', 100)->default('');
			$table->string('plano3', 100)->default('');
			$table->string('plano4', 100)->default('');
			
			$table->string('ftitulo0', 200)->default('');
			$table->string('ftitulo1', 200)->default('');
			$table->string('ftitulo2', 200)->default('');
			$table->string('ftitulo3', 200)->default('');
			$table->string('ftitulo4', 200)->default('');
			$table->string('ftitulo5', 200)->default('');
			$table->string('ftitulo6', 200)->default('');
			$table->string('ftitulo7', 200)->default('');
			$table->string('ftitulo8', 200)->default('');
			$table->string('ftitulo9', 200)->default('');
			
			$table->string('ptitulo0', 200)->default('');
			$table->string('ptitulo1', 200)->default('');
			$table->string('ptitulo2', 200)->default('');
			$table->string('ptitulo3', 200)->default('');
			$table->string('ptitulo4', 200)->default('');
			
			$table->integer('status_foto_plano')->default(1);
			
			$table->integer('idemp')->default(1);
			$table->string('ip', 50)->default('');
			$table->string('host', 100)->default('');
			$table->integer('creado_por')->default(0);
			$table->timestamp('creado_el')->default('1970-01-01 00:00:00');
			$table->integer('modi_por')->default(0);
			$table->timestamp('modi_el')->default('1970-01-01 00:00:00');
			
			$table->foreign('idemp')->references('idemp')->on('empresas')->onUpdate('cascade');
			$table->foreign('idavaluo')->references('idavaluo')->on('avaluos')->onUpdate('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		DB::connection('corevat')->getPdo()->exec("DROP TABLE IF EXISTS avaluo_fotos_planos CASCADE;");
	}

}
