<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CorevatAefConstrucciones extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::connection('corevat')->create('aef_construcciones', function(Blueprint $table) {
			$table->increments('idaefconstruccion');
			$table->integer('idavaluoenfoquefisico');
			$table->integer('idtipo');
			$table->decimal('edad', 10, 2)->default(0.00);
			$table->decimal('superficie_m2', 10, 2)->default(0.00);
			$table->decimal('vida_remanente', 10, 2)->default(0.00);
			$table->decimal('fe_v1', 10, 4)->default(0.00);
			$table->integer('fe_v2');
			$table->decimal('fe_v3', 10, 4)->default(0.00);
			$table->decimal('factor_edad', 10, 4)->default(0.00);
			$table->decimal('factor_conservacion', 10, 2)->default(0.00);
			$table->decimal('factor_resultante', 10, 2)->default(0.00);
			$table->decimal('valor_neto', 10, 2)->default(0.00);
			$table->decimal('valor_parcial_construccion', 10, 2)->default(0.00);
			
			$table->integer('idemp')->default(1);
			$table->string('ip', 50)->default('');
			$table->string('host', 100)->default('');
			$table->integer('creado_por')->default(0);
			$table->timestamp('creado_el')->default('1970-01-01 00:00:00');
			$table->integer('modi_por')->default(0);
			$table->timestamp('modi_el')->default('1970-01-01 00:00:00');
			
			$table->foreign('idemp')->references('idemp')->on('empresas')->onUpdate('cascade');
			$table->foreign('idavaluoenfoquefisico')->references('idavaluoenfoquefisico')->on('avaluo_enfoque_fisico')->onUpdate('cascade');
			$table->foreign('idtipo')->references('idtipo')->on('cat_tipo')->onUpdate('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		DB::connection('corevat')->getPdo()->exec("DROP TABLE IF EXISTS aef_construcciones CASCADE;");
	}

}
