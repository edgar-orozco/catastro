<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CorevatAefCompConstrucciones extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::connection('corevat')->create('aef_comp_construcciones', function(Blueprint $table) {
			$table->increments('idaefcompconstruccion');
			$table->integer('idavaluoenfoquefisico');
			$table->integer('idtipo');
			$table->string('caracteristicas', 200)->default('');
			$table->decimal('m2construido', 10, 2)->default(0.00);
			$table->decimal('precio', 10, 2)->default(0.00);
			$table->decimal('precio_unitario_m2', 10, 2)->default(0.00);
			$table->string('observaciones', 200)->default('');

			$table->integer('idemp')->default(1);
			$table->string('ip', 50)->default('');
			$table->string('host', 100)->default('');
			$table->integer('creado_por')->default(0);
			$table->timestamp('creado_el')->default('1970-01-01 00:00:00');
			$table->integer('modi_por')->default(0);
			$table->timestamp('modi_el')->default('1970-01-01 00:00:00');
			
			$table->foreign('idemp')->references('idemp')->on('empresas')->onUpdate('cascade');
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
		DB::connection('corevat')->getPdo()->exec("DROP TABLE IF EXISTS aef_comp_construcciones CASCADE;");
	}

}
