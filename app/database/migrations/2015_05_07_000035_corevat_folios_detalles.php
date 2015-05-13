<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CorevatFoliosDetalles extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::connection('corevat')->create('folios_detalles', function(Blueprint $table) {
			$table->increments('idfoliodetalle');
			$table->integer('idfolio');
			$table->string('serie', 10);
			$table->integer('iduser');
			$table->decimal('cantidad', 10, 2)->default(0.00);
			$table->decimal('pu', 10, 2)->default(0.00);
			$table->decimal('importe', 10, 2)->default(0.00);
			$table->timestamp('fecha_pago');
			
			$table->integer('idemp')->default(1);
			$table->string('ip', 50)->default('');
			$table->string('host', 100)->default('');
			$table->integer('creado_por')->default(0);
			$table->timestamp('creado_el')->default('1970-01-01 00:00:00');
			$table->integer('modi_por')->default(0);
			$table->timestamp('modi_el')->default('1970-01-01 00:00:00');
			
			$table->foreign('idemp')->references('idemp')->on('empresas')->onUpdate('cascade');
			$table->foreign('iduser')->references('iduser')->on('usuarios')->onUpdate('cascade');
			$table->foreign('idfolio')->references('idfolio')->on('folios')->onUpdate('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		DB::connection('corevat')->getPdo()->exec("DROP TABLE IF EXISTS folios_detalles CASCADE;");
	}

}
