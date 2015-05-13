<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CorevatAemHomologacion extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::connection('corevat')->create('aem_homologacion', function(Blueprint $table) {
			$table->increments('idaemhomologacion');
			$table->integer('idavaluoenfoquemercado');
			$table->integer('idaemcompterreno');
			$table->string('comparable', 100)->default('');
			$table->decimal('superficie_terreno', 10, 2)->default(0.00);
			$table->decimal('superficie_construccion', 10, 2)->default(0.00);
			$table->decimal('valor_unitario', 10, 2)->default(0.00);
			$table->decimal('zona', 10, 2)->default(0.00);
			$table->decimal('ubicacion', 10, 2)->default(0.00);
			$table->decimal('frente', 10, 2)->default(0.00);
			$table->decimal('forma', 10, 2)->default(0.00);
			$table->decimal('superficie', 10, 2)->default(0.00);
			$table->decimal('valor_unitario_negociable', 10, 2)->default(0.00);
			$table->decimal('valor_unitario_resultante_m2', 10, 2)->default(0.00);
			$table->integer('in_promedio')->default(1);
			
			$table->integer('idemp')->default(1);
			$table->string('ip', 50)->default('');
			$table->string('host', 100)->default('');
			$table->integer('creado_por')->default(0);
			$table->timestamp('creado_el')->default('1970-01-01 00:00:00');
			$table->integer('modi_por')->default(0);
			$table->timestamp('modi_el')->default('1970-01-01 00:00:00');
			
			$table->foreign('idemp')->references('idemp')->on('empresas')->onUpdate('cascade');
			$table->foreign('idavaluoenfoquemercado')->references('idavaluoenfoquemercado')->on('avaluo_enfoque_mercado')->onUpdate('cascade');
			$table->foreign('idaemcompterreno')->references('idaemcompterreno')->on('aem_comp_terrenos')->onUpdate('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		DB::connection('corevat')->getPdo()->exec("DROP TABLE IF EXISTS aem_homologacion CASCADE;");
	}

}
