<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CorevatFoliosDetallesSingles extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::connection('corevat')->create('folios_detalles_singles', function(Blueprint $table) {
			$table->increments('idfoliodetallesingle');
			$table->integer('idfolio');
			$table->integer('idfoliodetalle');
			$table->string('serie', 10);
			$table->integer('numero');
			$table->integer('iduser');
			$table->timestamp('fecha_asignacion');
			$table->integer('status_folios')->default(1);
			$table->decimal('pu', 10, 2)->default(0.00);
			
			$table->integer('idemp')->default(1);
			$table->string('ip', 50)->default('');
			$table->string('host', 100)->default('');
			$table->integer('creado_por')->default(0);
			$table->timestamp('creado_el')->default('1970-01-01 00:00:00');
			$table->integer('modi_por')->default(0);
			$table->timestamp('modi_el')->default('1970-01-01 00:00:00');
			
			$table->foreign('idemp')->references('idemp')->on('empresas')->onUpdate('cascade');
			$table->foreign('iduser')->references('iduser')->on('usuarios')->onUpdate('cascade');
			$table->foreign('idfoliodetalle')->references('idfoliodetalle')->on('folios_detalles')->onUpdate('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		DB::connection('corevat')->getPdo()->exec("DROP TABLE IF EXISTS folios_detalles_singles CASCADE;");
	}

}
