<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CorevatAemCompTerrenos extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::connection('corevat')->create('aem_comp_terrenos', function(Blueprint $table) {
			$table->increments('idaemcompterreno');
			$table->integer('idavaluoenfoquemercado');
			$table->string('ubicacion', 200)->default('');
			$table->decimal('precio', 10, 2)->default(0.00);
			$table->decimal('superficie_terreno', 10, 2)->default(0.00);
			$table->decimal('superficie_construida', 10, 2)->default(0.00);
			$table->decimal('precio_unitario_m2_terreno', 10, 2)->default(0.00);
			$table->decimal('precio_unitario_m2_construccion', 10, 2)->default(0.00);
			$table->string('observaciones', 100)->default('');
			
			$table->integer('idemp')->default(1);
			$table->string('ip', 50)->default('');
			$table->string('host', 100)->default('');
			$table->integer('creado_por')->default(0);
			$table->timestamp('creado_el')->default('1970-01-01 00:00:00');
			$table->integer('modi_por')->default(0);
			$table->timestamp('modi_el')->default('1970-01-01 00:00:00');
			
			$table->foreign('idemp')->references('idemp')->on('empresas')->onUpdate('cascade');
			$table->foreign('idavaluoenfoquemercado')->references('idavaluoenfoquemercado')->on('avaluo_enfoque_mercado')->onUpdate('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		DB::connection('corevat')->getPdo()->exec("DROP TABLE IF EXISTS aem_comp_terrenos CASCADE;");
	}

}
