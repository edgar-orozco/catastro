<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CorevatAefTerrenos extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::connection('corevat')->create('aef_terrenos', function(Blueprint $table) {
			$table->increments('idaefterreno');
			$table->integer('idavaluoenfoquefisico');
			$table->string('fraccion', 50);
			$table->decimal('superficie', 10, 2)->default(0.00);
			$table->decimal('irregular', 10, 2)->default(0.00);
			$table->decimal('top', 10, 2)->default(0.00);
			$table->decimal('frente', 10, 2)->default(0.00);
			$table->decimal('forma', 10, 2)->default(0.00);
			$table->decimal('otros', 10, 2)->default(0.00);
			$table->decimal('factor_resultante', 10, 2)->default(0.00);
			$table->decimal('valor_unitario_neto', 10, 2)->default(0.00);
			$table->decimal('indiviso', 20, 2)->default(0.00);
			$table->decimal('valor_parcial', 20, 2)->default(0.00);
			$table->integer('in_promedio')->default(1);
			
			$table->integer('idemp')->default(1);
			$table->string('ip', 50)->default('');
			$table->string('host', 100)->default('');
			$table->integer('creado_por')->default(0);
			$table->timestamp('creado_el')->default('1970-01-01 00:00:00');
			$table->integer('modi_por')->default(0);
			$table->timestamp('modi_el')->default('1970-01-01 00:00:00');
			
			$table->foreign('idemp')->references('idemp')->on('empresas')->onUpdate('cascade');
			$table->foreign('idavaluoenfoquefisico')->references('idavaluoenfoquefisico')->on('avaluo_enfoque_fisico')->onUpdate('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		DB::connection('corevat')->getPdo()->exec("DROP TABLE IF EXISTS aef_terrenos CASCADE;");
	}

}
