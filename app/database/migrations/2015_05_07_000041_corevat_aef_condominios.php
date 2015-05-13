<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CorevatAefCondominios extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::connection('corevat')->create('aef_condominios', function(Blueprint $table) {
			$table->increments('idaefcondominio');
			$table->integer('idavaluoenfoquefisico');
			$table->string('descripcion', 200);
			$table->string('unidad', 10);
			$table->decimal('cantidad', 10, 2)->default(0.00);
			$table->decimal('valor_nuevo', 10, 2)->default(0.00);
			$table->decimal('vida_remanente', 10, 2)->default(0.00);
			$table->decimal('edad', 10, 2)->default(0.00);
			$table->decimal('fe_v1', 10, 4)->default(0.00);
			$table->decimal('fe_v2', 10, 4)->default(0.00);
			$table->decimal('factor_edad', 10, 4)->default(0.00);
			$table->decimal('factor_conservacion', 10, 2)->default(0.00);
			$table->decimal('factor_resultante', 10, 2)->default(0.00);
			$table->decimal('indiviso', 10, 2)->default(0.00);
			$table->decimal('valor_parcial', 10, 2)->default(0.00);
			
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
		DB::connection('corevat')->getPdo()->exec("DROP TABLE IF EXISTS aef_condominios CASCADE;");
	}

}
