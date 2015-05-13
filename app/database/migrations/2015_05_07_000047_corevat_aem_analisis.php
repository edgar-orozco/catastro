<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CorevatAemAnalisis extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::connection('corevat')->create('aem_analisis', function(Blueprint $table) {
			$table->increments('idaemanalisis');
			$table->integer('idavaluoenfoquemercado');
			$table->integer('idaeminformacion');
			$table->decimal('precio_venta', 15, 2)->default(0.00);
			$table->decimal('superficie_terreno', 15, 2)->default(0.00);
			$table->decimal('superficie_construccion', 15, 2)->default(0.00);
			$table->decimal('valor_unitario_m2', 15, 2)->default(0.00);
			$table->decimal('factor_zona', 10, 2)->default(0.00);
			$table->decimal('factor_ubicacion', 10, 2)->default(0.00);
			$table->decimal('factor_superficie', 10, 2)->default(0.00);
			$table->decimal('factor_edad', 10, 2)->default(0.00);
			$table->decimal('factor_conservacion', 10, 2)->default(0.00);
			$table->decimal('factor_negociacion', 10, 2)->default(0.00);
			$table->decimal('factor_resultante', 14, 2)->default(0.00);
			$table->decimal('valor_unitario_resultante_m2', 15, 2)->default(0.00);
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
			$table->foreign('idaeminformacion')->references('idaeminformacion')->on('aem_informacion')->onUpdate('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		DB::connection('corevat')->getPdo()->exec("DROP TABLE IF EXISTS aem_analisis CASCADE;");
	}

}
