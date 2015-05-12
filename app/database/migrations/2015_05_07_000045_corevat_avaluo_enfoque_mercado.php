<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CorevatAvaluoEnfoqueMercado extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::connection('corevat')->create('avaluo_enfoque_mercado', function(Blueprint $table) {
			$table->increments('idavaluoenfoquemercado');
			$table->integer('idavaluo');
			$table->decimal('promedio_directo', 20, 2)->default(0.00);
			$table->decimal('valor_unitario_promedio', 12, 2)->default(0.00);
			$table->decimal('valor_aplicado_m2', 12, 2)->default(0.00);
			$table->decimal('minimo_directo', 20, 2)->default(0.00);
			$table->decimal('maximo_directo', 20, 2)->default(0.00);
			$table->decimal('promedio_analisis', 20, 2)->default(0.00);
			$table->decimal('minimo_analisis', 20, 2)->default(0.00);
			$table->decimal('maximo_analisis', 20, 2)->default(0.00);
			$table->decimal('monto_unitario_aplicable', 20, 2)->default(0.00);
			$table->decimal('superficie_terreno', 20, 4)->default(0.0000);
			$table->decimal('superficie_construida', 20, 2)->default(0.00);
			$table->decimal('valor_comparativo_mercado', 20, 2)->default(0.00);
			$table->decimal('superfice_terreno_avaluo', 20, 2)->default(0.00);
			$table->decimal('superficie_construccion_avaluo', 20, 2)->default(0.00);
			$table->decimal('promedio_unitario', 20, 2)->default(0.00);

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
		DB::connection('corevat')->getPdo()->exec("DROP TABLE IF EXISTS avaluo_enfoque_mercado CASCADE;");
	}

}
