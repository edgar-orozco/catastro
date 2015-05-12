<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CorevatAvaluoConclusiones extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::connection('corevat')->create('avaluo_conclusiones', function(Blueprint $table) {
			$table->increments('idavaluoconclusion');
			$table->integer('idavaluo');
			$table->decimal('valor_fisico', 20, 2)->default(0.00);
			$table->decimal('valor_mercado', 10, 2)->default(0.00);
			$table->integer('factor_seleccion_valor')->default(1);
			$table->decimal('valor_concluido', 20, 2)->default(0.00);
			$table->text('leyenda');
			$table->string('sello', 100);
			$table->string('firma', 100);

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
		DB::connection('corevat')->getPdo()->exec("DROP TABLE IF EXISTS avaluo_conclusiones CASCADE;");
	}

}
